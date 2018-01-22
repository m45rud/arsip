<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_homes extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'documents';

	public function get_result($keyword, $where)
	{
		$query = $this
					->db
					->select('*')
	                ->from(self::$table)
					->join('students', 'students.s_id = documents.d_sid', 'left')
	                ->like('s_nisn', $keyword)
	                ->or_like('s_name', $keyword)
					->where($where )
					->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
	}

	public function get_data($where)
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
}
