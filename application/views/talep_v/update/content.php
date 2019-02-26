<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b><?php echo get_person_name($talepeden->id); ?></b> adlı seçmene ait talep bilgilerini düzenliyorsunuz...
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("talep"); ?>">
                <i class="fa fa-chevron-left"></i> Geri Dön
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("talep/update/$item->id"); ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Seçmen</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("secmen") : get_person_name($talepeden->id); ?>"
                                    name="secmen"
                                    type="text"
                                    disabled
                                    class="form-control"
                                    placeholder="Seçmen adı ve soyadını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("secmen"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="datetimepicker2">Talep Tarihi</label>
                            <br>
                            <input type="text"
                                   class="form-control"
                                   name="talepTarihi"
                                   disabled
                                   data-mask="00/00/0000"
                                   placeholder="GG/AA/YYYY"
                                   data-mask-clearifnotmatch="true"
                                   value="<?php echo get_readable_onlydate(isset($form_error) ? set_value("talepTarihi") : $item->talepTarihi); ?>"/>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("talepTarihi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mahalle</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("kapi") : get_townname($talepeden->mahalle); ?>"
                                    name="mahalle"
                                    type="text"
                                    disabled
                                    class="form-control"
                                    placeholder="Kapı No. giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("mahalle"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sokak</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("kapi") : get_streetname($talepeden->sokak); ?>"
                                    name="sokak"
                                    type="text"
                                    disabled
                                    class="form-control"
                                    placeholder="Kapı No. giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("sokak"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Kapı No.</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("kapi") : $talepeden->kapi; ?>"
                                    name="kapi"
                                    type="text"
                                    disabled
                                    class="form-control"
                                    placeholder="Kapı No. giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("kapi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Daire No.</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("daire") : $talepeden->daire; ?>"
                                    name="daire"
                                    type="text"
                                    disabled
                                    class="form-control"
                                    placeholder="Daire No. giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("daire"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cep Telefonu (1)</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("gsm1") : $talepeden->gsm1; ?>"
                                    name="gsm1"
                                    type="text"
                                    disabled
                                    data-mask="0 (500) 000-00-00"
                                    class="form-control"
                                    placeholder="0 (5__) ___-__-__">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("gsm1"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cep Telefonu (2)</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("gsm2") : $talepeden->gsm2; ?>"
                                    name="gsm2"
                                    type="text"
                                    disabled
                                    data-mask="0 (500) 000-00-00"
                                    class="form-control"
                                    placeholder="0 (5__) ___-__-__">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("gsm2"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ePosta Adresi</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("eposta") : $talepeden->eposta; ?>"
                                    name="eposta"
                                    type="email"
                                    disabled
                                    class="form-control"
                                    placeholder="Seçmen ePosta adresini giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("eposta"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <h5>Seçmenin talebi</h5>
                                <textarea id="maxlength-demo-4" disabled class="form-control"
                                          name="gorus"><?php echo $item->istek; ?></textarea>
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
                                   data-mask-clearifnotmatch="true"
                                   value="<?php echo ($item->sonucTarihi != "") ? (get_readable_onlydate(isset($form_error) ? set_value("sonucTarihi") : $item->sonucTarihi)) : ""; ?>"/>
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
                                          name="sonucAciklama"><?php echo $item->sonucAciklama; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-floppy-o"></i>
                            Kaydet
                        </button>
                        <a href="<?php echo base_url("talep"); ?>">
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