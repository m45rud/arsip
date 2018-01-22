<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_homes');
        $this->auth->auth();
    }

	public function index()
	{
        $this->load->helper('form');
        $data['title'] = "Arsip Dokumen Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['action'] = "";
        $data['content'] = 'home';
		$this->load->view('index', $data);
	}

    public function result()
    {
        $keyword = $this->input->get('keyword', TRUE);

        if (is_null($keyword)) {
            $this->load->helper('form');
        } else {
            $this->load->model('m_homes');
            $this->load->helper('form');

            $where = "d_is_deleted = 'FALSE'";
            $data['result'] = $this->m_homes->get_result($keyword, $where);
            $data['keyword'] = $keyword;
            $this->load->view('result', $data);
        }
    }

    public function view()
    {
        $this->load->helper('form');
        $d_id = $this->uri->segment(3);
        $where = "d_id = '$d_id'";

        $data['document'] = $this->m_homes->get_data($where);
        $data['title'] = $data['document']['d_id']." &minus; Arsip Dokumen Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['attachment'] = 'Isi Dokumen';
        $data['content'] = 'result-view';

        if (!$d_id) {
            redirect(site_url());
        } else {
            $this->load->view('index', $data);
        }
    }
}
