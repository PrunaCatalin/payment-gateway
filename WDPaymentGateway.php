<?php
namespace Webdirect\PaymentGateway;

class WDPaymentGateway
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function charge(array $data, WDBillable $customer)
    {
        $customerId = $customer->getCustomerId();
        $email = $customer->getEmail();
        // ...
    }

    public function refund(int $transactionId, WDBillable $customer)
    {
        // Returnează suma folosind datele clientului
    }

    public function preparePayment(array $requestData, WDBillable $customer)
    {
        // Procesează datele și returnează un array cu datele necesare pentru procesarea plății
    }

    public function processPayment(array $requestData, WDBillable $customer)
    {
        // Procesează răspunsul
    }

    public function processResponse(array $requestData, Billable $customer)
    {
        // Procesează răspunsul
    }

    public function getTransactionStatus(string $transactionId, Billable $customer)
    {
        // Returnează starea tranzacției
    }
}