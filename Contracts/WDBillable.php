<?php
namespace Vendor\PaymentGateway\Contracts;

interface WDBillable
{
    public function getCustomerId(): string|int; 
    public function getEmail(): string; 
    public function getName(): string; 
    public function getPaymentMethods(): array;
}