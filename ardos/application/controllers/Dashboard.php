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
        $docs             = $this->m_dashboards->get_documents();
        $data['totalmap'] = (is_array($docs)) ? count($docs) : 0;

        $wm          = "d_status = 'Kosong'";
        $maps        = $this->m_dashboards->get_maps($wm);
        $data['map'] = (is_array($maps)) ? count($maps) : 0;

        $whi        = "d_ijazah = 'Ada' AND d_ijazah_borrowed_at != 'NULL' AND d_is_deleted = 'FALSE'";
        $bi         = $this->m_dashboards->get_bi($whi);
        $data['bi'] = (is_array($bi)) ? count($bi) : 0;

        $whs        = "d_skhun = 'Ada' AND d_skhun_borrowed_at != 'NULL' AND d_is_deleted = 'FALSE'";
        $bs         = $this->m_dashboards->get_bs($whs);
        $data['bs'] = (is_array($bs)) ? count($bs) : 0;

        $mwi         = "d_ijazah = 'Tidak Ada' AND d_is_deleted = 'FALSE'";
        $gmwi        = $this->m_dashboards->get_mwi($mwi);
        $data['mwi'] = (is_array($gmwi)) ? count($gmwi) : 0;

        $mws         = "d_skhun = 'Tidak Ada' AND d_is_deleted = 'FALSE'";
        $gmws        = $this->m_dashboards->get_mws($mws);
        $data['mws'] = (is_array($gmws)) ? count($gmws) : 0;

        $data['title'] = "Admin &minus; Arsip Dokumen Siswa | SMK Muhammadiyah 3 Nganjuk";
        $data['content'] = 'dashboard/home';
		$this->load->view('dashboard/index', $data);
	}
}
