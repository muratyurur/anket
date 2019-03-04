<?php

class Dashboard_model extends CI_Model
{
    /** Defining Table Name */
    public $tableName = "secmen";

    public function __construct()
    {
    	parent::__construct();
    }

    /** The method of returning all row's with limit for pagination */
    public function get_records($where = array(), $limit, $count, $order = "sokak ASC")
    {
        return $this->db->where($where)->limit($limit, $count)->order_by($order)->get($this->tableName)->result();
    }

    /** The method of returning count of records */
    public function get_count($where = array())
    {
        return $this->db->where($where)->from($this->tableName)->count_all_results();
    }

    /** The method of returning count of people by towns */
    public function get_towncount()
    {
        return $this->db->select("m.tanim, COUNT(mahalle) as sayi")->join("mahalle m", "m.id = s.mahalle", "inner")->group_by("m.tanim")->get("secmen s")->result();
    }

    /** The method of returning count of people by towns */
    public function get_durumcount()
    {
        return $this->db->select("CASE durum WHEN 'G' THEN 'Görüşüldü' WHEN 'B' THEN 'Evde Bulunamadı' WHEN 'R' THEN 'Görüşmeyi Reddetti' ELSE 'Henüz Görüşülmedi'
	END AS durum, COUNT(*) AS sayi")->where("updatedAt IS NOT NULL")->group_by("durum")->get("secmen s")->result();
    }

    /** The method of returning count of people by towns */
    public function get_mdurumcount()
    {
        return $this->db->select("m.tanim, SUM(CASE WHEN s.durum = 'G' THEN 1 ELSE 0 END) \"Görüşüldü\", SUM(CASE WHEN s.durum = 'B' THEN 1 ELSE 0 END) \"Evde Bulunamadı\", SUM(CASE WHEN s.durum = 'R' THEN 1 ELSE 0 END) \"Görüşmeyi Reddetti\", SUM(CASE WHEN s.durum IS NULL THEN 1 ELSE 0 END) \"Henüz Görüşülmedi\"")->join("mahalle m", "m.id = s.mahalle", "inner")->group_by("m.tanim")->get("secmen s")->result_array();
    }

    /** The method of returning count of people by towns */
    public function get_topdurumcount()
    {
        return $this->db->select("SUM(CASE WHEN s.durum = 'G' THEN 1 ELSE 0 END) \"Görüşüldü\", SUM(CASE WHEN s.durum = 'B' THEN 1 ELSE 0 END) \"Evde Bulunamadı\", SUM(CASE WHEN s.durum = 'R' THEN 1 ELSE 0 END) \"Görüşmeyi Reddetti\", SUM(CASE WHEN s.durum IS NULL THEN 1 ELSE 0 END) \"Henüz Görüşülmedi\"")->get("secmen s")->result_array();
    }

    /** The method of returning count of people by towns */
    public function get_tuzlakartcount()
    {
        return $this->db->select("CASE tuzlakart WHEN 'E' THEN 'Teslim Aldı' WHEN 'H' THEN 'Teslim Edilemedi' WHEN 'I' THEN 'İstemedi' WHEN 'V' THEN 'Kartı Var' ELSE 'Henüz Görüşülmedi'
	END AS durum, COUNT(*) AS sayi")->where("updatedAt IS NOT NULL")->group_by("tuzlakart")->get("secmen")->result();
    }

    /** The method of returning count of people by towns */
    public function get_mtuzlakartcount()
    {
        return $this->db->select("m.tanim, SUM(CASE WHEN s.tuzlakart = 'E' THEN 1 ELSE 0 END) \"Teslim Aldı\", SUM(CASE WHEN s.tuzlakart = 'H' THEN 1 ELSE 0 END) \"Teslim Edilemedi\", SUM(CASE WHEN s.tuzlakart = 'I' THEN 1 ELSE 0 END) \"İstemedi\", SUM(CASE WHEN s.tuzlakart = 'V' THEN 1 ELSE 0 END) \"Kartı Var\"")->join("mahalle m", "m.id = s.mahalle", "inner")->group_by("m.tanim")->get("secmen s")->result_array();
    }

    public function get_toptuzlakartcount()
    {
        return $this->db->select("SUM(CASE WHEN s.tuzlakart = 'E' THEN 1 ELSE 0 END) \"Teslim Aldı\", SUM(CASE WHEN s.tuzlakart = 'H' THEN 1 ELSE 0 END) \"Teslim Edilemedi\", SUM(CASE WHEN s.tuzlakart = 'I' THEN 1 ELSE 0 END) \"İstemedi\", SUM(CASE WHEN s.tuzlakart = 'V' THEN 1 ELSE 0 END) \"Kartı Var\"")->get("secmen s")->result_array();
    }

    /** The method of returning count of people by towns */
    public function get_memnuniyetcount()
    {
        return $this->db->select("CASE memnuniyet WHEN 'E' THEN 'Memnun' WHEN 'H' THEN 'Memnun Değil' WHEN 'K' THEN 'Kısmen Memnun' WHEN 'C' THEN 'Cevap Vermedi' ELSE 'Henüz Görüşülmedi'
	END AS durum, COUNT(*) AS sayi")->where("updatedAt IS NOT NULL and memnuniyet != 'B'")->group_by("memnuniyet")->order_by("durum")->get("secmen")->result();
    }

    /** The method of returning count of people by towns */
    public function get_mmemnuniyetcount()
    {
        return $this->db->select("m.tanim, SUM(CASE WHEN s.memnuniyet = 'B' THEN 1 ELSE 0 END) \"Evde Bulunamadı\", SUM(CASE WHEN s.memnuniyet = 'E' THEN 1 ELSE 0 END) \"Memnun\", SUM(CASE WHEN s.memnuniyet = 'H' THEN 1 ELSE 0 END) \"Memnun Değil\", SUM(CASE WHEN s.memnuniyet = 'K' THEN 1 ELSE 0 END) \"Kısmen Memnun\", SUM(CASE WHEN s.memnuniyet = 'C' THEN 1 ELSE 0 END) \"Cevap Vermedi\"")->join("mahalle m", "m.id = s.mahalle", "inner")->group_by("m.tanim")->get("secmen s")->result_array();
    }

    /** The method of returning count of people by towns */
    public function get_topmemnuniyetcount()
    {
        return $this->db->select("SUM(CASE WHEN s.memnuniyet = 'B' THEN 1 ELSE 0 END) \"Evde Bulunamadı\", SUM(CASE WHEN s.memnuniyet = 'E' THEN 1 ELSE 0 END) \"Memnun\", SUM(CASE WHEN s.memnuniyet = 'H' THEN 1 ELSE 0 END) \"Memnun Değil\", SUM(CASE WHEN s.memnuniyet = 'K' THEN 1 ELSE 0 END) \"Kısmen Memnun\", SUM(CASE WHEN s.memnuniyet = 'C' THEN 1 ELSE 0 END) \"Cevap Vermedi\"")->get("secmen s")->result_array();
    }

    /** The method of returning count of people by towns */
    public function get_mudurluktalepcount()
    {
        return $this->db->select("m.kisatanim, COUNT(mudurluk) as sayi")->join("mudurluk m", "m.id = s.mudurluk", "inner")->where("s.istek is not null")->group_by("m.tanim")->get("talep s")->result();
    }

    public function get_mahalletalepcount()
    {
        return $this->db->select("m.tanim, COUNT(s.mahalle) as sayi")->join("secmen s", "s.id = t.secmen", "inner")->join("mahalle m", "m.id = s.mahalle", "inner")->group_by("m.tanim")->get("talep t")->result();
    }

    /**  The method of returning all row's data that meets the requirements in the table */
    public function get_all($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public function get_tasks($where = array(), $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get("ekip_sokak")->result();
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