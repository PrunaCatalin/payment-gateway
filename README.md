# payment-gateway
php artisan vendor:publish --provider="Webdirect\PaymentGateway\WDPaymentGatewayServiceProvider" --tag="wd-payment-gateway-config"

//to disable country selection
public function setCountryIdAttribute(int $value): void
{
    $this->attributes['country_id'] = $value;
}

//can extend PaymentMethod Model , filament guard and other changes 
