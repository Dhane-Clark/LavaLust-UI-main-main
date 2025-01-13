<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserAuth extends Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('logged_in')) {
            redirect('index');
        } else {
            redirect();
        }
    }

    public function login() {
        $this->call->view('auth/UserLogin');
    }
    public function attemptLogin() {
            if($this->form_validation->submitted()) {
                $email = $this->io->post('email');
                $password = $this->io->post('password');
                $verify = $this->db->table('userss')->where('email', $email)->get();
                $data = $this->lauth->login($email, $password);

                if($verify) {
                    $passVerify = password_verify($password, $verify['password_hash']);
                    if($passVerify) {
                        $this->session->set_userdata('logged_in', $verify['id']);
                        redirect('index');
                    } else {
                        set_Flash_alert('danger', 'Wrong password');
                        return redirect();            
                    }
                } else {
                    set_Flash_alert('danger', 'Email not found');
                    return redirect();  
                }
            } 
            
    }

    public function register() {
        $this->call->view('auth/UserRegister');
    }

    public function attemptRegister() {
       
        if($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $this->form_validation
                    ->name('email')
                    ->required()
                    ->is_unique('userss', 'email', $email, 'Email was already taken.')
                ->name('username')
                    ->required()
                    ->is_unique('userss', 'username', $username, 'Username was already taken.')
                    ->min_length(5, 'Username name must not be less than 5 characters.')
                    ->max_length(20, 'Username name must not be more than 20 characters.')
                    ->alpha_numeric_dash('Special characters are not allowed in username.')
                ->name('password_hash')
                    ->required();
                
                if($this->form_validation->run()) {
                    $data = [
                        'username' => $username,
                        'email' => $email,
                        'password_hash' => password_hash($this->io->post('password_hash'), PASSWORD_BCRYPT),
                    ];
                    $this->db->table('userss')->insert($data);
                    set_flash_alert('success', 'Account created successfully'); 
                    redirect('userRegister');
                }  else {
                    set_flash_alert('danger', $this->form_validation->errors()); 
                    redirect('userRegister');
                }
        } else {
            $this->call->view('Userauth/register');
        }
    }

    public function reserve() {
        $this->call->view('book');
    }
}
