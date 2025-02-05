<?php
/*
 * PaymentGatewayPkg | InstallCommand.php
 * https://www.webdirect.ro/
 * Copyright 2025 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 2/5/2025 9:10 PM    
*/

namespace Webdirect\PaymentGateway\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'wd-payment-gateway:install';

    protected $description = 'Install all of the Payment gateway resources';

    public function handle()
    {
        $this->comment('Publishing Payment Gateway Config...');
        $this->callSilent('vendor:publish', ['--tag' => 'payment-gateway.config']);

        $this->comment('Publishing Payment Gateway Tables...');
        $this->callSilent('vendor:publish', ['--tag' => 'payment-methods.database.migrations']);

        $this->info('Payment Gateway scaffolding installed successfully.');
    }
}
