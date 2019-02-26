<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Seçmen Ekle
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("anket"); ?>">
                <i class="fa fa-chevron-left"></i> Geri Dön
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("anket/save"); ?>" method="post">
                    <h4>Nüfus Bilgileri</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Adı</label>
                            <input name="adi"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen adını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("adi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Soyadı</label>
                            <input name="soyadi"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen soyadını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("soyadi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Vatandaşlık No.</label>
                            <input name="tckimlikno"
                                    type="number"
                                    class="form-control"
                                    placeholder="Seçmen vatandaşlık numarasını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("tckimlikno"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datetimepicker2">Doğum Tarihi</label>
                            <br>
                            <input type="text"
                                   class="form-control"
                                   name="dogumtarihi"
                                   data-mask="00/00/0000"
                                   placeholder="GG/AA/YYYY"
                                   data-mask-clearifnotmatch="true"/>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("dogumtarihi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Anne Adı</label>
                            <input
                                    name="anaadi"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen anne adını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("anaadi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Baba Adı</label>
                            <input
                                    name="babaadi"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen baba adını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("babaadi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Doğum Yeri</label>
                            <input
                                    name="dogumyeri"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen doğum yerini giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("dogumyeri"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cinsiyeti</label>
                            <select id="select2-demo-1" name="cinsiyeti" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <option value="E">ERKEK</option>
                                <option value="K">KADIN</option>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("cinsiyeti"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Engelli mi?</label>
                            <select id="select2-demo-1" name="engellimi" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <option value="E">EVET</option>
                                <option value="H">HAYIR</option>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("engellimi"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <h4>İletişim Bilgileri</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Cep Telefonu (1)</label>
                            <input
                                    name="gsm1"
                                    type="text"
                                    class="form-control"
                                    data-mask="0 (500) 000-00-00"
                                    placeholder="0 (5__) ___-__-__">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("gsm1"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cep Telefonu (2)</label>
                            <input
                                    name="gsm2"
                                    type="text"
                                    class="form-control placeholder"
                                    data-mask="0 (500) 000-00-00"
                                    placeholder="0 (5__) ___-__-__">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("gsm2"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ePosta Adresi</label>
                            <input
                                    name="eposta"
                                    type="email"
                                    class="form-control"
                                    placeholder="Seçmen ePosta adresini giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("eposta"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <h4>Adres Bilgileri</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Mahalle</label>
                            <select id="select2-demo-1" name="mahalle" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <?php foreach ($mahalle as $mvalue) { ?>
                                    <option <?php echo ($mvalue->id === $item->mahalle) ? "selected" : ""; ?> value="<?php echo $mvalue->id; ?>"><?php echo $mvalue->tanim; ?></option>
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
                                    <option <?php echo ($svalue->id === $item->sokak ? "selected" : ""); ?> value="<?php echo $svalue->id; ?>"><?php echo $svalue->tanim; ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("sokak"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Kapı No.</label>
                            <input
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
                        <div class="col-md-4">
                            <h5>Tuzla Kart Aldı mı?</h5>
                            <hr>
                            <div class="col-md-12">
                                <div class="radio radio-success">
                                    <input type="radio"
                                           id="radio1_1" <?php echo $item->tuzlakart === 'E' ? "checked" : ""; ?>
                                           name="tuzlakartoptions" id="E" value="E">
                                    <label for="radio1_1" class="radio">Evet</label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio"
                                           id="radio1_2" <?php echo $item->tuzlakart === 'H' ? "checked" : ""; ?>
                                           name="tuzlakartoptions" id="H" value="H">
                                    <label for="radio1_2" class="radio">Hayır</label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio"
                                           id="radio1_3" <?php echo $item->tuzlakart === 'I' ? "checked" : ""; ?>
                                           name="tuzlakartoptions" id="I" value="I">
                                    <label for="radio1_3" class="radio"> İstemedi</label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio"
                                           id="radio1_4" <?php echo $item->tuzlakart === 'V' ? "checked" : ""; ?>
                                           name="tuzlakartoptions" id="V" value="V">
                                    <label for="radio1_4" class="radio"> Var</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Hizmetlerimizden memnun musunuz?</h5>
                            <hr>
                            <div class="col-md-12">
                                <div class="radio radio-primary">
                                    <input type="radio"
                                           id="radio2_1" <?php echo $item->memnuniyet === 'E' ? "checked" : ""; ?>
                                           name="memnuniyetoptions" id="E" value="E">
                                    <label for="radio2_1" class="radio">Evet</label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio"
                                           id="radio2_2" <?php echo $item->memnuniyet === 'H' ? "checked" : ""; ?>
                                           name="memnuniyetoptions" id="H" value="H">
                                    <label for="radio2_2" class="radio">Hayır</label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio"
                                           id="radio2_3" <?php echo $item->memnuniyet === 'I' ? "checked" : ""; ?>
                                           name="memnuniyetoptions" id="K" value="K">
                                    <label for="radio2_3" class="radio"> Kısmen</label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio"
                                           id="radio2_4" <?php echo $item->memnuniyet === 'C' ? "checked" : ""; ?>
                                           name="memnuniyetoptions" id="C" value="C">
                                    <label for="radio2_4" class="radio"> Cevap Vermedi</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Görüşme Durumu</h5>
                            <hr>
                            <div class="col-md-12">
                                <div class="radio radio-danger">
                                    <input type="radio"
                                           id="radio3_1" <?php echo $item->durum === 'G' ? "checked" : ""; ?>
                                           name="durumoptions" id="G" value="G">
                                    <label for="radio3_1" class="radio"> Görüşüldü</label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio"
                                           id="radio3_2" <?php echo $item->durum === 'B' ? "checked" : ""; ?>
                                           name="durumoptions" id="B" value="B">
                                    <label for="radio3_2" class="radio"> Evde Bulunamadı</label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio"
                                           id="radio3_3" <?php echo $item->durum === 'R' ? "checked" : ""; ?>
                                           name="durumoptions" id="R" value="R">
                                    <label for="radio3_3" class="radio"> Görüşmeyi Reddetti</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <h5>Belediyemizden bir isteğiniz, öneriniz var mı?</h5>
                                <hr>
                                <textarea id="maxlength-demo-4" class="form-control" name="gorus"><?php echo $item->gorus; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-floppy-o"></i>
                        Kaydet
                    </button>
                    <a href="<?php echo base_url("anket"); ?>">
                        <button type="button" class="btn btn-danger btn-md btn-outline"><i class="fa fa-ban"></i>
                            Vazgeç
                        </button>
                    </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>