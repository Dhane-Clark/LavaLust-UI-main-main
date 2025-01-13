<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class AppointmentController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    // List all appointments for the logged-in user
    public function index()
    {
        $session = $this->session->userdata('logged_in');

        if (!$session) {
            return redirect('login'); // Redirect if the user is not logged in
        }

        $profile = $this->db->table('user')->where('id', $session)->get();
        $data = [
            'appointments_active' => $this->db->table('appointments')
                ->where('user_id', $session)
                ->not_where('status', 'CANCELLED')
                ->get_all(),
            'appointments_all' => $this->db->table('appointments')
                ->where('user_id', $session)
                ->get_all(),
            'name' => $profile['username'],
            'email' => $profile['email']
        ];

        $this->call->view('user/dashboard', $data);
    }

    // Cancel an appointment
    public function cancel($id)
    {
        $appointment = $this->db->table('appointments')->where('id', $id)->get();

        if (!$appointment) {
            show_404(); // Show 404 if appointment doesn't exist
        }

        if ($appointment['status'] === 'PENDING' || $appointment['status'] === 'ACCEPTED') {
            $data = ['status' => 'CANCELLED'];
            $this->db->table('appointments')->where('id', $id)->update($data);

            set_flash_alert('success', 'Appointment successfully cancelled.');
        } else {
            set_flash_alert('error', 'This appointment cannot be cancelled.');
        }

        return redirect('user_dashboard');
    }

    // Create a new appointment
    public function create()
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('firstname')->required()
                ->name('lastname')->required()
                ->name('number')->required()
                ->name('reservation')->required()
                ->name('datetime')->required();

            if ($this->form_validation->run()) {
                $session = $this->session->userdata('isLoggedIn');

                if (!$session) {
                    return redirect('login'); // Redirect if the user is not logged in
                }

                $data = [
                    'user_id' => $session,
                    'firstname' => $this->io->post('firstname'),
                    'lastname' => $this->io->post('lastname'),
                    'number' => $this->io->post('number'),
                    'reservation' => $this->io->post('reservation'),
                    'datetime' => $this->io->post('datetime'),
                    'status' => 'PENDING'
                ];

                $this->db->table('appointments')->insert($data);

                set_flash_alert('success', 'Your appointment has been created.');
                return redirect('user_dashboard');
            }
        }

        $this->call->view('user/appointment_form'); // Changed view to better indicate form
    }
    public function delete($id)
    {
        // Call model method to delete the appointment
        if ($this->db->table('appointments')->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Appointment deleted successfully.');
            redirect('adminDash'); 
        } else {
            $this->session->set_flashdata('error', 'Failed to delete appointment.');
        }
        redirect('adminDash'); 
    }

    public function update_status($id)
    {
        // Get the status from the request
        $status = $this->input->get('status');

        // Load model
        $this->load->model('Appointment_model');

        // Call model method to update the status
        if ($this->Appointment_model->update_status($id, $status)) {
            $this->session->set_flashdata('success', 'Appointment status updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update appointment status.');
        }

        // Redirect back to the appointment management page
        redirect('adminDash');
    }

    public function test($data) {
        // $username = $this->db->table('appointments')->where(['id' => 4])->delete();
        // if($username) {
        //     echo 'ok';
        // } else {
        //     echo 'no';
        // }
        echo $data;
    }

}
