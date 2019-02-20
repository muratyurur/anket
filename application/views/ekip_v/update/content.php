<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b><?php echo $item->full_name; ?></b> 'e ait bilgileri düzenliyorsunuz...
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("ekip/update/$item->id"); ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Ekip Adı</label>
                        <input
                                value="<?php echo isset($form_error) ? set_value("tanim") : $item->tanim; ?>"
                                name="tanim"
                                type="text"
                                class="form-control"
                                placeholder="Ekip adını giriniz...">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("tanim"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-refresh"></i>
                        Güncelle
                    </button>
                    <a href="<?php echo base_url("ekip")?>">
                        <button type="button" class="btn btn-danger btn-md btn-outline"><i class="fa fa-ban"></i>
                            Vazgeç
                        </button>
                    </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>