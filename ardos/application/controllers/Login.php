<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->auth->auth();
    }

    public function index()
    {
        if ($_POST) {
            sleep(1);
            if ($this->validation()) {
                $u_name = $this->input->post('u_name', TRUE);
                $u_pass = $this->input->post('u_pass', TRUE);
                echo $this->auth->login($u_name, $u_pass) ? 1 : 0;
            } else {
                echo 0;
            }
        } else {
            $this->load->helper('form');
            $data['title'] = "Login Admin &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
            $data['content'] = "login";
            $this->load->view('index', $data);
        }
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('u_name', 'Username', 'trim|required|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('u_pass', 'Password', 'trim|required|min_length[5]');
        return $this->form_validation->run();
    }
}
