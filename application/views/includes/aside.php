<?php
$t = get_instance();

$user = $t->session->userdata("user");
?>
<aside id="menubar" class="menubar light" style="padding-top: 0px;">
    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li>
                    <a href="<?php echo base_url(); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Ana Sayfa</span>
                    </a>
                </li>

                <?php if ($user->user_role_id == 1) { ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                            <span class="menu-text">Sistem Yönetimi</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu" id="user-submenu">
                            <li>
                                <a href="<?php echo base_url("users"); ?>">
                                    <span class="menu-text">Kullanıcılar</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("user-roles"); ?>">
                                    <span class="menu-text">Kullanıcı Rolleri</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("email-settings"); ?>">
                                    <span class="menu-text">ePosta Ayarları</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("requests"); ?>">
                                    <span class="menu-text">Talep Durumu Tanımları</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 2) { ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-assignment-account zmdi-hc-lg"></i>
                            <span class="menu-text">Ekip Modülü</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu" id="team-submenu">
                            <li>
                                <a href="<?php echo base_url("ekip"); ?>">
                                    <span class="menu-text">Ekip Tanımları</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("ekip-anketor"); ?>">
                                    <span class="menu-text">Kullanıcı Ekip Atama</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("ekip-gorev"); ?>">
                                    <span class="menu-text">Ekip Görev Listesi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <!--                --><?php //if ($user->user_role_id == 1 || $user->user_role_id == 2) { ?>
                <!--                    <li class="has-submenu">-->
                <!--                        <a href="javascript:void(0)" class="submenu-toggle">-->
                <!--                            <i class="menu-icon zmdi zmdi-comment-list zmdi-hc-lg"></i>-->
                <!--                            <span class="menu-text">Talep Modülü</span>-->
                <!--                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>-->
                <!--                        </a>-->
                <!--                        <ul class="submenu" id="talep-submenu">-->
                <!--                            <li>-->
                <!--                                <a href="--><?php //echo base_url("talep"); ?><!--">-->
                <!--                                    <span class="menu-text">Talep Listesi</span>-->
                <!--                                </a>-->
                <!--                        </ul>-->
                <!--                    </li>-->
                <!--                --><?php //} ?>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 2) { ?>
                    <li>
                        <a href="<?php echo base_url("talep"); ?>">
                            <i class="menu-icon zmdi zmdi-comment-list zmdi-hc-lg"></i>
                            <span class="menu-text">Talep Modülü</span>
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href="<?php echo base_url("secmen"); ?>">
                        <i class="menu-icon zmdi zmdi-accounts-list-alt zmdi-hc-lg"></i>
                        <span class="menu-text">Seçmen Sandık Listesi</span>
                    </a>
                </li>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 3) { ?>
                    <li>
                        <a href="<?php echo base_url("adres"); ?>">
                            <i class="menu-icon zmdi zmdi-labels zmdi-hc-lg"></i>
                            <span class="menu-text">Etiket Programı</span>
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href="<?php echo base_url("anket"); ?>">
                        <i class="menu-icon zmdi zmdi-assignment-check zmdi-hc-lg"></i>
                        <span class="menu-text">Anket Çalışması</span>
                    </a>
                </li>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 2 || $user->user_role_id == 3) { ?>
                    <li>
                        <a href="<?php echo base_url("hemsehri"); ?>">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text">Hemşehri Çalışması</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 2 || $user->user_role_id == 3) { ?>
                    <li>
                        <a href="<?php echo base_url("evsohbeti"); ?>">
                            <i class="menu-icon zmdi zmdi-home zmdi-hc-lg"></i>
                            <span class="menu-text">Ev Sohbeti Çalışması</span><br>
                            <small><i class="zmdi zmdi-alarm-check"></i> Yapım Aşamasında</small>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 2 || $user->user_role_id == 3) { ?>
                    <li>
                        <a href="<?php echo base_url("tuzlakart"); ?>">
                            <i class="menu-icon fa fa-id-card"></i>
                            <span class="menu-text">Tuzla Kart</span><br>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($user->user_role_id == 1 || $user->user_role_id == 2) { ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-chart zmdi-hc-lg"></i>
                            <span class="menu-text">Raporlar</span><br>
                            <small><i class="zmdi zmdi-alarm-check"></i> Yapım Aşamasında</small>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                    </li>
                <?php } ?>

                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("akfirat"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Akfırat Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("anadolu"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Anadolu Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("aydinli"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Aydınlı Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("aydintepe"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Aydıntepe Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("cami"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Cami Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("evliyacelebi"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Evliya Çelebi Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("fatih"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Fatih Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("icmeler"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">İçmeler Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("istasyon"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">İstasyon Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("mescit"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Mescit Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("mimarsinan"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Mimar Sinan Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("orhanli"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Orhanlı Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("orta"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Orta Mahalle</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("postane"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Postane Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("sifa"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Şifa Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("tepeoren"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Tepeören Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!---->
                <!--                <li>-->
                <!--                    <a href="--><?php //echo base_url("yayla"); ?><!--">-->
                <!--                        <i class="menu-icon fa fa-check-square-o"></i>-->
                <!--                        <span class="menu-text">Yayla Mahallesi</span>-->
                <!--                    </a>-->
                <!--                </li>-->
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
