<?php
class PayPal {
    
    private $clientId = 'YOUR_PAYPAL_CLIENT_ID';
    private $secret = 'YOUR_PAYPAL_SECRET';
    private $apiUrl = 'https://api.sandbox.paypal.com/v1/';

    public function createPayment($data) {
        // Make PayPal API call to create payment
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . 'payments/payment');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->preparePaymentData($data)));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($this->clientId . ':' . $this->secret)
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private function preparePaymentData($data) {
        // Prepare the PayPal API request data
        return array(
            'intent' => 'sale',
            'payer' => array('payment_method' => 'paypal'),
            'transactions' => array(
                array(
                    'amount' => array(
                        'total' => $data['amount'],
                        'currency' => $data['currency']
                    ),
                    'description' => 'Payment for services'
                )
            ),
            'redirect_urls' => array(
                'return_url' => $data['return_url'],
                'cancel_url' => $data['cancel_url']
            )
        );
    }
}
