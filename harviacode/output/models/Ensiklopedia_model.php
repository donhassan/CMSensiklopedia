<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ensiklopedia_model extends CI_Model
{

    public $table = 'ensiklopedia';
    public $id = 'ID';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    //get field

    function get_field(){
      $table=$this->table;
      $sql=$this->db->query("SELECT * FROM `$table`"); //ganti * untuk custom field yang ditampilkan pada table
      return $sql->list_fields();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('ID', $q);
	$this->db->or_like('Nama', $q);
	$this->db->or_like('Kategori', $q);
	$this->db->or_like('Deskripsi', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('ID', $q);
	$this->db->or_like('Nama', $q);
	$this->db->or_like('Kategori', $q);
	$this->db->or_like('Deskripsi', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Ensiklopedia_model.php */
/* Location: ./application/models/Ensiklopedia_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-30 19:05:07 */
/* http://harviacode.com */