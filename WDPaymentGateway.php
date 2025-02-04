<?php
class WDPaymentGateway
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function charge(array $data, Billable $customer)
    {
        // Procesează plata folosind datele clientului
        $customerId = $customer->getCustomerId();
        $email = $customer->getEmail();
        // ...
    }

    public function refund(int $transactionId, Billable $customer)
    {
        // Returnează suma folosind datele clientului
    }

    public function preparePayment(array $requestData, Billable $customer)
    {
        // Procesează datele și returnează un array cu datele necesare pentru procesarea plății
    }

    public function processPayment(array $requestData, Billable $customer)
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