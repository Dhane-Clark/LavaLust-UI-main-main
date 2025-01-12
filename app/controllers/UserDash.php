<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserDash extends Controller {
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('logged_in')) {
            redirect('index');
        } else {
            redirect();
        }
    }

    public function index() {
        $this->call->view('index');
    }
    public function about() {
        $this->call->view('about');
    }

    public function typography() {
        $this->call->view('typography');
    }
    public function contacts() {
        $this->call->view('contacts');
    }
}
?>
