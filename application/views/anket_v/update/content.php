<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b><?php echo $item->adi . " " . $item->soyadi; ?></b> adlı seçmene ait bilgileri düzenliyorsunuz...
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("anket"); ?>">
                <i class="fa fa-chevron-left"></i> Geri Dön
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("anket/update/$item->id"); ?>" method="post"
                      enctype="multipart/form-data">
                    <h4>Nüfus Bilgileri</h4>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Adı</label>
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("adi") : $item->adi; ?>"
                                    name="adi"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen adını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("adi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Soyadı</label>
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("soyadi") : $item->soyadi; ?>"
                                    name="soyadi"
                                    type="text"
                                    class="form-control placeholder"
                                    placeholder="Seçmen soyadını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("soyadi"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Vatandaşlık No.</label>
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("tckimlikno") : $item->tckimlikno; ?>"
                                    name="tckimlikno"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen vatandaşlık numarasını giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("tckimlikno"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datetimepicker2">Doğum Tarihi</label>
                            <br>
                                <input disabled
										type="text"
                                       class="form-control"
                                       name="dogumtarihi"
                                       data-mask="00/00/0000"
                                       placeholder="GG/AA/YYYY"
                                       data-mask-clearifnotmatch="true"
                                       value="<?php echo get_readable_onlydate(isset($form_error) ? set_value("dogumtarihi") : $item->dogumtarihi); ?>" />
                                <?php if (isset($form_error)) { ?>
                                    <small class="input-form-error pull-right"> <?php echo form_error("dogumtarihi"); ?></small>
                                <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Anne Adı</label>
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("anaadi") : $item->anaadi; ?>"
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
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("babaadi") : $item->babaadi; ?>"
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
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("dogumyeri") : $item->dogumyeri; ?>"
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
                            <select disabled id="select2-demo-1" name="cinsiyeti" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <option <?php echo ($item->cinsiyeti === 'E') ? "selected" : ""; ?> value="E">ERKEK</option>
                                <option <?php echo ($item->cinsiyeti === 'K') ? "selected" : ""; ?> value="K">KADIN</option>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("cinsiyeti"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Engelli mi?</label>
                            <select disabled id="select2-demo-1" name="engellimi" class="form-control" data-plugin="select2">
                                <option value=""></option>
                                <option <?php echo ($item->engellimi === 'E') ? "selected" : ""; ?> value="E">EVET</option>
                                <option <?php echo ($item->engellimi === 'H') ? "selected" : ""; ?> value="H">HAYIR</option>
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
                                    value="<?php echo isset($form_error) ? set_value("gsm1") : $item->gsm1; ?>"
                                    name="gsm1"
                                    type="text"
                                    class="form-control"
                                    placeholder="Seçmen cep telefonu giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("gsm1"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cep Telefonu (2)</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("gsm2") : $item->gsm2; ?>"
                                    name="gsm2"
                                    type="text"
                                    class="form-control placeholder"
                                    placeholder="Seçmen cep telefonu giriniz...">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error pull-right"> <?php echo form_error("gsm2"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ePosta Adresi</label>
                            <input
                                    value="<?php echo isset($form_error) ? set_value("eposta") : $item->eposta; ?>"
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
                            <select disabled id="select2-demo-1" name="mahalle" class="form-control" data-plugin="select2">
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
                            <select disabled id="select2-demo-1" name="sokak" class="form-control" data-plugin="select2">
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
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("kapi") : $item->kapi; ?>"
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
                            <input disabled
                                    value="<?php echo isset($form_error) ? set_value("daire") : $item->daire; ?>"
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
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4 class="m-b-lg">
                Aynı adreste ikamet eden diğer seçmenler
                <a class="btn btn-outline btn-primary btn-sm pull-right"
                   href="<?php echo base_url("anket/copy/$item->id"); ?>">
                    <i class="fa fa-copy"></i> Kopyala
                </a>
            </h4>
            <hr>
                <table id="datatable-responsive" class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <th class="w20"></th>
                    <th class="w20">#id</th>
                    <th class="w200">Adı</th>
                    <th class="w200">Soyadı</th>
                    <th class="w150">Vatandaşlık No</th>
                    <th class="w200">Sokak Adı</th>
                    <th class="w75">Kapı No</th>
                    <th class="w75">Daire No</th>
                    <th class="w125">Görüşme Durumu</th>
                    </thead>
                    <tbody>
                    <?php foreach ($evhalki as $birey) { ?>
                        <tr>
                            <td class="text-center">
                                <a href="<?php echo base_url("anket/update_form/$birey->id"); ?>">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>
                            </td>
                            <td class="text-center"><?php echo $birey->id; ?></td>
                            <td class="text-center"><?php echo $birey->adi; ?></td>
                            <td class="text-center"><?php echo $birey->soyadi; ?></td>
                            <td class="text-center"><?php echo $birey->tckimlikno; ?></td>
                            <td class="text-center"><?php echo $birey->sokak ?></td>
                            <td class="text-center"><?php echo $birey->kapi; ?></td>
                            <td class="text-center"><?php echo $birey->daire; ?></td>
                            <td class="text-center" style="color: <?php echo get_statementColor($birey->durum); ?>">
                                <i class="<?php echo get_statementIcon($birey->durum); ?>"></i>
                                <?php echo get_statementName($birey->durum); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div><!-- .widget -->
    </div>
</div>