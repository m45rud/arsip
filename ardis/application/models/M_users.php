<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'users';
	private static $pk = 'u_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function add($data)
	{
    	return $this->db->insert(self::$table, $data);
	}

	public function get_user($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function edit($data, $u_id)
	{
		return $this->db->set($data)->where(self::$pk, $u_id)->update(self::$table);
	}

	public function reset($data, $u_id)
	{
		return $this->db->set($data)->where(self::$pk, $u_id)->update(self::$table);
	}

	public function update($data, $u_id)
	{
		return $this->db->set($data)->where(self::$pk, $u_id)->update(self::$table);
	}
}
