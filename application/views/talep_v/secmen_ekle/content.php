<?php $where = $this->session->userdata("where"); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Seçmen Arama
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4>Arama Kriterleri</h4>
            <hr>
            <form action="<?php echo base_url("talep/secmen_form"); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Mahalle</label><br>
                        <select id="mahalle" name="mahalle" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($mahalle as $mvalue) { ?>
                                <option <?php echo ($mvalue->id === $set_mahalle || $mvalue->id == $where['mahalle']) ? "selected" : ""; ?>
                                        value="<?php echo $mvalue->id; ?>"><?php echo $mvalue->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Sokak</label><br>
                        <select id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($sokak as $svalue) { ?>
                                <option <?php echo ($svalue->id === $set_sokak || $svalue->id == $where['sokak']) ? "selected" : ""; ?>
                                        value="<?php echo $svalue->id; ?>"><?php echo $svalue->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Kapı No.</label>
                        <input
                                value="<?php echo (isset($set_kapi)) ? $set_kapi : ""; ?>"
                                name="kapi"
                                type="text"
                                class="form-control"
                                placeholder="Kapı No. giriniz...">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("kapi"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Daire No.</label>
                        <input
                                value="<?php echo (isset($set_daire)) ? $set_daire : ""; ?>"
                                name="daire"
                                type="text"
                                class="form-control"
                                placeholder="Daire No. giriniz...">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("daire"); ?></small>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Adı</label>
                        <input name="adi" type="text" class="form-control"
                               value="<?php echo (isset($set_adi)) ? $set_adi : ""; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Soyadı</label>
                        <input name="soyadi" type="text" class="form-control"
                               value="<?php echo (isset($set_soyadi)) ? $set_soyadi : ""; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Vatandaşlık No.</label>
                        <input name="tckimlikno" type="text" class="form-control"
                               value="<?php echo (isset($set_tckimlikno)) ? $set_tckimlikno : ""; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url("talep/cancel_secmen_session"); ?>">
                            <button type="button" class="btn btn-danger btn-md btn-outline pull-right"><i
                                        class="fa fa-ban"></i>
                                Vazgeç
                            </button>
                        </a>
                        <a href="<?php echo base_url("talep/clear_secmen_session"); ?>">
                            <button type="button" class="btn btn-inverse btn-md btn-outline pull-right"
                                    style="margin-right: 12px">
                                <i class="fa fa-trash-o"></i>
                                Temizle
                            </button>
                        </a>
                        <button type="submit" class="btn btn-info btn-md btn-outline pull-right"
                                style="margin-right: 12px">
                            <i class="fa fa-search"></i>
                            Ara
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)) { ?>
                <div class="alert alert-warning text-center" style="padding: 8px; margin-bottom: 0px; s">
                    <p style="font-size: larger">Arama sonucunda herhangi bir veri bulunamadı.</p>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <p class="pagination"><?php echo $links; ?></p>
                    </div>
                </div>
                <table id="datatable-responsive"
                       class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <th class="w20"></th>
                    <th class="w20">#id</th>
                    <th class="w200">Adı</th>
                    <th class="w200">Soyadı</th>
                    <th class="w150">Vatandaşlık No</th>
                    <th class="w150">Cep Telefonu</th>
                    <th class="w200">Mahalle</th>
                    <th class="w200">Sokak</th>
                    <th class="w75">Kapı No</th>
                    <th class="w75">Daire No</th>
                    <th class="w125">Görüşme Durumu</th>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url("talep/new_form/$item->id"); ?>">
                                    <button class="btn btn-default btn-xs btn-outline" style="height: 50%">
                                        <i class="zmdi zmdi-check-all" style="color: #6a6c6f"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="text-center"><?php echo $item->id; ?></td>
                            <td class="text-center"><?php echo $item->adi; ?></td>
                            <td class="text-center"><?php echo $item->soyadi; ?></td>
                            <td class="text-center"><?php echo $item->tckimlikno; ?></td>
                            <td class="text-center"><?php echo $item->gsm1; ?></td>
                            <td class="text-center"><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center"><?php echo get_streetname($item->sokak); ?></td>
                            <td class="text-center"><?php echo $item->kapi; ?></td>
                            <td class="text-center"><?php echo $item->daire; ?></td>
                            <td class="text-center" style="color: <?php echo get_statementColor($item->durum); ?>">
                                <i class="<?php echo get_statementIcon($item->durum); ?>"></i>
                                <?php echo get_statementName($item->durum); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <p>Toplam <b><?php echo number_format($count, 0, ',', '.'); ?></b> kayıt</p>
                </div>
                <div class="col-md-6 text-right">
                    <p class="pagination"><?php echo $links; ?></p>
                </div>
            </div>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>