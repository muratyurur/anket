<?php

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "reports_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("report_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
    }

    public function genel_durum_ozet()
    {
        $viewData = new stdClass();

        $this->session->unset_userdata("where");

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->load->library("pagination");

        $config["base_url"] = base_url("anket/index");
        $config["total_rows"] = $this->report_model->get_count(array(""));
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";


        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->report_model->genel_durum_ozet(
            $config["per_page"],
            $page
        );

        $viewData->count = $config["total_rows"];

        $viewData->percount = $config["per_page"];

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "genel_durum_ozet";
        $viewData->items = $items;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gdo_excel()
    {
        /** Taking all data from the table */
        $items = $this->report_model->gdo_excel();

        require APPPATH . "third_party/PHPExcel-1.8/Classes/PHPExcel.php";
        require APPPATH . "third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php";

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("");
        $objPHPExcel->getProperties()->setLastModifiedBy("");
        $objPHPExcel->getProperties()->setTitle("");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );

        foreach (range('A', 'N') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "1")->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "2")->applyFromArray($styleArray);
        }

        $objPHPExcel->getActiveSheet()->mergeCells('B1:C1');
        $objPHPExcel->getActiveSheet()->mergeCells('D1:N1');

        $objPHPExcel->getActiveSheet()->setCellValue('B1', "SABİT VERİLER");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "DEĞİŞKEN VERİLER");

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "MAHALLE");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "SEÇMEN SAYISI");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "KARTI OLAN (SEÇMEN)");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "KARTI OLAN (GÖRÜŞÜLEN)");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "TESLİM EDİLEN (KART)");
        $objPHPExcel->getActiveSheet()->setCellValue('F2', "İSTEMEYEN (KART)");
        $objPHPExcel->getActiveSheet()->setCellValue('G2', "GÖRÜŞÜLEMEYEN");
        $objPHPExcel->getActiveSheet()->setCellValue('H2', "KALAN");
        $objPHPExcel->getActiveSheet()->setCellValue('I2', "MEMNUN");
        $objPHPExcel->getActiveSheet()->setCellValue('J2', "KISMEN MEMNUN");
        $objPHPExcel->getActiveSheet()->setCellValue('K2', "MEMNUN DEĞİL");
        $objPHPExcel->getActiveSheet()->setCellValue('L2', "CEVAP VERMEDİ");
        $objPHPExcel->getActiveSheet()->setCellValue('M2', "TOPLAM GÖRÜŞÜLEN");
        $objPHPExcel->getActiveSheet()->setCellValue('N2', "MEMNUNİYET ORANI");

        $row = 3;

        foreach ($items as $item) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, get_townname($item->mahalle));
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $item->SECMEN);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $item->V);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $item->VG);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $item->EG);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $item->IG);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $item->HB);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $item->KALAN);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $item->M);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $item->KM);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $item->MD);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $item->C);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $item->TG);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, $item->MO);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $fileName = date("YdmHis") . "-genel_durum.xlsx";

        $objPHPExcel->getActiveSheet()->setTitle(date("d.m.Y"));

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function clear_session()
    {
        $this->session->unset_userdata("where");
        redirect(base_url("reports/genel_durum_detay"));
    }

    public function genel_durum_detay()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "reports");
            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        }

        $where = array();

        if ($this->input->post('adi')) {
            $where['adi'] = $this->input->post("adi");
            $viewData->set_adi = $this->input->post("adi");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('soyadi')) {
            $where['soyadi'] = $this->input->post("soyadi");
            $viewData->set_soyadi = $this->input->post("soyadi");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('tckimlikno')) {
            $where['tckimlikno'] = $this->input->post("tckimlikno");
            $viewData->set_tckimlikno = $this->input->post("tckimlikno");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('mahalle')) {
            $where['mahalle'] = $this->input->post("mahalle");
            $viewData->set_mahalle = $this->input->post("mahalle");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sokak')) {
            $where['sokak'] = $this->input->post("sokak");
            $viewData->set_sokak = $this->input->post("sokak");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('kapi')) {
            $where['kapi'] = $this->input->post("kapi");
            $viewData->set_kapi = $where['kapi'];
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('daire')) {
            $where['daire'] = $this->input->post("daire");
            $viewData->set_daire = $this->input->post("daire");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('ilktarih')) {
            $var = $this->input->post("ilktarih");

            $ilktar = str_replace('/', '-', $var);

            $ilktarih = date('Y-m-d', strtotime($ilktar));

            $where['t.talepTarihi >='] = $ilktarih;
            $viewData->set_ilktarih = $this->input->post("ilktarih");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sontarih')) {
            $var = $this->input->post("sontarih");

            $sontar = str_replace('/', '-', $var);

            $sontarih = date('Y-m-d', strtotime($sontar));

            $where['t.talepTarihi <='] = $sontarih;
            $viewData->set_sontarih = $this->input->post("sontarih");
            $this->session->set_userdata("where", $where);
        }

        $condition = $this->session->userdata("where");

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->load->library("pagination");

        $config["base_url"] = base_url("reports/genel_durum_detay/index");
        $config["total_rows"] = $this->report_model->get_count($condition ? $condition : "updatedAt is not null");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 4;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";


        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->report_model->genel_durum_detay(
            $where,
            $config["per_page"],
            $page
        );

        $viewData->count = $config["total_rows"];

        $viewData->percount = $config["per_page"];

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "genel_durum_detay";
        $viewData->items = $items;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gdd_csv()
    {
        $condition = $this->session->userdata("where");

        // get data
        $items = $this->report_model->gdd_detay();

        // file name
        $fileName = "GENEL DURUM " . date("YmdHi") . ".csv";
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/csv; ");

        // file creation
        $file = fopen('php://output', 'w');

        $header = array('ADI',
            'SOYADI',
            'T.C. KİMLİK NO.',
            'CEP TELEFONU 1',
            'CEP TELEFONU 2',
            'EPOSTA ADRESİ',
            'MAHALLE',
            'SOKAK',
            'KAPI NO.',
            'DAİRE NO.',
            'GÖRÜŞME DURUMU',
            'TUZLAKART TESLİM DURUMU',
            'MEMNUNİYET',
            'TESLİM EDİLEN',
            'TARİH',
            'ANKETÖR');
        fputcsv($file, $header);

        foreach ($items as $item) {
            fputcsv($file,
                array(
                    $item->adi,
                    $item->soyadi,
                    $item->tckimlikno,
                    $item->gsm1,
                    $item->gsm2,
                    $item->eposta,
                    $item->mahalle,
                    $item->sokak,
                    $item->kapi,
                    $item->daire,
                    $item->durum,
                    $item->tuzlakart,
                    $item->memnuniyet,
                    $item->gorusulen,
                    $item->updatedAt,
                    $item->full_name,
                ));
        }

        fclose($file);
        exit;
    }

    public function exportData()
    {
        $fileName = "GENEL DURUM " . date("YmdHi") . ".csv";

        $this->load->dbutil();

        $query = $this->db->query("SELECT * FROM mahalle");

        $delimiter = ";";
        $newline = "\r\n";
        $enclosure = '"';

        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        $this->load->helper('file');

        if (!write_file('/tmp/' . $fileName . '.csv', $data)) {
            echo 'Unable to write the file';
        } else {
            echo 'File written!';
        }
    }

//        $fileName = "GENEL DURUM " . date("YmdHi") . ".csv";
//
//        header('Content-type:text/csv');
//        header('Content-Disposition:attachment;filename=' . $fileName);
//        header('Cache-Control:no-store, no-cache, must-revalidate');
//        header('Cache-Control:post-check=0, pre-check=0');
//        header('Pragma:no-cache');
//        header('Expires:0');
//
//        $handle = fopen('php://output', 'w');
//
//        fputcsv($handle, array(
//            'ADI',
//            'SOYADI',
//            'T.C. KİMLİK NO.',
//            'CEP TELEFONU 1',
//            'CEP TELEFONU 2',
//            'EPOSTA ADRESİ',
//            'MAHALLE',
//            'SOKAK',
//            'KAPI NO.',
//            'DAİRE NO.',
//            'GÖRÜŞME DURUMU',
//            'TUZLAKART TESLİM DURUMU',
//            'MEMNUNİYET',
//            'TESLİM EDİLEN',
//            'TARİH',
//            'ANKETÖR'
//        ));
//
//        $data['rapor'] = $this->report_model->gdd_detay(
//            $condition ? $condition : "s.updatedAt is not null"
//        );
//
//        foreach ($data['rapor'] as $as => $row) {
//            foreach ($row as $key => $value)
//            {
//                fwrite($handle, ucfirst($key) . ": $value\r\n");
//            }
//            fwrite($handle, "\r\n");
//        }
//        fclose($handle);
//        exit;
//    }

}