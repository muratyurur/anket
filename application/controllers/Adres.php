<?php

class Adres extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "adres_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("adres_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "adres");
            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        }

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $where = array();


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

        $condition = $this->session->userdata("where");

        $this->load->library("pagination");

        $config["base_url"] = base_url("adres/index");
        $config["total_rows"] = $this->adres_model->get_count($condition ? $condition : "1=1");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";

        $viewData->bina = $this->adres_model->get_bina($condition ? $condition : "1=1");
        $viewData->hane = $this->adres_model->get_hane($condition ? $condition : "1=1");


        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->adres_model->get_records(
            $condition ? $condition : "1=1",
            $config["per_page"],
            $page
        );

        $viewData->count = $config["total_rows"];

        if ($this->input->post("mahalle"))
        {
            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(
                array(
                    "mahalle_id" => $this->input->post("mahalle")
                ), "tanim ASC");
        } else {
            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");
        }

        /** Taking all towns in the place */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        $viewData->percount = $config["per_page"];

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function clear_session()
    {
        $this->session->unset_userdata("where");
        redirect(base_url("adres"));
    }

    public function excel()
    {
        $where = $this->session->userdata('where');

        /** Taking all data from the table */
        $items = $this->adres_model->get_all(
            array(
                "s.mahalle" => $where['mahalle'],
                "s.sokak" => $where['sokak']
            )
        );


        $sokak = $this->sokak_model->get(
            array(
                "id" => $where['sokak']
            )
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

        $records = count($items);


        for ($rows = 1; $rows <= ($records / 3); $rows++) {
            $objPHPExcel->getActiveSheet()->getRowDimension($rows)->setRowHeight(115);
        }

        $styleArray = array(
            'font' => array(
                'bold' => false,
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );

        foreach (range('A', 'C') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(34.33);
            $objPHPExcel->getActiveSheet()->getStyle($columnID)->applyFromArray($styleArray);
        }

        $col = 0;

        for($i = 1; $i <= (ceil($records / 3)); $i++) { // loop for rows
            for($letter = 'A'; $letter != 'D'; $letter++) { // loop for columns
                $objPHPExcel->getActiveSheet()->getStyle($letter . $i)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->setCellValue($letter . $i, (@$items[$col]->adi) ? "Sayın " . @$items[$col]->adi . " " . @$items[$col]->soyadi . "\n" . @$items[$col]->mahalle . " " . @$items[$col]->sokak . "\nNO:" . @$items[$col]->kapi . " D:" . @$items[$col]->daire . "\n TUZLA / İSTANBUL" : "");
            $col++;
            }
        }

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.4);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $fileName = $sokak->tanim . ".xlsx";

        $objPHPExcel->getActiveSheet()->setTitle($sokak->tanim);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
}