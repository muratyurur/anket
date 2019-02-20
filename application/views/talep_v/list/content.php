<?php $where = $this->session->userdata("where"); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Seçmen Talep Listesi
                        <a class="btn btn-outline btn-primary btn-sm pull-right"
                           href="<?php echo base_url("talep/new_form"); ?>">
                            <i class="fa fa-plus"></i> Talep Ekle
                        </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4>Arama Kriterleri</h4>
            <hr>
            <form action="<?php echo base_url("talep/index"); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Mahalle</label><br>
                        <select id="select2-demo-1" name="mahalle" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($towns as $town) { ?>
                                <option <?php echo ($town->tanim === $set_mahalle || $town->id == $where['mahalle']) ? "selected" : ""; ?>
                                        value="<?php echo $town->id; ?>"><?php echo $town->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Müdürlük</label><br>
                        <select id="select2-demo-1" name="mudurluk" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($departments as $department) { ?>
                                <option <?php echo ($department->tanim === $set_mudurluk || $department->id == $where['mudurluk']) ? "selected" : ""; ?>
                                        value="<?php echo $department->id; ?>"><?php echo $department->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
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
                    <div class="form-group col-md-3">
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
                    <a href="<?php echo base_url("talep/clear_session"); ?>">
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
                    <th class="w20"><i class="fa fa-pencil-square-o fa-2x"></i></th>
                    <th class="w50">Talep Tarihi</th>
                    <th class="w100">Talep Kaynağı</th>
                    <th class="w100">Mahalle</th>
                    <th class="w100">Talep Eden</th>
                    <th class="w200">Talep</th>
                    <th class="w20">Talep Durumu</th>
                    <th class="w100">İlgili Müdürlük</th>
                    <th class="w50">Sonuç Tarihi</th>
                    <th class="w200">Sonuç Açıklaması</th>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url("talep/update_form/$item->talep_id"); ?>">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>
                            </td>
                            <td class="text-center"><?php echo get_readable_onlydate($item->talepTarihi); ?></td>
                            <td class="text-center"><?php echo sourcename($item->kaynak); ?></td>
                            <td class="text-center"><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center"><?php echo get_person_name($item->id); ?></td>
                            <td class="text-center"><?php echo $item->istek; ?></td>
                            <td class="text-center"><?php echo get_statement($item->sonucDurumu); ?></td>
                            <td class="text-center"><?php echo get_departmentName($item->mudurluk); ?></td>
                            <td class="text-center"><?php echo($item->sonucTarihi != "" ? get_readable_onlydate($item->sonucTarihi) : ""); ?></td>
                            <td class="text-center"><?php echo $item->sonucAciklama; ?></td>
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