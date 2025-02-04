<?php
namespace Vendor\PaymentGateway;

class WDPaymentGateway
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function charge(array $data){
        // Procesează plata
    }

    public function refund(int $transactionId){
        // Returnează suma
    }

    public function preparePayment(array $requestData, WDBillable $customer){
        // Procesează datele și returnează un array cu datele necesare pentru procesarea plății
    }

    public function processPayment(array $requestData, WDBillable $customer){
        // Procesează răspunsul
    }

    public function processResponse(array $requestData, WDBillable $customer){
        // Procesează răspunsul
    }

    public function getTransactionStatus(string $transactionId){
        // Returnează starea tranzacției
    }
}