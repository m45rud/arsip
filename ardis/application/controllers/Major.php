<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Major extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_majors');
        $this->auth->restrict();
        $this->auth->admin();
    }

    private static $title = "Program Keahlian &minus; Arsip Digital Siswa | SMK Muhammadiyah 3 Nganjuk";
    private static $table = 'majors';
	private static $primaryKey = 'm_id';

    public function index()
	{
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/major";
		$this->load->view('dashboard/index', $data);
	}

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'm_id', 'dt' => 'm_id'),
                array('db' => 'm_name', 'dt' => 'm_name'),
                array('db' => 'm_created_at', 'dt' => 'm_created_at'),
                array('db' => 'm_updated_at', 'dt' => 'm_updated_at'),
                array(
                    'db' => 'm_id',
                    'dt' => 'tindakan',
                    'formatter' => function($m_id) {
                        return '<a class="btn btn-info btn-sm mb" href="'.site_url('major/edit/'.$m_id).'">Ubah</a>
                        <a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('major/delete/'.$m_id).'">Hapus</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = NULL;

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "m_is_deleted = 'FALSE'", $qjoin)
            );
        }
    }

    public function add()
    {
        $this->load->helper(['form', 'notification']);

        if ($this->validation()) {

            $m_id = $this->input->post('m_id', TRUE);
            $m_name = $this->input->post('m_name', TRUE);
            $where = "m_id = '$m_id' OR m_name = '$m_name'";

            $data = $this->m_majors->is_exist($where);
            if (strtolower($data['m_name']) === strtolower($this->input->post('m_name', TRUE))) {
                $this->session->set_flashdata('alert', error('Nama Program Keahlian sudah ada!'));
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Program Keahlian";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/major-form';
                $this->load->view('dashboard/index', $data);

            } else if (strtolower($data['m_id']) === strtolower($this->input->post('m_id', TRUE))) {
                $this->session->set_flashdata('alert', error('Inisial Program Keahlian sudah ada!'));
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Program Keahlian";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/major-form';
                $this->load->view('dashboard/index', $data);

            } else {
                $data = [
                    'm_id' => strtoupper($this->input->post('m_id', TRUE)),
                    'm_name' => ucfirst($this->input->post('m_name', TRUE)),
                    'm_created_by' => $this->session->userdata['u_id'],
                    'm_is_deleted' => 'FALSE'
                ];

                $this->m_majors->add($data);
                $this->session->set_flashdata('alert', success('Data program keahlian berhasil ditambahkan.'));
                $data['title'] = "Data ".self::$title;
                $data['content'] = "dashboard/major";
                redirect('major');
            }

        } else {
            $data['major'] = FALSE;
            $data['title'] = "Tambah ".self::$title;
            $data['form_title'] = "Tambah Program Keahlian";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/major-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function edit()
    {
        $this->load->helper(['form', 'notification']);
        $m_id = $this->uri->segment(3);

        if ($this->validation()) {

            $data = [
                'm_id' => strtoupper($this->input->post('m_id', TRUE)),
                'm_name' => ucfirst($this->input->post('m_name', TRUE)),
                'm_updated_at' => date('Y-m-d H:i:s'),
                'm_updated_by' => $this->session->userdata['u_id']
            ];

            $this->m_majors->edit($data, $m_id);
            $this->session->set_flashdata('alert', success('Data program keahlian berhasil diperbarui.'));
            $data['title'] = "Data ".self::$title;
            $data['content'] = "dashboard/major";
            redirect('major');

        } else {
            $where = "m_id = '$m_id'";

            $data['major'] = $this->m_majors->get_majors($where);
            $data['title'] = "Edit ".self::$title;
            $data['form_title'] = "Tambah Program Keahlian";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/major-form';
            if (!$m_id) {
                redirect('major');
            } else {
                $this->load->view('dashboard/index', $data);
            }
        }
    }

    public function delete($m_id)
    {
        $this->load->helper('notification');

        $data = [
            'm_deleted_at' => date('Y-m-d H:i:s'),
            'm_deleted_by' => $this->session->userdata['u_id'],
            'm_is_deleted' => TRUE
        ];

        $this->m_majors->delete($data, $m_id);
        $this->session->set_flashdata('alert', success('Data program keahlian berhasil dihapus.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/major";
        $this->load->view('dashboard/index', $data);
        redirect('major');
    }

    public function deleted()
    {
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/major-deleted";
        $this->load->view('dashboard/index', $data);
    }

    public function get_deleted()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'm_id', 'dt' => 'm_id'),
                array('db' => 'm_name', 'dt' => 'm_name'),
                array('db' => 'm_created_at', 'dt' => 'm_created_at'),
                array('db' => 'm_deleted_at', 'dt' => 'm_deleted_at'),
                array(
                    'db' => 'm_id',
                    'dt' => 'tindakan',
                    'formatter' => function($m_id) {
                        return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('major/restore/'.$m_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = NULL;

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "m_is_deleted = 'TRUE'", $qjoin)
            );
        }
    }

    public function restore()
    {
        $this->load->helper('notification');
        $m_id = $this->uri->segment(3);

        $data = [
			'm_restored_at' => date('Y-m-d H:i:s'),
			'm_restored_by' => $this->session->userdata['u_id'],
			'm_is_deleted' => 'FALSE'
		];

        $this->m_majors->restore($data, $m_id);
        $this->session->set_flashdata('alert', success('Data program keahlian berhasil direstore.'));
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/major-deleted";
        redirect('major/deleted');
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('m_name', 'Nama Program Keahlian', 'trim|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('m_id', 'Inisial Program Keahlian', 'trim|required|alpha|max_length[5]');
        return $this->form_validation->run();
    }

}
