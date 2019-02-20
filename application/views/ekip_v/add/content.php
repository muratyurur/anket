<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Ekip Ekle
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("ekip/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Ekip Adı</label>
                        <input
                                value="<?php echo isset($form_error) ? set_value("tanim") : "" ; ?>"
                                name="tanim"
                                type="text"
                                class="form-control"
                                placeholder="Tercih edilen kullanıcı adını giriniz...">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error pull-right"> <?php echo form_error("tanim"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-floppy-o"></i>
                        Kaydet
                    </button>
                    <a href="<?php echo base_url("ekip"); ?>">
                        <button type="button" class="btn btn-danger btn-md btn-outline"><i class="fa fa-ban"></i>
                            Vazgeç
                        </button>
                    </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>