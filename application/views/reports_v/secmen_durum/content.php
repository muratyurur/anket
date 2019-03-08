<?php $where = $this->session->userdata("where"); ?>
<?php $formatter = new NumberFormatter('tr_tr', NumberFormatter::PERCENT) ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Tuzla 2019 Yerel Seçim <b>Genel Durum Raporu</b>
        </h4>
    </div>
<!--    <div class="col-md-12">-->
<!--        <div class="widget p-lg">-->
<!--            <h4>Arama Kriterleri</h4>-->
<!--            <hr>-->
<!--            <form action="--><?php //echo base_url("reports/genel_durum"); ?><!--" method="post">-->
<!--                <div class="row">-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label>Mahalle</label><br>-->
<!--                        <select id="mahalle" name="mahalle" class="form-control" data-plugin="select2">-->
<!--                            <option value=""></option>-->
<!--                            --><?php //foreach ($mahalle as $mvalue) { ?>
<!--                                <option --><?php //echo ($mvalue->id === $set_mahalle || $mvalue->id == $where['mahalle']) ? "selected" : ""; ?>
<!--                                        value="--><?php //echo $mvalue->id; ?><!--">--><?php //echo $mvalue->tanim; ?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label>Sokak</label><br>-->
<!--                        <select id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">-->
<!--                            <option value=""></option>-->
<!--                            --><?php //foreach ($sokak as $svalue) { ?>
<!--                                <option --><?php //echo ($svalue->id === $set_sokak || $svalue->id == $where['sokak']) ? "selected" : ""; ?>
<!--                                        value="--><?php //echo $svalue->id; ?><!--">--><?php //echo $svalue->tanim; ?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-2">-->
<!--                        <label>Kapı No.</label>-->
<!--                        <input name="kapi" type="text" class="form-control"-->
<!--                               value="--><?php //echo $where['kapi'] ? $where['kapi'] : ""; ?><!--">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-2">-->
<!--                        <label>Daire No</label>-->
<!--                        <input name="daire" type="text" class="form-control"-->
<!--                               value="--><?php //echo $where['daire'] ? $where['daire'] : ""; ?><!--">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label>Adı</label>-->
<!--                        <input name="adi" type="text" class="form-control"-->
<!--                               value="--><?php //echo (isset($set_adi)) ? $set_adi : ""; ?><!--">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label>Soyadı</label>-->
<!--                        <input name="soyadi" type="text" class="form-control"-->
<!--                               value="--><?php //echo (isset($set_soyadi)) ? $set_soyadi : ""; ?><!--">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label>Vatandaşlık No.</label>-->
<!--                        <input name="tckimlikno" type="text" class="form-control"-->
<!--                               value="--><?php //echo $where['tckimlikno'] ? $where['tckimlikno'] : ""; ?><!--">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label for="datetimepicker2">İlk Tarih</label>-->
<!--                        <br>-->
<!--                        <input value="--><?php //echo ($set_ilktarih) ? $set_ilktarih : ""; ?><!--"-->
<!--                               type="text"-->
<!--                               class="form-control"-->
<!--                               name="ilktarih"-->
<!--                               data-mask="00/00/0000"-->
<!--                               placeholder="GG/AA/YYYY"-->
<!--                               data-mask-clearifnotmatch="true"/>-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <label for="datetimepicker2">Son Tarih</label>-->
<!--                        <br>-->
<!--                        <input value="--><?php //echo ($set_sontarih) ? $set_sontarih : ""; ?><!--"-->
<!--                               type="text"-->
<!--                               class="form-control"-->
<!--                               name="sontarih"-->
<!--                               data-mask="00/00/0000"-->
<!--                               placeholder="GG/AA/YYYY"-->
<!--                               data-mask-clearifnotmatch="true"/>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <a class="btn btn-outline btn-success btn-md pull-right"-->
<!--                           href="--><?php //echo base_url("reports/gd_excel"); ?><!--">-->
<!--                            <i class="fa fa-file-excel-o"></i> Excel-->
<!--                        </a>-->
<!--                        <a href="--><?php //echo base_url("reports/clear_session"); ?><!--">-->
<!--                            <button type="button" class="btn btn-inverse btn-md btn-outline pull-right"-->
<!--                                    style="margin-right: 12px">-->
<!--                                <i class="fa fa-trash-o"></i>-->
<!--                                Temizle-->
<!--                            </button>-->
<!--                        </a>-->
<!--                        <button type="submit" class="btn btn-info btn-md btn-outline pull-right"-->
<!--                                style="margin-right: 12px">-->
<!--                            <i class="fa fa-search"></i>-->
<!--                            Ara-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)) { ?>
                <div class="alert alert-warning text-center" style="padding: 8px; margin-bottom: 0px; s">
                    <p style="font-size: larger">Arama sonucunda herhangi bir veri bulunamadı.</p>
                </div>
            <?php } else { ?>
                <table id="datatable-responsive"
                       class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <tr>
                        <th colspan="1" class="w150"></th>
                        <th colspan="2">SABİT VERİLER</th>
                        <th colspan="13">DEĞİŞKEN VERİLER</th>
                    </tr>
                    <tr>
                        <th>MAHALLE</th>
                        <th>SEÇMEN SAYISI</th>
                        <th>KARTI OLAN (SEÇMEN)</th>
                        <th>KARTI OLAN (GÖRÜŞÜLEN)</th>
                        <th>TESLİM EDİLEN (KART)</th>
                        <th>İSTEMEYEN (KART)</th>
                        <th>GÖRÜŞÜLEMEYEN</th>
                        <th>KALAN</th>
                        <th>MEMNUN</th>
                        <th>KISMEN MEMNUN</th>
                        <th>MEMNUN DEĞİL</th>
                        <th>CEVAP VERMEDİ</th>
                        <th>TOPLAM GÖRÜŞÜLEN</th>
                        <th>MEMNUNİYET ORANI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td class="text-center"><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center"><?php echo number_format($item->SECMEN, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->V, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->VG, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->EG, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->IG, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->HB, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->KALAN, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->M, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->KM, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->MD, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->C, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($item->TG, 0, ',', '.'); ?></td>
                            <td class="text-center"><?php echo $formatter->format($item->MO); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>