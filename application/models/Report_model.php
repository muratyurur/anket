<?php

class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /** The method of returning count of records */
    public function get_count($where = array())
    {
        return $this->db->where($where)->from("secmen s")->count_all_results();
    }

    /** The method of returning all row's with limit for pagination */
    public function genel_durum_ozet($limit, $count, $order = "mahalle ASC")
    {
        return $this->db->select("mahalle,
               COUNT(*) 'SECMEN',
               SUM(CASE WHEN tuzlakart = 'V' THEN 1 ELSE 0 END) 'V',
               SUM(CASE WHEN tuzlakart = 'V' AND durum = 'G' THEN 1 ELSE 0 END) 'VG',
               SUM(CASE WHEN tuzlakart = 'E' AND durum = 'G' THEN 1 ELSE 0 END) 'EG',
               SUM(CASE WHEN tuzlakart = 'I' AND durum = 'G' THEN 1 ELSE 0 END) 'IG',
               SUM(CASE WHEN tuzlakart = 'T' AND durum = 'T' THEN 1 ELSE 0 END) 'TT',
               SUM(CASE WHEN tuzlakart = 'H' AND durum = 'B' THEN 1 ELSE 0 END) 'HB',
               COUNT(*) - (SUM(CASE WHEN tuzlakart = 'V' AND durum = 'G' THEN 1 ELSE 0 END) +
               SUM(CASE WHEN tuzlakart = 'E' AND durum = 'G' THEN 1 ELSE 0 END) +
               SUM(CASE WHEN tuzlakart = 'I' AND durum = 'G' THEN 1 ELSE 0 END) +
               SUM(CASE WHEN tuzlakart = 'T' AND durum = 'T' THEN 1 ELSE 0 END)) 'KALAN',
               SUM(CASE WHEN memnuniyet = 'E' THEN 1 ELSE 0 END) 'M',
               SUM(CASE WHEN memnuniyet = 'K' THEN 1 ELSE 0 END) 'KM',
               SUM(CASE WHEN memnuniyet = 'H' THEN 1 ELSE 0 END) 'MD',
               SUM(CASE WHEN memnuniyet = 'C' THEN 1 ELSE 0 END) 'C',
               SUM(CASE WHEN memnuniyet = 'B' THEN 1 ELSE 0 END) 'EB',
               SUM(CASE WHEN updatedAt IS NOT NULL THEN 1 ELSE 0 END) 'TG',
               SUM(CASE WHEN memnuniyet = 'E' THEN 1 ELSE 0 END) / SUM(CASE WHEN durum IS NOT NULL AND durum != 'B' AND durum != 'A' AND durum != 'R' THEN 1 ELSE 0 END) 'MO'")
            ->limit($limit, $count)
            ->group_by("mahalle")
            ->order_by($order)
            ->get("secmen")
            ->result();
    }

    public function gdo_excel($order = "mahalle ASC")
    {
        return $this->db->select("mahalle,
               COUNT(*) 'SECMEN',
               SUM(CASE WHEN tuzlakart = 'V' THEN 1 ELSE 0 END) 'V',
               SUM(CASE WHEN tuzlakart = 'V' AND durum = 'G' THEN 1 ELSE 0 END) 'VG',
               SUM(CASE WHEN tuzlakart = 'E' AND durum = 'G' THEN 1 ELSE 0 END) 'EG',
               SUM(CASE WHEN tuzlakart = 'I' AND durum = 'G' THEN 1 ELSE 0 END) 'IG',
               SUM(CASE WHEN tuzlakart = 'T' AND durum = 'T' THEN 1 ELSE 0 END) 'TT',
               SUM(CASE WHEN tuzlakart = 'H' AND durum = 'B' THEN 1 ELSE 0 END) 'HB',
               COUNT(*) - (SUM(CASE WHEN tuzlakart = 'V' AND durum = 'G' THEN 1 ELSE 0 END) +
               SUM(CASE WHEN tuzlakart = 'E' AND durum = 'G' THEN 1 ELSE 0 END) +
               SUM(CASE WHEN tuzlakart = 'I' AND durum = 'G' THEN 1 ELSE 0 END) +
               SUM(CASE WHEN tuzlakart = 'T' AND durum = 'T' THEN 1 ELSE 0 END)) 'KALAN',
               SUM(CASE WHEN memnuniyet = 'E' THEN 1 ELSE 0 END) 'M',
               SUM(CASE WHEN memnuniyet = 'K' THEN 1 ELSE 0 END) 'KM',
               SUM(CASE WHEN memnuniyet = 'H' THEN 1 ELSE 0 END) 'MD',
               SUM(CASE WHEN memnuniyet = 'C' THEN 1 ELSE 0 END) 'C',
               SUM(CASE WHEN memnuniyet = 'B' THEN 1 ELSE 0 END) 'EB',
               SUM(CASE WHEN updatedAt IS NOT NULL THEN 1 ELSE 0 END) 'TG',
               SUM(CASE WHEN memnuniyet = 'E' THEN 1 ELSE 0 END) / SUM(CASE WHEN durum IS NOT NULL AND durum != 'B' AND durum != 'A' AND durum != 'R' THEN 1 ELSE 0 END) 'MO'")
            ->group_by("mahalle")
            ->order_by($order)
            ->get("secmen")
            ->result();
    }

    /** The method of returning all row's with limit for pagination */
    public function genel_durum_detay($where, $limit, $count, $order = "s.updatedAt DESC")
    {
        return $this->db->select("s.adi 'adi',
	s.soyadi 'soyadi',
	s.tckimlikno 'tckimlikno',
	s.gsm1 'gsm1',
	s.gsm2 'gsm2',
	s.eposta 'eposta',
	m.tanim 'mahalle',
	sk.tanim 'sokak',
	s.kapi 'kapi',
	s.daire 'daire',
	case
		s.durum
		when 'G' then 'GÖRÜŞÜLDÜ'
		when 'R' then 'GÖRÜŞMEYİ REDDETTİ'
		when 'B' then 'EVDE BULUNAMADI'
		when 'T' then 'BELEDİYEDE GÖRÜŞÜLDÜ'
		when 'A' then 'ADRES BULUNAMADI'
	end 'durum',
	case
		s.tuzlakart
		when 'E' then 'TESLİM EDİLDİ'
		when 'H' then 'TESLİM EDİLEMEDİ'
		when 'I' then 'İSTEMEDİ'
		when 'V' then 'KARTI VAR'
		when 'T' then 'BELEDİYEDE TESLİM EDİLDİ'
	end 'tuzlakart',
	case
		s.memnuniyet
		when 'E' then 'MEMNUN'
		when 'H' then 'MEMNUN DEĞİL'
		when 'K' then 'KISMEN MEMNUN'
		when 'C' then 'CEVAP VERMEDİ'
		when 'B' then 'EVDE BULUNAMADI'
	end 'memnuniyet',
	case
		s.gorusulen
		when '1' then '+'
	end 'gorusulen',
	DATE_FORMAT(s.updatedAt, '%d/%m/%Y') 'updatedAt',
	u.full_name 'full_name'")
            ->limit($limit, $count)
            ->join("mahalle m", "m.id = s.mahalle", "inner")
            ->join("sokak sk", "s.sokak = sk.id", "inner")
            ->join("users u", "s.updatedBy = u.id", "inner")
            ->where($where)
            ->order_by($order)
            ->get("secmen s")
            ->result();
    }

    /** The method of returning all row's with limit for pagination */
    public function gdd_detay($where = array(""), $order = "s.updatedAt DESC")
    {
        $this->db->select("s.adi 'adi',
	s.soyadi 'soyadi',
	s.tckimlikno 'tckimlikno',
	s.gsm1 'gsm1',
	s.gsm2 'gsm2',
	s.eposta 'eposta',
	m.tanim 'mahalle',
	sk.tanim 'sokak',
	s.kapi 'kapi',
	s.daire 'daire',
	case
		s.durum
		when 'G' then 'GÖRÜŞÜLDÜ'
		when 'R' then 'GÖRÜŞMEYİ REDDETTİ'
		when 'B' then 'EVDE BULUNAMADI'
		when 'T' then 'BELEDİYEDE GÖRÜŞÜLDÜ'
		when 'A' then 'ADRES BULUNAMADI'
	end 'durum',
	case
		s.tuzlakart
		when 'E' then 'TESLİM EDİLDİ'
		when 'H' then 'TESLİM EDİLEMEDİ'
		when 'I' then 'İSTEMEDİ'
		when 'V' then 'KARTI VAR'
		when 'T' then 'BELEDİYEDE TESLİM EDİLDİ'
	end 'tuzlakart',
	case
		s.memnuniyet
		when 'E' then 'MEMNUN'
		when 'H' then 'MEMNUN DEĞİL'
		when 'K' then 'KISMEN MEMNUN'
		when 'C' then 'CEVAP VERMEDİ'
		when 'B' then 'EVDE BULUNAMADI'
	end 'memnuniyet',
	case
		s.gorusulen
		when '1' then '+'
	end 'gorusulen',
	DATE_FORMAT(s.updatedAt, '%d/%m/%Y') 'updatedAt',
	u.full_name 'full_name'");
            $this->db->join("mahalle m", "m.id = s.mahalle", "inner");
            $this->db->join("sokak sk", "s.sokak = sk.id", "inner");
            $this->db->join("users u", "s.updatedBy = u.id", "inner");
            $this->db->where($where);
            $this->db->order_by($order);
            $query = $this->db->get("secmen s");
            return $query->result_array();
    }
}