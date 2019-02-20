<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Ekip Kullanıcı Listesi
            <a class="btn btn-outline btn-danger btn-sm pull-right"
               href="<?php echo base_url("ekip-anketor/clear"); ?>">
                <i class="fa fa-trash-o"></i> Listeyi Temizle
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
                <table id="datatable-responsive"
                       class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <th class="w300">Ekip</th>
                    <th class="w300">Kullanıcı</th>
                    <th class="w200">Kaydeden</th>
                    <th class="w200">Kayıt Tarihi</th>
                    <th class="w200">Güncelleyen</th>
                    <th class="w200">Güncelleme Tarihi</th>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td class="text-center">
                                <select
                                        data-url="<?php echo base_url("ekip_kullanici/ekipSetter/$user->id"); ?>"
                                        style="width: 100%; height: 100%"
                                        data-id="<?php echo $user->id; ?>"
                                        id="ekip-<?php echo $user->id; ?>"
                                        name="ekip_id"
                                        class="form-control ekip">
                                    <option value=""></option>
                                    <?php foreach ($teams as $team) { ?>
                                        <option <?php echo ($team->id === $user->ekip_id) ? "selected" : ""; ?>
                                                value="<?php echo $team->id; ?>">
                                            <?php echo $team->tanim; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center"><?php echo $user->full_name; ?></td>
                            <td class="text-center"><?php echo get_username($user->createdBy); ?></td>
                            <td class="text-center"><?php echo get_readable_date($user->createdAt); ?></td>
                            <td class="text-center"><?php echo get_username($user->updatedBy); ?></td>
                            <td class="text-center"><?php echo ($user->updatedAt != "" ? get_readable_date($user->updatedAt) : ""); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>