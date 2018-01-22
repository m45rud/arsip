<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_folders extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'folders';
	private static $pk = 'f_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function add($data)
	{
    	return $this->db->insert(self::$table, $data);
	}

	public function get_folders($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function edit($data, $f_id)
	{
		return $this->db->set($data)->where(self::$pk, $f_id)->update(self::$table);
	}

	public function delete($data, $f_id)
	{
		return $this->db->set($data)->where(self::$pk, $f_id)->update(self::$table);
	}

	public function restore($data, $f_id)
	{
		return $this->db->set($data)->where(self::$pk, $f_id)->update(self::$table);
	}
}
