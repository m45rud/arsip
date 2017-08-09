<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_folders');
        $this->auth->restrict();
    }

    private static $title = "Bendel &minus; Arsip Dokumen Siswa | SMK Muhammadiyah 3 Nganjuk";
    private static $table = 'folders';
	private static $primaryKey = 'f_id';

    public function index()
	{
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/folder";
		$this->load->view('dashboard/index', $data);
	}

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'f_id', 'dt' => 'f_id'),
                array('db' => 'f_name', 'dt' => 'f_name'),
                array('db' => 'u_fname', 'dt' => 'u_fname'),
                array('db' => 'f_created_at', 'dt' => 'f_created_at'),
                array('db' => 'f_updated_at', 'dt' => 'f_updated_at'),
                array(
                    'db' => 'f_id',
                    'dt' => 'tindakan',
                    'formatter' => function($f_id) {
                        return '<a class="btn btn-info btn-sm mb" href="'.site_url('folder/edit/'.$f_id).'">Ubah</a>
                        <a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('folder/delete/'.$f_id).'">Hapus</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN users ON users.u_id = folders.f_created_by";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "f_is_deleted = 'FALSE'", $qjoin)
            );
        }
    }

    public function add()
    {
        $this->load->helper(['form', 'notification']);

        if ($this->validation()) {
            $f_name = $this->input->post('f_name', TRUE);
            $where = "f_name = '$f_name'";

            $data = $this->m_folders->is_exist($where);
            if (strtolower($data['f_name']) === strtolower($this->input->post('f_name', TRUE))) {
                $this->session->set_flashdata('alert', error('Nama Bendel sudah ada!'));
                $data['title'] = "Tambah ".self::$title;
                $data['form_title'] = "Tambah Bendel";
                $data['action'] = site_url(uri_string());
                $data['content'] = 'dashboard/folder-form';
                $this->load->view('dashboard/index', $data);

            } else {
                $this->load->helper('string');
                $data = [
                    'f_id' => random_string('alnum', 5),
                    'f_name' => strtoupper($this->input->post('f_name', TRUE)),
                    'f_created_by' => $this->session->userdata['u_id'],
                    'f_is_deleted' => 'FALSE'
                ];

                $this->m_folders->add($data);
                $this->session->set_flashdata('alert', success('Data Bendel berhasil ditambahkan.'));
                redirect('folder');
            }

        } else {
            $data['folder'] = FALSE;
            $data['title'] = "Tambah ".self::$title;
            $data['form_title'] = "Tambah Bendel";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/folder-form';
            $this->load->view('dashboard/index', $data);
        }
    }

    public function edit()
    {
        $this->load->helper(['form', 'notification']);
        $f_id = $this->uri->segment(3);

        if ($this->validation()) {
            $data = [
                'f_id' => $f_id,
                'f_name' => strtoupper($this->input->post('f_name', TRUE)),
                'f_updated_at' => date('Y-m-d H:i:s'),
                'f_updated_by' => $this->session->userdata['u_id']
            ];

            $this->m_folders->edit($data, $f_id);
            $this->session->set_flashdata('alert', success('Data Bendel berhasil diperbarui.'));
            redirect('folder');

        } else {
            $where = "f_id = '$f_id'";

            $data['folder'] = $this->m_folders->get_folders($where);
            $data['title'] = "Edit ".self::$title;
            $data['form_title'] = "Tambah Bendel";
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/folder-form';
            if (!$f_id) {
                redirect('folder');
            } else {
                $this->load->view('dashboard/index', $data);
            }
        }
    }

    public function delete($f_id)
    {
        $this->load->helper('notification');

        $data = [
            'f_deleted_at' => date('Y-m-d H:i:s'),
            'f_deleted_by' => $this->session->userdata['u_id'],
            'f_is_deleted' => TRUE
        ];

        $this->m_folders->delete($data, $f_id);
        $this->session->set_flashdata('alert', success('Data Bendel berhasil dihapus.'));
        redirect('folder');
    }

    public function deleted()
    {
        $data['title'] = "Data ".self::$title;
        $data['content'] = "dashboard/folder-deleted";
        $this->load->view('dashboard/index', $data);
    }

    public function get_deleted()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');
            $columns = array(
                array('db' => 'f_name', 'dt' => 'f_name'),
                array('db' => 'u_fname', 'dt' => 'u_fname'),
                array('db' => 'f_created_at', 'dt' => 'f_created_at'),
                array('db' => 'f_deleted_at', 'dt' => 'f_deleted_at'),
                array(
                    'db' => 'f_id',
                    'dt' => 'tindakan',
                    'formatter' => function($f_id) {
                        return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('folder/restore/'.$f_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
                    }
                ),
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $qjoin = "JOIN users ON users.u_id = folders.f_deleted_by";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "f_is_deleted = 'TRUE'", $qjoin)
            );
        }
    }

    public function restore()
    {
        $this->load->helper('notification');
        $f_id = $this->uri->segment(3);

        $data = [
			'f_restored_at' => date('Y-m-d H:i:s'),
			'f_restored_by' => $this->session->userdata['u_id'],
			'f_is_deleted' => 'FALSE'
		];

        $this->m_folders->restore($data, $f_id);
        $this->session->set_flashdata('alert', success('Data Bendel berhasil direstore.'));
        redirect('folder/deleted');
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('f_name', 'Nama Bendel', 'trim|required|max_length[20]');
        return $this->form_validation->run();
    }

}
