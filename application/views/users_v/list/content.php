<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Kullanıcı Listesi
            <a class="btn btn-outline btn-info btn-sm pull-right"
               href="<?php echo base_url("users/new_form"); ?>">
                <i class="fa fa-plus"></i> Yeni Ekle
            </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)) { ?>
                <div class="alert alert-warning text-center" style="padding: 8px; margin-bottom: 0px; s">
                    <p style="font-size: larger">Henüz hiçbir kullanıcı eklenmemiş. Eklemek için
                        <a href="<?php echo base_url("users/new_form"); ?>">
                            tıklayın
                        </a>...
                    </p>
                </div>
            <?php } else { ?>
                <table id="datatable-responsive"
                       class="table table-striped table-hover table-bordered content-container">
                    <thead>
                    <th class="w-25">#id</th>
                    <th class="w50">Kullanıcı Resmi</th>
                    <th>Yetki</th>
                    <th>Tam Adı</th>
                    <th>Unvanı</th>
                    <th>ePosta Adresi</th>
                    <th class="w75">Kaydeden</th>
                    <th class="w200">Kayıt Tarihi</th>
                    <th class="w75">Güncelleyen</th>
                    <th class="w200">Güncelleme Tarihi</th>
                    <th class="w50">Durumu</th>
                    <th class="w300">İşlem</th>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td class="text-center"><?php echo $item->id; ?></td>
                            <td>
                                <img src="<?php echo ($item->img_url != "") ? "uploads/users_v/$item->img_url" : "uploads/settings_v/nouserphoto.png"; ?>"
                                     alt="<?php echo $item->user_name; ?>"
                                     class="img-responsive img-rounded"
                                     style="margin: 0px auto; max-width: 200px"
                                     width="100%">
                            </td>
                            <td class="text-center"><?php echo get_userRoleName($item->user_role_id); ?></td>
                            <td class="text-center"><?php echo $item->full_name; ?></td>
                            <td class="text-center"><?php echo $item->title; ?></td>
                            <td class="text-center"><?php echo $item->email; ?></td>
                            <td class="text-center"><?php echo get_username($item->createdBy); ?></td>
                            <td class="text-center"><?php echo get_readable_date($item->createdAt); ?></td>
                            <td class="text-center"><?php echo get_username($item->updatedBy); ?></td>
                            <td class="text-center"><?php echo ($item->updatedAt != "" ? get_readable_date($item->updatedAt) : ""); ?></td>
                            <td class="text-center">
                                <input
                                        data-url="<?php echo base_url("users/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#188ae2"
                                    <?php echo ($item->isActive) ? "checked" : "" ?>
                                />
                            </td>
                            <td class="text-center">
                                <button
                                        data-url="<?php echo base_url("users/delete/$item->id"); ?>"
                                        type="button"
                                        class="btn btn-danger btn-sm btn-outline remove-btn"
                                >
                                    <i class="fa fa-trash-o"></i>
                                    Sil
                                </button>
                                <a href="<?php echo base_url("users/update_form/$item->id"); ?>">
                                    <button type="button" class="btn btn-primary btn-sm btn-outline">
                                        <i class="fa fa-pencil-square-o"></i>
                                        Düzenle
                                    </button>
                                </a>
                                <a href="<?php echo base_url("users/update_password_form/$item->id"); ?>">
                                    <button type="button" class="btn btn-purple btn-sm btn-outline">
                                        <i class="fa fa-key"></i>
                                        Şifre Değiştir
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>