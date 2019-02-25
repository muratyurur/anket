<?php

class Talep_model extends CI_Model
{
    /** Defining Table Name */
    public $tableName = "talep";

    public function __construct()
    {
    	parent::__construct();
    }

    /** The method of returning all row's with limit for pagination */
    public function get_records($where = array(), $limit, $count, $order = "talepTarihi ASC")
    {
        return $this->db->select("t.id talep_id, t.talepTarihi, t.kaynak, 
        s.mahalle, s.id, t.istek, t.mudurluk, t.sonucDurumu, 
        t.sonucTarihi, t.sonucAciklama")
            ->where($where)
            ->join("secmen s", "t.secmen = s.id", "left outer")
            ->limit($limit, $count)
            ->order_by($order)
            ->get("talep t")->result();
    }
    /** The method of returning all row's with limit for pagination */
    public function excel_export($where = array(), $limit, $count, $order = "talepTarihi ASC")
    {
        return $this->db->select("t.id talep_id, t.talepTarihi, t.kaynak, 
        m.tanim mahalle, sk.tanim sokak, s.kapi kapi, s.daire daire, 
        t.talepeden talepeden, t.irtibat, t.istek, mu.tanim mudurluk, 
        td.title sonucDurumu, t.sonucTarihi, t.sonucAciklama, u.full_name")
            ->where($where)
            ->join("secmen s", "t.secmen = s.id", "left outer")
            ->join("mahalle m", "m.id = s.mahalle", "left outer")
            ->join("sokak sk", "sk.id = s.sokak", "left outer")
            ->join("mudurluk mu", "mu.id = t.mudurluk", "left outer")
            ->join("talep_durumu td", "td.id = t.sonucDurumu", "left outer")
            ->join("users u", "u.id = s.updatedBy", "left outer")
            ->limit($limit, $count)
            ->order_by($order)
            ->get("talep t")->result();
    }

    /** The method of returning count of records */
    public function get_count($where = array())
    {
        return $this->db->where($where)
            ->from("talep t")
            ->join("secmen s", "t.secmen = s.id", "left outer")
            ->count_all_results();
    }

    /**  The method of returning all row's data that meets the requirements in the table */
    public function get_all($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    /**  The Method to Returning the Specific Row's Data that Meets the Requirements from the Table */
    public function get($where = array())
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /**  The Method to Returning the Specific Row's Data that Meets the Requirements from the Table */
    public function gett($where = array())
    {
        return $this->db->where($where)->join("secmen", "talep.secmen = secmen.id", "inner")->join("mahalle", "mahalle.id = secmen.mahalle", "inner")->get($this->tableName)->row();
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