<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_borrows extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'documents';

	public function get_documents()
	{
		return $this->db->get(self::$table)->result_array();
	}
	public function get_bri($wbri)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('students', 'students.s_id = documents.d_sid', 'left')
					->where($wbri)
					->get();

		if ($query->num_rows() > 0) {
	     	return $query->result_array();
        } else {
        	return NULL;
        }
	}

	public function get_brs($wbrs)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('students', 'students.s_id = documents.d_sid', 'left')
					->where($wbrs)
					->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return NULL;
		}
	}
}
