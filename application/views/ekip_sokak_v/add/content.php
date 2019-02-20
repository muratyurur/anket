<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Görev Ekle
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("ekip_sokak"); ?>">
                <i class="fa fa-chevron-left"></i> Geri Dön
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("ekip_sokak/save"); ?>" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">
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
                        <div class="form-group col-md-6">
                            <label>Ekip</label><br>
                            <select id="select2-demo-1" name="ekip" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($teams as $team) { ?>
                                    <option <?php echo ($team->id === $set_ekip || $team->id == $where['ekip']) ? "selected" : ""; ?>
                                            value="<?php echo $team->id; ?>"><?php echo $team->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("ekip"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mahalle</label><br>
                            <select id="select2-demo-1" name="mahalle" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($towns as $town) { ?>
                                    <option <?php echo ($town->id === $set_mahalle || $town->id == $where['mahalle']) ? "selected" : ""; ?>
                                            value="<?php echo $town->id; ?>"><?php echo $town->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("mahalle"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sokak</label><br>
                            <select id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($streets as $street) { ?>
                                    <option <?php echo ($street->id === $set_sokak || $street->id == $where['sokak']) ? "selected" : ""; ?>
                                            value="<?php echo $street->id; ?>"><?php echo $street->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("sokak"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-floppy-o"></i>
                                Kaydet
                            </button>
                            <a href="<?php echo base_url("ekip_sokak"); ?>">
                                <button type="button" class="btn btn-danger btn-md btn-outline"><i class="fa fa-ban"></i>
                                    Vazgeç
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>