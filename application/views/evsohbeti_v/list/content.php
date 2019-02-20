<?php $where = $this->session->userdata("where"); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b>Tuzla 2019 Yerel Seçim</b> Ev Sohbeti Çalışması Listesi
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("evsohbeti/new_form"); ?>">
                <i class="fa fa-plus"></i> Ev Sohbeti Ekle
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4>Arama Kriterleri</h4>
            <hr>
            <form action="<?php echo base_url("evsohbeti/index"); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Mahalle</label><br>
                        <select id="mahalle" name="mahalle" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($mahalle as $mvalue) { ?>
                                <option <?php echo ($mvalue->id === $set_mahalle || $mvalue->id == $where['mahalle']) ? "selected" : ""; ?>
                                        value="<?php echo $mvalue->id; ?>"><?php echo $mvalue->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Sokak</label><br>
                        <select id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($sokak as $svalue) { ?>
                                <option <?php echo ($svalue->id === $set_sokak || $svalue->id == $where['sokak']) ? "selected" : ""; ?>
                                        value="<?php echo $svalue->id; ?>"><?php echo $svalue->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Hatip</label><br>
                        <select id="select2-demo-1" name="hatip" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($hatips as $hatip) { ?>
                                <option <?php echo ($hatip->id === $set_hatip || $hatip->id == $where['hatip']) ? "selected" : ""; ?>
                                        value="<?php echo $hatip->id; ?>"><?php echo $hatip->adisoyadi; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="datetimepicker2">İlk Tarih</label>
                        <br>
                        <input value="<?php echo ($set_ilktarih) ? $set_ilktarih : ""; ?>"
                               type="text"
                               class="form-control"
                               name="ilktarih"
                               data-mask="00/00/0000"
                               placeholder="GG/AA/YYYY"
                               data-mask-clearifnotmatch="true"/>
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("ilktarih"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="datetimepicker2">Son Tarih</label>
                        <br>
                        <input value="<?php echo ($set_sontarih) ? $set_sontarih : ""; ?>"
                               type="text"
                               class="form-control"
                               name="sontarih"
                               data-mask="00/00/0000"
                               placeholder="GG/AA/YYYY"
                               data-mask-clearifnotmatch="true"/>
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("sontarih"); ?></small>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <a href="<?php echo base_url("evsohbeti/clear_session"); ?>">
                        <button type="button" class="btn btn-inverse btn-md btn-outline pull-right"
                                style="margin-right: 12px">
                            <i class="fa fa-trash-o"></i>
                            Temizle
                        </button>
                    </a>
                    <button type="submit" class="btn btn-info btn-md btn-outline pull-right" style="margin-right: 12px">
                        <i class="fa fa-search"></i>
                        Ara
                    </button>
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
                    <th class="w50">Tarih</th>
                    <th class="w200">Ev Sahibi</th>
                    <th class="w200">Ev Sahibi Telefon</th>
                    <th class="w200">Hatip</th>
                    <th class="w200">Mahalle</th>
                    <th class="w200">Sokak</th>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url("evsohbeti/update_form/$item->id"); ?>">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>
                            </td>
                            <td class="text-center"><?php echo $item->id; ?></td>
                            <td class="text-center"><?php echo get_readable_onlydate($item->tarih); ?></td>
                            <td class="text-center"><?php echo $item->evsahibi; ?></td>
                            <td class="text-center"><?php echo $item->evsahibitel; ?></td>
                            <td class="text-center"><?php echo get_speaker($item->hatip); ?></td>
                            <td class="text-center"><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center"><?php echo get_streetname($item->sokak); ?></td>
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