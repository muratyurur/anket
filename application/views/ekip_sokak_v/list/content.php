<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Ekip Görev Listesi
            <a class="btn btn-outline btn-info btn-sm pull-right"
               href="<?php echo base_url("ekip_sokak/new_form"); ?>">
                <i class="fa fa-plus"></i> Yeni Ekle
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4>Arama Kriterleri</h4>
            <hr>
            <form action="<?php echo base_url("ekip_sokak/index"); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="datetimepicker2">Tarih</label>
                        <br>
                        <input value="<?php echo (isset($set_tarih)) ? $set_tarih : ""; ?>"
                               type="text"
                               class="form-control"
                               name="tarih"
                               data-mask="00/00/0000"
                               placeholder="GG/AA/YYYY"
                               placeholder="GG/AA/YYYY"
                               data-mask-clearifnotmatch="true"/>
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("tarih"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Ekip</label><br>
                        <select id="select2-demo-1" name="ekip" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($teams as $team) { ?>
                                <option <?php echo ($team->id === $set_ekip || $team->id == $where['ekip']) ? "selected" : ""; ?>
                                        value="<?php echo $team->id; ?>"><?php echo $team->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Mahalle</label><br>
                        <select id="select2-demo-1" name="mahalle" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($towns as $town) { ?>
                                <option <?php echo ($town->id === $set_mahalle || $town->id == $where['mahalle']) ? "selected" : ""; ?>
                                        value="<?php echo $town->id; ?>"><?php echo $town->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Sokak</label><br>
                        <select id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($streets as $street) { ?>
                                <option <?php echo ($street->id === $set_sokak || $street->id == $where['sokak']) ? "selected" : ""; ?>
                                        value="<?php echo $street->id; ?>"><?php echo $street->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <a href="<?php echo base_url("ekip_sokak/clear_session"); ?>">
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
            <table id="datatable-responsive"
                   class="table table-striped table-hover table-bordered content-container">
                <thead>
                <th class="w200">Tarih</th>
                <th class="w200">Ekip</th>
                <th class="w200">Mahalle</th>
                <th class="w300">Sokak</th>
                <th class="w200">Kaydeden</th>
                <th class="w200">Kayıt Tarihi</th>
                <th class="w200">Güncelleyen</th>
                <th class="w200">Güncelleme Tarihi</th>
                <th class="w300">İşlem</th>
                </thead>
                <tbody>
                <?php $count = 1;
                foreach ($items as $item) { ?>
                    <tr>
                        <td class="text-center"><?php echo get_readable_onlydate($item->tarih); ?></td>
                        <td class="text-center"><?php echo get_teamName($item->ekip); ?></td>
                        <td class="text-center"><?php echo get_townname($item->mahalle); ?></td>
                        <td class="text-center"><?php echo get_streetname($item->sokak); ?></td>
                        <td class="text-center"><?php echo get_username($item->createdBy); ?></td>
                        <td class="text-center"><?php echo get_readable_date($item->createdAt); ?></td>
                        <td class="text-center"><?php echo get_username($item->updatedBy); ?></td>
                        <td class="text-center"><?php echo($item->updatedAt != "" ? get_readable_date($item->updatedAt) : ""); ?></td>
                        <td class="text-center">
                            <button
                                    data-url="<?php echo base_url("ekip_sokak/delete/$item->id"); ?>"
                                    type="button"
                                    class="btn btn-danger btn-sm btn-outline remove-btn"
                            >
                                <i class="fa fa-trash-o"></i>
                                Sil
                            </button>
                            <a href="<?php echo base_url("ekip_sokak/update_form/$item->id"); ?>">
                                <button type="button" class="btn btn-primary btn-sm btn-outline">
                                    <i class="fa fa-pencil-square-o"></i>
                                    Düzenle
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php $count++; } ?>
                </tbody>
            </table>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>