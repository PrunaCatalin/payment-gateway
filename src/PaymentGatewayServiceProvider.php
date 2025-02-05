<?php
namespace Webdirect\PaymentGateway;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Webdirect\PaymentGateway\Contracts\Billable;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->registerResources();
    }
    protected function configure(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/payment-gateway.php', 'payment-gateway');
    }
    protected function registerResources(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'payment-gateway');
    }

    /**
     * @throws BindingResolutionException
     * @throws FileNotFoundException
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            // Publishing the configuration file.
            $this->publishes([
                __DIR__ . '/../config/payment-gateway.php' => config_path('payment-gateway.php'),
            ], 'payment-gateway.config');

            // Publishing the migration file.
            $this->publishes([
                __DIR__.'/../database/migrations/payment_methods.php.stub' => $this->getMigrationFileName('payment_methods.php'),
            ], 'payment-methods.database.migrations');
        }
    }
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);
        }
    }

    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        if (! defined('PAYMENT_GATEWAY_PATH')) {
            define('PAYMENT_GATEWAY_PATH', realpath(__DIR__ . '/../'));
        }
        if (! defined('PAYMENT_GATEWAY_STORAGE_PATH')) {
            define('PAYMENT_GATEWAY_STORAGE_PATH', realpath(__DIR__ . '/../storage'));
        }

        $this->offerPublishing();
        $this->registerCommands();
        $this->registerModels();
        $this->registerServices();

    }
    public function provides(): array
    {
        return ['payment-gateway'];
    }
    protected function registerServices()
    {
        $this->app->singleton(PaymentGateway::class, function ($app) {
            return new PaymentGateway(config('payment-gateway'));
        });
    }
    protected function registerModels()
    {
        $this->app->bind(Billable::class, function ($app) {
            $customerModel = config('payment-gateway.customer_model');
            return new $customerModel;
        });
    }

    /**
     * @throws BindingResolutionException
     * @throws FileNotFoundException
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');
        $filesystem = $this->app->make(Filesystem::class);

        $stubPath = __DIR__ . '/../database/migrations/' . $migrationFileName . '.stub';

        $stubContent = $filesystem->get($stubPath);

        $replacements = [
            '{{ timestamp }}' => $timestamp,
            '{{ year }}' => date('Y'),
            '{{ date }}' => date('Y-m-d H:i:s'),
            '{{ table_name }}' => config('payment-gateway.table_names.payment_methods', 'payment_methods'),
            '{{ countries_table }}' => config('payment-gateway.table_names.payment_countries', 'generic_countries'),
        ];

        $migrationContent = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $stubContent
        );

        $migrationPath = $this->app->databasePath() . '/migrations/' . $timestamp . '_' . $migrationFileName;

        $filesystem->put($migrationPath, $migrationContent);

        return $migrationPath;
    }
}
