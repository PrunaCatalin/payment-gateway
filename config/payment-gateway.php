<?php
/*
 * PaymentGatewayPkg | payment-gateway.php
 * https://www.webdirect.ro/
 * Copyright 2025 Pruna Catalin Costin
 * Email : office@webdirect.ro
 * Type  : PHP
 * Created on : 2/5/2025 8:46 PM
*/
return [
    //Default Customer Model
    'customer_model' => \App\Models\User::class, 
    //Default Payment Method Model
    'payment_method_model' => \App\Models\User::class,
    //Default Configuration Attributes for payment
    'configuration_attributes' => [
        'endPoint' => '',
        'secretKey' => '',
        'username' => '',
        'password' => '',
        'callback' => '',
        'email' => '',
    ],
    //Default Tables Configuration for payment gateway
    'table_names' => [
        'payment_methods' => 'payment_methods',
        'payment_countries' => 'generic_countries',
    ],
    //Default Models for payment gateway
    'models' => [
        'payment_methods' => \Webdirect\PaymentGateway\Models\PaymentMethod::class,
        'payment_countries' => \Webdirect\PaymentGateway\Models\GenericCountry::class,
    ]
];
