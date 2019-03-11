<?php $where = $this->session->userdata("where"); ?>
<?php $formatter = new NumberFormatter('tr_tr', NumberFormatter::PERCENT) ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Tuzla 2019 Yerel Seçim <b>Genel Durum Raporu</b>
            <a class="btn btn-outline btn-success btn-md pull-right"
               href="<?php echo base_url("reports/gdo_excel"); ?>">
                <i class="fa fa-file-excel-o"></i> Excel
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)) { ?>
                <div class="alert alert-warning text-center" style="padding: 8px; margin-bottom: 0px; s">
                    <p style="font-size: larger">Arama sonucunda herhangi bir veri bulunamadı.</p>
                </div>
            <?php } else { ?>
                <table id="table-responsive"
                       class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <tr>
                        <th colspan="1" class="w150"></th>
                        <th colspan="2" style="background-color:#4da2e2; color:white">SABİT VERİLER</th>
                        <th colspan="13" style="background-color:#4da2e2; color:white">DEĞİŞKEN VERİLER</th>
                    </tr>
                    <tr style="vertical-align: middle;background-color:#8dbbdd; color:white">
                        <th style="vertical-align: middle;background-color:#8dbbdd; color:white">MAHALLE</th>
                        <th style="vertical-align: middle;border-left:solid 3px #DDDDDD!important;">
                            SEÇMEN SAYISI
                        </th>
                        <th style="vertical-align: middle;border-right:solid 3px #DDDDDD!important;">KARTI OLAN
                            (SEÇMEN)
                        </th>
                        <th style="vertical-align: middle;">KARTI OLAN (GÖRÜŞÜLEN)</th>
                        <th style="vertical-align: middle;">TESLİM EDİLEN (KART)</th>
                        <th style="vertical-align: middle;">İSTEMEYEN (KART)</th>
                        <th style="vertical-align: middle;">GÖRÜŞÜLEMEYEN</th>
                        <th style="vertical-align: middle; border-right:solid 3px #DDDDDD!important;">KALAN</th>
                        <th style="vertical-align: middle;">MEMNUN</th>
                        <th style="vertical-align: middle;">KISMEN MEMNUN</th>
                        <th style="vertical-align: middle;">MEMNUN DEĞİL</th>
                        <th style="vertical-align: middle;">CEVAP VERMEDİ</th>
                        <th style="vertical-align: middle;border-right:solid 3px #DDDDDD!important;">TOPLAM GÖRÜŞÜLEN
                        </th>
                        <th style="vertical-align: middle;">MEMNUNİYET ORANI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr style="border-bottom:solid 2px #ddd!important;">
                            <td class="text-right"
                                style="background-color:#8dbbdd; color:white"><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center"
                                style="border-left:solid 3px #DDDDDD!important; "><?php echo number_format($item->SECMEN, 0, ',', '.'); ?></td>
                            <td class="text-center"
                                style="border-right:solid 3px #DDDDDD!important;  "><?php echo number_format($item->V, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->VG, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->EG, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->IG, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->HB, 0, ',', '.'); ?></td>
                            <td class="text-center"
                                style="border-right:solid 3px #DDDDDD!important; "><?php echo number_format($item->KALAN, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->M, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->KM, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->MD, 0, ',', '.'); ?></td>
                            <td class="text-center" style=""><?php echo number_format($item->C, 0, ',', '.'); ?></td>
                            <td class="text-center"
                                style="border-right:solid 3px #DDDDDD!important; "><?php echo number_format($item->TG, 0, ',', '.'); ?></td>
                            <td class="text-center"
                                style="background-color:#8dbbdd; font-weight:bold; color: white"><?php echo $formatter->format($item->MO); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>