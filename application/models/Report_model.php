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
    public function genel_durum($where = array(), $limit, $count, $order = "mahalle ASC, sokak ASC, ABS(kapi), daire")
    {
        return $this->db
            ->select("s.adi adi,
	s.soyadi soyadi,
	s.tckimlikno tckimlikno,
	s.gsm1 gsm1,
	s.gsm2 gsm2,
	s.eposta eposta,
	m.tanim mahalle,
	sk.tanim sokak,
	s.kapi kapi,
	s.daire daire,
	case
		s.durum
		when 'G' then 'GÖRÜŞÜLDÜ'
		when 'R' then 'GÖRÜŞMEYİ'
		when 'B' then 'EVDE BULUNAMADI'
		when 'T' then 'BELEDİYEDE GÖRÜŞÜLDÜ'
		when 'A' then 'ADRES BULUNAMADI'
	end durum,
	case
		s.tuzlakart
		when 'E' then 'TESLİM EDİLDİ'
		when 'H' then 'TESLİM EDİLEMEDİ'
		when 'I' then 'İSTEMEDİ'
		when 'V' then 'KARTI VAR'
		when 'T' then 'BELEDİYEDE TESLİM EDİLDİ'
	end tuzlakart,
	case
		s.memnuniyet
		when 'E' then 'MEMNUN'
		when 'H' then 'MEMNUN DEĞİL'
		when 'K' then 'KISMEN MEMNUN'
		when 'C' then 'CEVAP VERMEDİ'
		when 'B' then 'EVDE BULUNAMADI'
	end memnuniyet,
	case
		s.gorusulen
		when '1' then '+'
	end gorusulen,
	DATE_FORMAT(s.updatedAt, '%d/%m/%Y') tarih,
	u.full_name anketor")
            ->join("mahalle m", "m.id = s.mahalle", "inner")
            ->join("sokak sk", "sk.id = s.sokak", "inner")
            ->join("users u", "u.id = s.updatedBy", "inner")
            ->where($where)
            ->limit($limit, $count)
            ->order_by($order)
            ->get("secmen s")
            ->result();
    }

    public function gd_excel($where = array(), $order = "mahalle ASC, sokak ASC, ABS(kapi), daire")
    {
        return $this->db
            ->select("s.adi adi,
	s.soyadi soyadi,
	s.tckimlikno tckimlikno,
	s.gsm1 gsm1,
	s.gsm2 gsm2,
	s.eposta eposta,
	m.tanim mahalle,
	sk.tanim sokak,
	s.kapi kapi,
	s.daire daire,
	case
		s.durum
		when 'G' then 'GÖRÜŞÜLDÜ'
		when 'R' then 'GÖRÜŞMEYİ'
		when 'B' then 'EVDE BULUNAMADI'
		when 'T' then 'BELEDİYEDE GÖRÜŞÜLDÜ'
		when 'A' then 'ADRES BULUNAMADI'
	end durum,
	case
		s.tuzlakart
		when 'E' then 'TESLİM EDİLDİ'
		when 'H' then 'TESLİM EDİLEMEDİ'
		when 'I' then 'İSTEMEDİ'
		when 'V' then 'KARTI VAR'
		when 'T' then 'BELEDİYEDE TESLİM EDİLDİ'
	end tuzlakart,
	case
		s.memnuniyet
		when 'E' then 'MEMNUN'
		when 'H' then 'MEMNUN DEĞİL'
		when 'K' then 'KISMEN MEMNUN'
		when 'C' then 'CEVAP VERMEDİ'
		when 'B' then 'EVDE BULUNAMADI'
	end memnuniyet,
	case
		s.gorusulen
		when '1' then '+'
	end gorusulen,
	DATE_FORMAT(s.updatedAt, '%d/%m/%Y') tarih,
	u.full_name anketor")
            ->join("mahalle m", "m.id = s.mahalle", "inner")
            ->join("sokak sk", "sk.id = s.sokak", "inner")
            ->join("users u", "u.id = s.updatedBy", "inner")
            ->where($where)
            ->order_by($order)
            ->get("secmen s")
            ->result();
    }

}