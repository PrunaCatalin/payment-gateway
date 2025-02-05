<?php
/*
 * PaymentGatewayPkg | PaymentMethod.php
 * https://www.webdirect.ro/
 * Copyright 2025 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 2/5/2025 10:07 PM    
*/

namespace Webdirect\PaymentGateway\Models;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;
use Webdirect\PaymentGateway\Models\GenericCountry;
/**
 * Class PaymentMethod
 *
 * Represents a payment method in the system.
 *
 * @property string $name The name of the payment method.
 * @property string $provider The provider of the payment method.
 * @property array $production_configurations The configurations for the payment method, stored as encrypted JSON.
 * @property array $sandbox_configurations The configurations for the payment method, stored as encrypted JSON.
 * @property bool $is_active Indicates if the payment method is active.
 * @property bool $is_sandbox Indicates if the payment method is in sandbox mode.
 * @property int $country_id The ID of the country associated with the payment method.
 * @property-read GenericCountry $genericCountry The country associated with the payment method.
 */
class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $fillable = [
        'name',
        'provider',
        'notes',
        'production_configurations',
        'sandbox_configurations',
        'is_active',
        'is_sandbox',
        'country_id',
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('payment_gateway.tables.payment_methods');
    }
    /**
     * Set the configuration attribute.
     *
     * Encrypts and encodes the configurations as JSON before storing them in the database.
     *
     * @param array $value
     * @return void
     */
    public static function defaultConfiguration(): array
    {
        return config('payment-gateway.configuration_attributes');
    }

    /**
     * Get the country associated with the payment method.
     */
    public function genericCountry(): BelongsTo
    {
        return $this->belongsTo(GenericCountry::class, 'country_id');
    }

    /**
     * Get the production_configurations attribute.
     *
     * Decrypts and decodes the JSON configurations stored in the database.
     */
    public function getProductionConfigurationsAttribute(): array
    {
        if (!empty($this->attributes['production_configurations'])) {
            $decrypted = Crypt::decrypt($this->attributes['production_configurations']);
            $decoded = json_decode($decrypted, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }

    /**
     * Get the sandbox_configurations attribute.
     *
     * Decrypts and decodes the JSON configurations stored in the database.
     */
    public function getSandboxConfigurationsAttribute(): array
    {
        if (!empty($this->attributes['sandbox_configurations'])) {
            $decrypted = Crypt::decrypt($this->attributes['sandbox_configurations']);
            $decoded = json_decode($decrypted, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }

    /**
     * @param string $value
     */
    public function setProductionConfigurationsAttribute(array $value): void
    {
        $this->attributes['production_configurations'] = Crypt::encrypt(json_encode($value));
    }

    /**
     * @param string $value
     */
    public function setSandboxConfigurationsAttribute(array $value): void
    {
        $this->attributes['sandbox_configurations'] = Crypt::encrypt(json_encode($value));
    }

    /**
     * Scope a query to only include active payment methods.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive($query): Builder
    {
        return $query->where('is_active', 1);
    }

    /**
     * Scope a query to only include active payment methods.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsSandbox($query): Builder
    {
        return $query->where('is_sandbox', 1);
    }
}
