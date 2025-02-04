<?php
namespace Vendor\WDPaymentGateway;

use Illuminate\Support\ServiceProvider;
use Vendor\PaymentGateway\Contracts\WDBillable;

class WDPaymentGatewayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->publishes([
            __DIR__ . '/../config/wd-payment-gateway.php' => config_path('wd-payment-gateway.php'),
        ], 'wd-payment-gateway-config');
    }

    public function register()
    {
        $this->app->singleton(WDPaymentGateway::class, function ($app) {
            return new WDPaymentGateway(config('payment-gateway'));
        });

        $this->app->bind(WDBillable::class, function ($app) {
            $customerModel = config('wd-payment-gateway.customer_model');
            return new $customerModel;
        });
    }
}