<?php
class PaymentConTtroller extends Controller {
    
    public function __construct() {
        parent::__construct();
        // Load necessary libraries
        $this->call->library('paypal');  // Assuming a custom PayPal library is set up
        $this->call->library('session');
        if(!$this->session->has_userdata('logged_in')) {
            redirect();
        }
    }

    public function index() {
        // Display payment UI
        $this->call->view('payment_form');
    }

    public function processPayment() {
        // Retrieve payment details
        $amount = $this->io->post('amount');
        $currency = 'PHP';  // Set currency for payment
    
        // Prepare payment data
        $paymentData = array(
            'amount' => $amount,
            'currency' => $currency,
            'return_url' => site_url('payment/success'),
            'cancel_url' => site_url('payment/cancel')
        );
    
        // Call PayPal API to process payment
        $response = $this->paypal->createPayment($paymentData);
    
        // Log the entire response for debugging
        file_put_contents('payment_error.log', 'Response from PayPal: ' . print_r($response, true), FILE_APPEND);
    
        // Check if the response contains the 'status' key
        if (isset($response['status']) && $response['status'] == 'success') {
            // Redirect to PayPal for approval
            redirect($response['approval_url']);
        } else {
            // Handle error (payment creation failed)
            $errorMessage = isset($response['error']) ? $response['error'] : 'Unknown error';
            file_put_contents('payment_error.log', 'Payment creation failed: ' . $errorMessage . ' - Response: ' . print_r($response, true), FILE_APPEND);
            $this->call->view('payment_error');
        }
    }
    public function success() {
        // Payment was successful
        $this->call->view('payment_success');
    }

    public function cancel() {
        // Payment was cancelled
        $this->call->view('payment_cancel');
    }
}
