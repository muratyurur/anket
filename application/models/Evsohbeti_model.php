<?php

class Evsohbeti_model extends CI_Model
{
    /** Defining Table Name */
    public $tableName = "evsohbeti";

    public function __construct()
    {
    	parent::__construct();
    }

    /** The method of returning all row's with limit for pagination */
    public function get_records($where = array(), $limit, $count, $order = "tarih DESC")
    {
        return $this->db->where($where)->limit($limit, $count)->order_by($order)->get($this->tableName)->result();
    }

    /** The method of returning name and surname*/
    public function get_person($where = array())
    {
        return $this->db->select("CONCAT_WS(' ', adi, soyadi) AS Kisi")->where($where)->get($this->tableName)->row();
    }

    /** The method of returning ballot boxes*/
    public function get_boxlist()
    {
        $this->db->distinct();
        return $this->db->select("sandik_no as sandiklar")->order_by(1)->get($this->tableName)->result();
    }

    /** The method of returning ballot boxes*/
    public function get_schools()
    {
        $this->db->distinct();
        return $this->db->select("sandik_alani as okullar")->order_by(1)->get($this->tableName)->result();
    }

    /** The method of returning count of records */
    public function get_count($where = array())
    {
        return $this->db->where($where)->from($this->tableName)->count_all_results();
    }

    /** The method of returning count of records */
    public function get_bina($where = array())
    {
        return $this->db->select("distinct(sokak), kapi")->where($where)->get($this->tableName)->num_rows();
    }

    /** The method of returning count of records */
    public function get_hane($where = array())
    {
        return $this->db->select("distinct(sokak), kapi, daire")->where($where)->get($this->tableName)->num_rows();
    }

    /**  The method of returning all row's data that meets the requirements in the table */
    public function get_all($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public  function get_secmen_list($where = array())
    {
        return $this->db->select("id, adi || ' ' || soyadi as secmen")->where($where)->order_by( $order = "2")->get($this->tableName)->result();
    }

    /**  The Method to Returning the Specific Row's Data that Meets the Requirements from the Table */
    public function get($where = array())
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /**  The Method for Inserting Data Sent from Form to the Table */
    public function add($data = array())
    {
        return $this->db->insert($this->tableName, $data);
    }

    /**  The Method to Updating the Specific Row's Data that Meets the Requirements in the Table */
    public function update($where=array(), $data = array())
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    /**  The Method to Deleting the Specific Row that Meets the Requirements in the Table */
    public function delete($where=array())
    {
        return $this->db->where($where)->delete($this->tableName);
    }
}