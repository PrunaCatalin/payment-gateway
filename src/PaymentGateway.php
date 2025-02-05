<?php
namespace Webdirect\PaymentGateway;
use Webdirect\PaymentGateway\Contracts\Billable;
class PaymentGateway
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

    public function preparePayment(array $requestData, Billable $customer){
        // Procesează datele și returnează un array cu datele necesare pentru procesarea plății
    }

    public function processPayment(array $requestData, Billable $customer){
        // Procesează răspunsul
    }

    public function processResponse(array $requestData, Billable $customer){
        // Procesează răspunsul
    }

    public function getTransactionStatus(string $transactionId){
        // Returnează starea tranzacției
    }
}
