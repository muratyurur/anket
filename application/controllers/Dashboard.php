<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "dashboard_v";
        $this->load->model("dashboard_model");

        if (!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        $this->session->unset_userdata("where");

        $user = $this->session->userdata("user");

        $viewData->counts = $this->dashboard_model->get_towncount();
        $viewData->durums = $this->dashboard_model->get_durumcount();
        $viewData->mdurums = $this->dashboard_model->get_mdurumcount();
        $viewData->topdurums = $this->dashboard_model->get_topdurumcount();
        $viewData->tuzlakarts = $this->dashboard_model->get_tuzlakartcount();
        $viewData->mtuzlakarts = $this->dashboard_model->get_mtuzlakartcount();
        $viewData->toptuzlakarts = $this->dashboard_model->get_toptuzlakartcount();
        $viewData->memnuniyets = $this->dashboard_model->get_memnuniyetcount();
        $viewData->mmemnuniyets = $this->dashboard_model->get_mmemnuniyetcount();
        $viewData->topmemnuniyets = $this->dashboard_model->get_topmemnuniyetcount();
        $viewData->mudurluktaleps = $this->dashboard_model->get_mudurluktalepcount();
        $viewData->mahalletaleps = $this->dashboard_model->get_mahalletalepcount();
        $viewData->tasks = $this->dashboard_model->get_tasks(
            array(
                "tarih" => date("Y-m-d"),
                "ekip" => $user->ekip_id
            )
        );

        $datetime = new DateTime('tomorrow');

        $viewData->general_count = $this->dashboard_model->get_count(
            array(
                "updatedAt!=" => ""
            )
        );

        $viewData->tomorrow = new DateTime('tomorrow');

        $viewData->tomorrow_tasks = $this->dashboard_model->get_tasks(
            array(
                "tarih" => $datetime->format('Y-m-d'),
                "ekip" => $user->ekip_id
            )
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function excel_mahalle_durum(){
        $this->session->unset_userdata("where");

        $mdurums = $this->dashboard_model->get_mdurumcount();
        $topdurums = $this->dashboard_model->get_topdurumcount();


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

        $topStyleArray = array(
            'font' => array(
                'bold' => true,
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );

        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "19")->applyFromArray($topStyleArray);
        }

        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "1")->applyFromArray($styleArray);
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A1', "MAHALLE");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "HENÜZ GÖRÜŞÜLMEDİ");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "GÖRÜŞÜLDÜ");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "EVDE BULUNAMADI");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "GÖRÜŞMEYİ REDDETTİ");

        $row = 2;

        foreach ($mdurums as $mdurum)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $mdurum['tanim']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, number_format($mdurum['Henüz Görüşülmedi'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, number_format($mdurum['Görüşüldü'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, number_format($mdurum['Evde Bulunamadı'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, number_format($mdurum['Görüşmeyi Reddetti'], 0, ',', '.'));
            $row++;
        }

        foreach ($topdurums as $topdurum)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A19', "TOPLAM");
            $objPHPExcel->getActiveSheet()->setCellValue('B19', number_format($topdurum['Henüz Görüşülmedi'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('C19', number_format($topdurum['Görüşüldü'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('D19', number_format($topdurum['Evde Bulunamadı'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('E19', number_format($topdurum['Görüşmeyi Reddetti'], 0, ',', '.'));
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $fileName = date("d.m.Y") . "-görüşme_durumu.xlsx";

        $objPHPExcel->getActiveSheet()->setTitle(date("d.m.Y"));

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function excel_tuzlakart_durum(){
        $this->session->unset_userdata("where");

        $mdurums = $this->dashboard_model->get_mtuzlakartcount();
        $toptuzlakarts = $this->dashboard_model->get_toptuzlakartcount();

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

        $topStyleArray = array(
            'font' => array(
                'bold' => true,
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );

        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "19")->applyFromArray($topStyleArray);
        }

        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "1")->applyFromArray($styleArray);
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A1', "MAHALLE");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "TESLİM ALDI");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "TESLİM EDİLEMEDİ");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "İSTEMEDİ");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "KARTI VAR");

        $row = 2;

        foreach ($mdurums as $mdurum)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $mdurum['tanim']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, number_format($mdurum['Teslim Aldı'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, number_format($mdurum['Teslim Edilemedi'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, number_format($mdurum['İstemedi'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, number_format($mdurum['Kartı Var'], 0, ',', '.'));
            $row++;
        }

        foreach ($toptuzlakarts as $toptuzlakart)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A19', 'TOPLAM');
            $objPHPExcel->getActiveSheet()->setCellValue('B19', number_format($toptuzlakart['Teslim Aldı'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('C19', number_format($toptuzlakart['Teslim Edilemedi'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('D19', number_format($toptuzlakart['İstemedi'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('E19', number_format($toptuzlakart['Kartı Var'], 0, ',', '.'));
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $fileName = date("d.m.Y") . "-tuzlakart_teslim_durumu.xlsx";

        $objPHPExcel->getActiveSheet()->setTitle(date("d.m.Y"));

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function excel_memnuniyet_durum(){
        $this->session->unset_userdata("where");

        $mdurums = $this->dashboard_model->get_mmemnuniyetcount();
        $topmemnuniyets = $this->dashboard_model->get_topmemnuniyetcount();

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

        $topStyleArray = array(
            'font' => array(
                'bold' => true,
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );

        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "19")->applyFromArray($topStyleArray);
        }

        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle($columnID . "1")->applyFromArray($styleArray);
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A1', "MAHALLE");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "MEMNUN");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "MEMNUN DEĞİL");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "KISMEN MEMNUN");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "CEVAP VERMEDİ");

        $row = 2;

        foreach ($mdurums as $mdurum)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $mdurum['tanim']);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, number_format($mdurum['Memnun'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, number_format($mdurum['Memnun Değil'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, number_format($mdurum['Kısmen Memnun'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, number_format($mdurum['Cevap Vermedi'], 0, ',', '.'));
            $row++;
        }

        foreach ($topmemnuniyets as $topmemnuniyet)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A19', 'TOPLAM');
            $objPHPExcel->getActiveSheet()->setCellValue('B19', number_format($topmemnuniyet['Memnun'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('C19', number_format($topmemnuniyet['Memnun Değil'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('D19', number_format($topmemnuniyet['Kısmen Memnun'], 0, ',', '.'));
            $objPHPExcel->getActiveSheet()->setCellValue('E19', number_format($topmemnuniyet['Cevap Vermedi'], 0, ',', '.'));
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $fileName = date("d.m.Y") . "-memnuniyet_durumu.xlsx";

        $objPHPExcel->getActiveSheet()->setTitle(date("d.m.Y"));

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
}
