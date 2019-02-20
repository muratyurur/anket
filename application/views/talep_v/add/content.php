<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Talep Ekle
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                <i class="fa fa-chevron-left"></i> Geri Dön
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("talep/save"); ?>" method="post">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Talep Eden</label>
                            <input value="<?php echo ($secmen ? get_person_name($secmen->id) : ""); ?>"
                                    name="secmen"
                                   type="text"
                                   style="display: inline-block; width: 85%;"
                                   class="form-control"
                                   placeholder="Talep eden kişiyi seçiniz..">
                            <a href="<?php echo base_url("talep/secmen_form"); ?>">
                                <span class="input-append btn btn-primary text-center" style="display: inline; width: 15%;"><i
                                            class="fa fa-search"></i></span>
                            </a>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error"> <?php echo form_error("secmen"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>İrtibat No.</label>
                            <input value="<?php echo ($secmen ? $secmen->gsm1 : ""); ?>"
                                    name="evsahibitel"
                                    type="text"
                                    data-mask="0 (500) 000-00-00"
                                    class="form-control"
                                    placeholder="0 (5__) ___-__-__">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("irtibat"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="datetimepicker2">Talep Tarihi</label>
                            <br>
                            <input type="text"
                                   class="form-control"
                                   name="tarih"
                                   data-mask="00/00/0000"
                                   placeholder="GG/AA/YYYY"
                                   data-mask-clearifnotmatch="true"/>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("tarih"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Talep Kaynağı</label>
                            <select id="select2-demo-1" name="kaynak" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($kaynaks as $kaynak) { ?>
                                    <option <?php echo ($kaynak->id === $item->kaynak) ? "selected" : ""; ?>
                                            value="<?php echo $kaynak->id; ?>"><?php echo $kaynak->title; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("kaynak"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Mahalle</label>
                            <select id="select2-demo-1" name="mahalle" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($mahalle as $mvalue) { ?>
                                    <option <?php echo ($mvalue->id === $secmen->mahalle) ? "selected" : ""; ?>
                                            value="<?php echo $mvalue->id; ?>"><?php echo $mvalue->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("mahalle"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sokak</label><br>
                            <select id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($sokak as $svalue) { ?>
                                    <option <?php echo($svalue->id === $secmen->sokak ? "selected" : ""); ?>
                                            value="<?php echo $svalue->id; ?>"><?php echo $svalue->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("sokak"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Kapı No.</label>
                            <input
                                    value="<?php echo ($secmen ? $secmen->kapi : ""); ?>"
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
                                    value="<?php echo ($secmen ? $secmen->daire : ""); ?>"
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
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <h5>Talep</h5>
                                <textarea id="maxlength-demo-4" class="form-control"
                                          name="istek"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>İlgili Müdürlük</label>
                            <select id="select2-demo-1" name="mudurluk" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($departments as $department) { ?>
                                    <option <?php echo ($department->id === $item->mudurluk) ? "selected" : ""; ?>
                                            value="<?php echo $department->id; ?>"><?php echo $department->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("mudurluk"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Talep Durumu</label>
                            <select id="select2-demo-1" name="sonucDurumu" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($statements as $statement) { ?>
                                    <option <?php echo ($statement->id === $item->sonucDurumu) ? "selected" : ""; ?>
                                            value="<?php echo $statement->id; ?>"><?php echo $statement->title; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("sonucDurumu"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datetimepicker2">Sonuç Tarihi</label>
                            <br>
                            <input type="text"
                                   class="form-control"
                                   name="sonucTarihi"
                                   data-mask="00/00/0000"
                                   placeholder="GG/AA/YYYY"
                                   data-mask-clearifnotmatch="true"/>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("sonucTarihi"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <h5>Sonuç Açıklaması</h5>
                                <textarea id="maxlength-demo-4" class="form-control"
                                          name="sonucAciklama"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-floppy-o"></i>
                        Kaydet
                    </button>
                    <a href="<?php echo base_url("talep"); ?>">
                        <button type="button" class="btn btn-danger btn-md btn-outline"><i class="fa fa-ban"></i>
                            Vazgeç
                        </button>
                    </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>