<?php
/*
 * PaymentGatewayPkg | GenericCountry.php
 * https://www.webdirect.ro/
 * Copyright 2025 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 2/5/2025 10:08 PM    
*/

namespace Webdirect\PaymentGateway\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GenericCountry
 *
 * @property int $id
 * @property string $name
 * @property string $alpha_2
 * @property string $alpha_3
 * @property string $country_code
 * @property string $iso_3166_2
 * @property string $region
 * @property string $sub_region
 * @property string $intermediate_region
 * @property string $region_code
 * @property string $sub_region_code
 * @property string $intermediate_region_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class GenericCountry extends Model
{
    use SoftDeletes;

    protected $table = 'generic_countries';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('payment_gateway.tables.generic_countries');
    }

    protected $fillable = [
        'name',
        'alpha_2',
        'alpha_3',
        'country_code',
        'iso_3166_2',
        'region',
        'sub_region',
        'intermediate_region',
        'region_code',
        'sub_region_code',
        'intermediate_region_code',
    ];
}

