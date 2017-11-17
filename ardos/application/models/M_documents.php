<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_documents extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'documents';
	private static $pk = 'd_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function is_exist_km($wkm)
	{
		return $this->db->where($wkm)->get(self::$table)->row_array();
	}

	public function get_documents($where)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('students', 'students.s_id = documents.d_sid', 'left')
					->join('majors', 'majors.m_id = students.s_mid', 'left')
					->where($where)
					->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_details($where)
	{
		$query = $this
					->db
					->select('*')
					->from('archived_documents')
					->join('students', 'students.s_id = archived_documents.ad_sid', 'left')
					->join('majors', 'majors.m_id = students.s_mid', 'left')
					->where($where)
					->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_bi($whi)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->where($whi)
					->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_bs($whs)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->where($whs)
					->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function use_get_documents($where)
	{
		$query = $this->db->where($where)->get(self::$table);

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_cabinets($wc)
	{
		return $this->db->where($wc)->get('cabinets');
	}

	public function get_folders($wf)
	{
		return $this->db->where($wf)->get('folders');
	}

	public function gm($where)
	{
		$query = $this->db->where($where)->get(self::$table);

		if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
	}

	public function get_maps($where)
	{
		$query = $this->db->where($where)->get(self::$table);

		if ($query->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	public function get_last()
	{
		$query = $this->db->select('d_kode_map')->order_by('d_created_at',"desc")->limit(1)->get(self::$table);

		if ($query->num_rows() > 0) {
			return $query->row_array();
		}
	}

	public function get_result($keyword, $where)
	{
		$query = $this
					->db
					->select('*')
	                ->from('students')
					->join('majors', 'majors.m_id = students.s_mid', 'left')
	                ->like('s_nisn', $keyword)
	                ->or_like('s_name', $keyword)
					->where($where)
					->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
	}

	public function add($data)
	{
    	return $this->db->insert(self::$table, $data);
	}

	public function not_empty($d_id)
	{
		return $this->db->where(self::$pk, $d_id)->get(self::$table)->row_array();
	}

	public function edit($data, $d_id)
	{
		return $this->db->set($data)->where(self::$pk, $d_id)->update(self::$table);
	}

	public function unactive($std, $s_id)
	{
		return $this->db->set($std)->where('s_id', $s_id)->update('students');
	}

	public function save($data)
	{
    	return $this->db->insert('archived_documents', $data);
	}

	public function delete($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function restore($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}
}
