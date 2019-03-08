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

    public function genel_durum()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "anket");
            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        }

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
        $items = $this->report_model->genel_durum(
            array(""),
            $config["per_page"],
            $page,
            "mahalle, sokak, ABS(kapi), daire, soyadi, adi"
        );

        $viewData->count = $config["total_rows"];

        $viewData->percount = $config["per_page"];

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "secmen_durum";
        $viewData->items = $items;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gd_excel(){
        $condition = $this->session->userdata("where");

        /** Taking all data from the table */
        $items = $this->report_model->gd_excel(
            $condition ? $condition : "s.updatedAt is not null",
            "mahalle, sokak, ABS(kapi), daire, soyadi, adi"
        );

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

        foreach(range('A','P') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "1")->applyFromArray($styleArray);
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A1', "ADI");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "SOYADI");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "T.C. KİMLİK NO.");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "CEP TELEFONU 1");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "CEP TELEFONU 2");
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "EPOSTA");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "MAHALLE");
        $objPHPExcel->getActiveSheet()->setCellValue('H1', "SOKAK");
        $objPHPExcel->getActiveSheet()->setCellValue('I1', "KAPI NO.");
        $objPHPExcel->getActiveSheet()->setCellValue('J1', "DAİRE NO.");
        $objPHPExcel->getActiveSheet()->setCellValue('K1', "GÖRÜŞME DURUMU");
        $objPHPExcel->getActiveSheet()->setCellValue('L1', "TUZLAKART TESLİM DURUMU");
        $objPHPExcel->getActiveSheet()->setCellValue('M1', "MEMNUNİYET");
        $objPHPExcel->getActiveSheet()->setCellValue('N1', "TESLİM EDİLEN");
        $objPHPExcel->getActiveSheet()->setCellValue('O1', "TARİH");
        $objPHPExcel->getActiveSheet()->setCellValue('P1', "ANKETÖR");

        $row = 2;

        foreach ($items as $item)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $item->adi);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $item->soyadi);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $item->tckimlikno);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $item->gsm1);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $item->gsm2);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $item->eposta);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $item->mahalle);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $item->sokak);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $item->kapi);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $item->daire);
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $item->durum);
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $item->tuzlakart);
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $item->memnuniyet);
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $item->gorusulen);
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $item->tarih);
            $objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $item->anketor);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $fileName = date("d.m.Y") . "-genel_durum.xlsx";

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
        redirect(base_url("reports/genel_durum"));
    }

}