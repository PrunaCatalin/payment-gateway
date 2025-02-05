<?php
/*
 * PaymentGatewayPkg | PaymentGateway.php
 * https://www.webdirect.ro/
 * Copyright 2025 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 2/5/2025 8:46 PM    
*/

namespace Webdirect\PaymentGateway\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentGateway extends Facade{
    protected static function getFacadeAccessor(): string
    {
        return 'paymentgateway';
    }
}
