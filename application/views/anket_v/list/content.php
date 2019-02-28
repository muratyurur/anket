<?php $where = $this->session->userdata("where"); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b>Tuzla 2019 Yerel Seçim</b> Anket Seçmen Listesi
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("anket/new_form"); ?>">
                <i class="fa fa-plus"></i> Seçmen Ekle
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4>Arama Kriterleri</h4>
            <hr>
            <form action="<?php echo base_url("anket/index"); ?>" method="post">
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
                        <input name="kapi" type="text" class="form-control"
                               value="<?php echo $where['kapi'] ? $where['kapi'] : ""; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Daire No</label>
                        <input name="daire" type="text" class="form-control"
                               value="<?php echo $where['daire'] ? $where['daire'] : ""; ?>">
                    </div>
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
                               value="<?php echo $where['tckimlikno'] ? $where['tckimlikno'] : ""; ?>">
                    </div>
                </div>
                <div class="row">
                    <a href="<?php echo base_url("anket/clear_session"); ?>">
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
    <?php if ($where) { ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget stats-widget">
                        <div class="widget-body clearfix">
                            <div class="pull-left">
                                <h3 class="widget-title text-primary"><span class="counter"
                                                                            data-plugin="counterUp"><?php echo number_format($bina, 0, ',', '.'); ?></span>
                                </h3>
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
                                                                           data-plugin="counterUp"><?php echo number_format($hane, 0, ',', '.'); ?></span>
                                </h3>
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
                                                                            data-plugin="counterUp"><?php echo number_format($count, 0, ',', '.'); ?></span>
                                </h3>
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
                <div class="row">
                    <div class="col-md-12 text-right">
                        <p class="pagination"><?php echo $links; ?></p>
                    </div>
                </div>
                <table id="datatable-responsive"
                       class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <th class="w20"></th>
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
                    <?php 
						foreach ($items as $item) { 
							if($item->durum=="G") $styleColor = 'style="color:#00C568;" ';
							else if($item->durum=="B") $styleColor = 'style="color:#FFC54E;" ';
							else if($item->durum=="R") $styleColor = 'style="color:#FF515A;" ';
							else $styleColor = '';
					?>
                        <tr>
                            <td class="text-center" <?php echo $styleColor; ?> >
                                <a href="<?php echo base_url("anket/update_form/$item->id"); ?>">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>
                            </td>
                            <?php if ($item->gorusulen == 1) { ?>
                                <td class="text-center">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-star fa-stack-1x text-warning"></i>
                                        <i class="fa fa-star-o fa-stack-1x text-muted"></i>
                                    </span>
                                </td>
                            <?php } else { ?>
                                <td class="text-center"></td>
                            <?php } ?>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->id; ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->adi; ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->soyadi; ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->tckimlikno; ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->gsm1; ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo get_townname($item->mahalle); ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo get_streetname($item->sokak); ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->kapi; ?></td>
                            <td class="text-center" <?php echo $styleColor; ?> ><?php echo $item->daire; ?></td>
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