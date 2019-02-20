<?php $where = $this->session->userdata("where"); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Lütfen etiket basmak istediğiniz mahalla ve sokağı seçiniz
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("adres/new_form"); ?>">
                <i class="fa fa-plus"></i> Seçmen Ekle
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4>Arama Kriterleri</h4>
            <hr>
            <form action="<?php echo base_url("adres/index"); ?>" method="post">
                <input type="hidden" value=1 name="mahalle">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Mahalle</label><br>
                        <select id="mahalle" name="mahalle" class="form-control town-select" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($mahalle as $mvalue) { ?>
                                <option <?php echo ($mvalue->id === $set_mahalle || $mvalue->id == $where['mahalle']) ? "selected" : ""; ?>
                                        value="<?php echo $mvalue->id; ?>"><?php echo $mvalue->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Sokak</label><br>
                        <select id="sokak" name="sokak" class="form-control" data-plugin="select2">
                            <option value=""></option>
                            <?php foreach ($sokak as $svalue) { ?>
                                <option <?php echo ($svalue->id === $set_sokak || $svalue->id == $where['sokak']) ? "selected" : ""; ?>
                                        value="<?php echo $svalue->id; ?>"><?php echo $svalue->tanim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($set_mahalle && $set_sokak) { ?>
                            <a class="btn btn-outline btn-success btn-md pull-right"
                               href="<?php echo base_url("adres/excel"); ?>">
                                <i class="fa fa-file-excel-o"></i> Excel
                            </a>
                        <?php } ?>
                        <a href="<?php echo base_url("adres/clear_session"); ?>">
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
    <?php if ($where) { ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-primary"><span class="counter"
                                                                            data-plugin="counterUp"><?php echo number_format($bina, 0, ',', '.'); ?></span></h3>
                                <h3 class="text-muted">Bina</h3>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-building-o"></i></span>
                        </div>
                        <footer class="widget-footer bg-primary">
                            <h4><?php echo ($set_mahalle) ? get_townname($set_mahalle) : "" ?>
                                <?php echo ($set_sokak) ? " - " . get_streetname($set_sokak) : "" ?></h4>
                        </footer>
                    </div><!-- .widget -->
                </div>

                <div class="col-md-4">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-danger"><span class="counter"
                                                                           data-plugin="counterUp"><?php echo number_format($hane, 0, ',', '.'); ?></span></h3>
                                <h3 class="text-muted">Hane</h3>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-home"></i></span>
                        </div>
                        <footer class="widget-footer bg-danger">
                            <h4><?php echo ($set_mahalle) ? get_townname($set_mahalle) : "" ?>
                                <?php echo ($set_sokak) ? " - " . get_streetname($set_sokak) : "" ?></h4>
                        </footer>
                    </div><!-- .widget -->
                </div>

                <div class="col-md-4">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-success"><span class="counter"
                                                                            data-plugin="counterUp"><?php echo number_format($count, 0, ',', '.'); ?></span></h3>
                                <h3 class="text-muted">Seçmen</h3>
                            </div>
                            <span class="pull-right big-icon watermark"><i class="fa fa-users"></i></span>
                        </div>
                        <footer class="widget-footer bg-success">
                            <h4><?php echo ($set_mahalle) ? get_townname($set_mahalle) : "" ?>
                                <?php echo ($set_sokak) ? " - " . get_streetname($set_sokak) : "" ?></h4>
                        </footer>
                    </div><!-- .widget -->
                </div>
            </div>
        </div>
    <?php } ?>
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
                        <th class="w150">Adı</th>
                        <th class="w150">Soyadı</th>
                        <th class="w100">Mahalle</th>
                        <th class="w100">Sokak</th>
                        <th class="w50">Kapı No</th>
                        <th class="w50">Daire No</th>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td class="text-center"><?php echo $item->adi; ?></td>
                            <td class="text-center"><?php echo $item->soyadi; ?></td>
                            <td class="text-center"><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center"><?php echo get_streetname($item->sokak); ?></td>
                            <td class="text-center"><?php echo $item->kapi; ?></td>
                            <td class="text-center"><?php echo $item->daire; ?></td>
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