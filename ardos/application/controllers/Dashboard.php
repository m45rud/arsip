<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->auth->restrict();
        $this->load->model('m_dashboards');
}


	public function index()
	{
        $data['totalmap'] = count($this->m_dashboards->get_documents());
        $wm = "d_status = 'Kosong'";
        $data['map'] = count($this->m_dashboards->get_maps($wm));

        $whi = "d_ijazah = 'Ada' AND d_ijazah_borrowed_at != 'NULL' AND d_is_deleted = 'FALSE'";
        $data['bi'] = count($this->m_dashboards->get_bi($whi));

        $whs = "d_skhun = 'Ada' AND d_skhun_borrowed_at != 'NULL' AND d_is_deleted = 'FALSE'";
        $data['bs'] = count($this->m_dashboards->get_bs($whs));

        $mwi = "d_ijazah = 'Tidak Ada' AND d_is_deleted = 'FALSE'";
        $data['mwi'] = count($this->m_dashboards->get_mwi($mwi));

        $mws = "d_skhun = 'Tidak Ada' AND d_is_deleted = 'FALSE'";
        $data['mws'] = count($this->m_dashboards->get_mws($mws));

        $data['title'] = "Admin &minus; Arsip dokumen Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = 'dashboard/home';
		$this->load->view('dashboard/index', $data);
	}
}
