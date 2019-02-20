<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b><?php echo get_readable_onlydate($item->tarih); ?></b> tarihinde <b><?php echo $item->evsahibi; ?></b> ev sahipliğinde gerçekleşen ev sohbeti bilgilerini düzenliyorsunuz...
            <a class="btn btn-outline btn-primary btn-sm pull-right"
               href="<?php echo base_url("evsohbeti"); ?>">
                <i class="fa fa-chevron-left"></i> Geri Dön
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("evsohbeti/update/$item->id"); ?>" method="post">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Ev Sahibi</label>
                                    <input
                                            value="<?php echo isset($form_error) ? set_value("evsahibi") : $item->evsahibi; ?>"
                                            name="evsahibi"
                                            type="text"
                                            class="form-control"
                                            placeholder="Ev Sahibi adını giriniz...">
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error pull-right"> <?php echo form_error("evsahibi"); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Ev Sahibi Telefon</label>
                                    <input
                                            value="<?php echo isset($form_error) ? set_value("evsahibitel") : $item->evsahibitel; ?>"
                                            name="evsahibitel"
                                            type="text"
                                            data-mask="0 (000) 000-00-00"
                                            class="form-control"
                                            placeholder="0 (5__) ___-__-__">
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error pull-right"> <?php echo form_error("evsahibitel"); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Hatip</label>
                                    <select id="select2-demo-1" name="hatip" class="form-control" data-plugin="select2">
                                        <option value=""></option>
                                        <?php foreach ($hatips as $hatip) { ?>
                                            <option <?php echo ($hatip->id === $item->hatip) ? "selected" : ""; ?> value="<?php echo $hatip->id; ?>"><?php echo $hatip->adisoyadi; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error pull-right"> <?php echo form_error("hatip"); ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Mahalle</label>
                                    <select id="select2-demo-1" name="mahalle" class="form-control"
                                            data-plugin="select2">
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
                                    <input
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
                                <div class="form-group col-md-6">
                                    <label for="datetimepicker2">Tarih</label>
                                    <br>
                                    <input value="<?php echo get_readable_onlydate(isset($form_error) ? set_value("tarih") : $item->tarih); ?>"
                                           type="text"
                                           class="form-control"
                                           name="tarih"
                                           data-mask="00/00/0000"
                                           placeholder="GG/AA/YYYY"
                                           data-mask-clearifnotmatch="true"/>
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error pull-right"> <?php echo form_error("tarih"); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Katılımcı Sayısı</label>
                                    <input
                                            value="<?php echo isset($form_error) ? set_value("katilimcisayisi") : $item->katilimcisayisi; ?>"
                                            name="katilimcisayisi"
                                            type="text"
                                            class="form-control"
                                            placeholder="Katılımcı sayısını giriniz...">
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error pull-right"> <?php echo form_error("katilimcisayisi"); ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <h5>Kanaat</h5>
                                <div class="col-md-12">
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               id="radio1_1" <?php echo $item->kanaat === 'E' ? "checked" : ""; ?>
                                               name="kanaatoptions" id="E" value="E">
                                        <label for="radio1_1" class="radio">Olumlu</label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               id="radio1_2" <?php echo $item->kanaat === 'H' ? "checked" : ""; ?>
                                               name="kanaatoptions" id="H" value="H">
                                        <label for="radio1_2" class="radio">Olumsuz</label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               id="radio1_3" <?php echo $item->kanaat === 'K' ? "checked" : ""; ?>
                                               name="kanaatoptions" id="K" value="K">
                                        <label for="radio1_3" class="radio"> Kararsız</label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio"
                                               id="radio1_4" <?php echo $item->kanaat === 'N' ? "checked" : ""; ?>
                                               name="kanaatoptions" id="N" value="N">
                                        <label for="radio1_4" class="radio"> Küskün</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-md btn-outline"><i
                                        class="fa fa-refresh"></i>
                                Güncelle
                            </button>
                            <a href="<?php echo base_url("evsohbeti"); ?>">
                                <button type="button" class="btn btn-danger btn-md btn-outline"><i
                                            class="fa fa-ban"></i>
                                    Vazgeç
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4 class="m-b-lg">
                Toplantıda alınan talep/şikayetler
                <a class="btn btn-outline btn-primary btn-sm pull-right"
                   href="<?php echo base_url("talep/new_form"); ?>">
                    <i class="fa fa-plus"></i> Talep Ekle
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
                                <a href="<?php echo base_url("evsohbeti/update_form/$birey->id"); ?>">
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