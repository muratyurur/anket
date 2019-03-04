<?php
$t = get_instance();

$user = $t->session->userdata("user");
?>

<?php if ($user->user_role_id == 1 || $user->user_role_id == 2) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Mahalle Seçmen Dağılımı</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div data-plugin="plot" data-options="
							[[
							<?php foreach ($counts as $count) { ?>
							['<?php echo $count->tanim; ?>', <?php echo $count->sayi; ?>],
							<?php } ?>
							]],
							{
								series: {
									bars: { show: true, barWidth: 0.6, align: 'center', fillColor: 'rgb(103, 157, 198)' }
								},
								xaxis: { mode: 'categories', tickLength: 0 },
								grid:{ show: true, borderWidth: 0, color: '#eeeeee', hoverable: true },
								colors: ['rgb(103, 157, 198)'],
								tooltip: true,
								tooltipOpts: { content: 'Seçmen Sayısı: %y',  defaultTheme: false, shifts: { x: 0, y: -40 } }
							}" style="height: 300px;width: 100%;">
                    </div>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Dokunulan Seçmen</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div data-plugin="plot" data-options="
							[
							<?php foreach ($durums as $durum) { ?>
								{
								label: '<?php echo $durum->durum; ?>',
								data: <?php echo $durum->sayi; ?>,
								color: '<?php
                        if ($durum->durum === 'Görüşüldü') {
                            echo "green";
                        } elseif ($durum->durum === 'Evde Bulunamadı') {
                            echo "orange";
                        } elseif ($durum->durum === 'Görüşmeyi Reddetti') {
                            echo "red";
                        }
                        ?>' },
                            <?php } ?>
							],
							{
								series: {
									pie: { show: true }
								},
								legend: { show: false },
								grid: { hoverable: true },
								tooltip: {
									show: true,
									content: '%s %p.2%',
									defaultTheme: true
								}
							}" style="height: 300px;width: 100%;">
                    </div>
                </div><!-- .widget-body -->
                <hr class="widget-separator">
                <footer class="widget-footer text-center">
                    <small>Toplam Dokunulan Seçmen: </small> <h4 style="display: inline"><?php echo number_format($general_count, 0, ',', '.'); ?></h4>
                </footer>
            </div><!-- .widget -->
        </div>
        <div class="col-md-4">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Tuzla Kart Teslim Durumu</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div data-plugin="plot" data-options="
							[
							<?php foreach ($tuzlakarts as $tuzlakart) { ?>
								{
								label: '<?php echo $tuzlakart->durum; ?>',
								data: <?php echo $tuzlakart->sayi; ?>,
								color: '<?php
                        if ($tuzlakart->durum === 'Teslim Aldı') {
                            echo "green";
                        } elseif ($tuzlakart->durum === 'Teslim Edilemedi') {
                            echo "orange";
                        } elseif ($tuzlakart->durum === 'İstemedi') {
                            echo "red";
                        } elseif ($tuzlakart->durum === 'Kartı Var') {
                            echo "blue";
                        }
                        ?>' },
                            <?php } ?>
							],
							{
								series: {
									pie: { show: true }
								},
								legend: { show: false },
								grid: { hoverable: true },
								tooltip: {
									show: true,
									content: '%s %p.2%',
									defaultTheme: true
								}
							}" style="height: 300px;width: 100%;">
                    </div>
                </div><!-- .widget-body -->
                <hr class="widget-separator">
                <footer class="widget-footer text-center">
                    <small>Toplam Dokunulan Seçmen: </small> <h4 style="display: inline"><?php echo number_format($general_count, 0, ',', '.'); ?></h4>
                </footer>
            </div><!-- .widget -->
        </div>
        <div class="col-md-4">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Memnuniyet Durumu</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div data-plugin="plot" data-options="
							[
							<?php foreach ($memnuniyets as $memnuniyet) { ?>
								{
								label: '<?php echo $memnuniyet->durum; ?>',
								data: <?php echo $memnuniyet->sayi; ?>,
								color: '<?php
                        if ($memnuniyet->durum === 'Memnun') {
                            echo "green";
                        } elseif ($memnuniyet->durum === 'Memnun Değil') {
                            echo "purple";
                        } elseif ($memnuniyet->durum === 'Cevap Vermedi') {
                            echo "red";
                        } elseif ($memnuniyet->durum === 'Evde Bulunamadı') {
                            echo "orange";
                        } elseif ($memnuniyet->durum === 'Kısmen Memnun') {
                            echo "yellow";
                        }
                        ?>' },
                            <?php } ?>
							],
							{
								series: {
									pie: { show: true }
								},
								legend: { show: false },
								grid: { hoverable: true },
								tooltip: {
									show: true,
									content: '%s %p.2%',
									defaultTheme: true
								}
							}" style="height: 300px;width: 100%;">
                    </div>
                </div><!-- .widget-body -->
                <hr class="widget-separator">
                <footer class="widget-footer text-center">
                    <small>Toplam Dokunulan Seçmen: </small> <h4 style="display: inline"><?php echo number_format($general_count, 0, ',', '.'); ?></h4>
                </footer>
            </div><!-- .widget -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">
                        Mahallere Göre Görüşme Durumu
                        <a class="btn btn-outline btn-success btn-md pull-right"
                           href="<?php echo base_url("dashboard/excel_mahalle_durum"); ?>">
                            <i class="fa fa-file-excel-o"></i> Excel
                        </a>
                    </h4>
                </header>
                <hr class="widget-separator"/>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Mahalle</th>
                                <th class="w250">Henüz Görüşülmedi</th>
                                <th class="w250">Görüşüldü</th>
                                <th class="w250">Evde Bulunamadı</th>
                                <th class="w250">Görüşmeyi Reddetti</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($mdurums as $mdurum) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $mdurum['tanim']; ?></td>
                                    <td class="text-center"><?php echo number_format($mdurum['Henüz Görüşülmedi'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:green;"><?php echo number_format($mdurum['Görüşüldü'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:orange;"><?php echo number_format($mdurum['Evde Bulunamadı'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:#FF6347;"><?php echo number_format($mdurum['Görüşmeyi Reddetti'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php } ?>
                            <?php foreach ($topdurums as $topdurum) { ?>
                                <tr>
                                    <td class="text-center"><b>TOPLAM</b></td>
                                    <td class="text-center"><b><?php echo number_format($topdurum['Henüz Görüşülmedi'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:green;"><?php echo number_format($topdurum['Görüşüldü'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:orange;"><?php echo number_format($topdurum['Evde Bulunamadı'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:red;"><?php echo number_format($topdurum['Görüşmeyi Reddetti'], 0, ',', '.'); ?></b></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- .widget -->
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">
                        Mahallere Göre Tuzla Kart Teslim Durumu
                        <a class="btn btn-outline btn-success btn-md pull-right"
                           href="<?php echo base_url("dashboard/excel_tuzlakart_durum"); ?>">
                            <i class="fa fa-file-excel-o"></i> Excel
                        </a>
                    </h4>
                </header>
                <hr class="widget-separator"/>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Mahalle</th>
                                <th class="w250">Teslim Aldı</th>
                                <th class="w250">Teslim Edilemedi</th>
                                <th class="w250">İstemedi</th>
                                <th class="w250">Kartı Var</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($mtuzlakarts as $mtuzlakart) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $mtuzlakart['tanim']; ?></td>
                                    <td class="text-center w250" style="color:green;"><?php echo number_format($mtuzlakart['Teslim Aldı'], 0, ',', '.'); ?></td>
                                    <td class="text-center w250" style="color:orange;"><?php echo number_format($mtuzlakart['Teslim Edilemedi'], 0, ',', '.'); ?></td>
                                    <td class="text-center w250" style="color:red;"><?php echo number_format($mtuzlakart['İstemedi'], 0, ',', '.'); ?></td>
                                    <td class="text-center w250" style="color:blue;"><?php echo number_format($mtuzlakart['Kartı Var'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php } ?>
                            <?php foreach ($toptuzlakarts as $toptuzlakart) { ?>
                            <tr>
                                <td class="text-center"><b>TOPLAM</b></td>
                                <td class="text-center w250"><b style="color:green;"><?php echo number_format($toptuzlakart['Teslim Aldı'], 0, ',', '.'); ?></b></td>
                                <td class="text-center w250"><b style="color:orange;"><?php echo number_format($toptuzlakart['Teslim Edilemedi'], 0, ',', '.'); ?></b></td>
                                <td class="text-center w250"><b style="color:red;"><?php echo number_format($toptuzlakart['İstemedi'], 0, ',', '.'); ?></b></td>
                                <td class="text-center w250"><b style="color:blue;"><?php echo number_format($toptuzlakart['Kartı Var'], 0, ',', '.'); ?></b></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- .widget -->
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">
                        Mahallere Göre Memnuniyet Durumu
                        <a class="btn btn-outline btn-success btn-md pull-right"
                           href="<?php echo base_url("dashboard/excel_memnuniyet_durum"); ?>">
                            <i class="fa fa-file-excel-o"></i> Excel
                        </a>
                    </h4>
                </header>
                <hr class="widget-separator"/>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Mahalle</th>
                                <th class="w250">Memnun</th>
                                <th class="w250">Kısmen Memnun</th>
                                <th class="w250">Memnun Değil</th>
                                <th class="w250">Cevap Vermedi</th>
                                <th class="w250">Evde Bulunamadı</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($mmemnuniyets as $mmemnuniyet) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $mmemnuniyet['tanim']; ?></td>
                                    <td class="text-center" style="color:green;"><?php echo number_format($mmemnuniyet['Memnun'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:darkyellow;"><?php echo number_format($mmemnuniyet['Kısmen Memnun'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:purple;"><?php echo number_format($mmemnuniyet['Memnun Değil'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:red;"><?php echo number_format($mmemnuniyet['Cevap Vermedi'], 0, ',', '.'); ?></td>
                                    <td class="text-center" style="color:orange;"><?php echo number_format($mmemnuniyet['Evde Bulunamadı'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php } ?>
                            <?php foreach ($topmemnuniyets as $topmemnuniyet) { ?>
                                <tr>
                                    <td class="text-center"><b>TOPLAM</b></td>
                                    <td class="text-center"><b style="color:green;"><?php echo number_format($topmemnuniyet['Memnun'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:darkyellow;"><?php echo number_format($topmemnuniyet['Kısmen Memnun'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:purple;"><?php echo number_format($topmemnuniyet['Memnun Değil'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:red;"><?php echo number_format($topmemnuniyet['Cevap Vermedi'], 0, ',', '.'); ?></b></td>
                                    <td class="text-center"><b style="color:orange;"><?php echo number_format($topmemnuniyet['Evde Bulunamadı'], 0, ',', '.'); ?></b></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Mahalle Talep Dağılımı</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div data-plugin="plot" data-options="
							[[
							<?php foreach ($mahalletaleps as $mahalletalep) { ?>
							['<?php echo $mahalletalep->tanim; ?>', <?php echo $mahalletalep->sayi; ?>],
							<?php } ?>
							]],
							{
								series: {
									bars: { show: true, barWidth: 0.6, align: 'center', fillColor: 'rgb(255, 204, 102)' }
								},
								xaxis: { mode: 'categories', tickLength: 0 },
								grid:{ show: true, borderWidth: 0, color: '#008BE2', hoverable: true },
								colors: ['rgb(255, 204, 102)'],
								tooltip: true,
								tooltipOpts: { content: 'Talep Sayısı: %y',  defaultTheme: false, shifts: { x: 0, y: -40 } }
							}" style="height: 300px;width: 100%;">
                    </div>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Müdürlük Talep Dağılımı</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                    <div data-plugin="plot" data-options="
							[[
							<?php foreach ($mudurluktaleps as $mudurluktalep) { ?>
							['<?php echo $mudurluktalep->kisatanim; ?>', <?php echo $mudurluktalep->sayi; ?>],
							<?php } ?>
							]],
							{
								series: {
									bars: { show: true, barWidth: 0.6, align: 'center', fillColor: 'rgb(103, 157, 198)' }
								},
								xaxis: { mode: 'categories', tickLength: 0 },
								grid:{ show: true, borderWidth: 0, color: '#008BE2', hoverable: true },
								colors: ['rgb(103, 157, 198)'],
								tooltip: true,
								tooltipOpts: { content: 'Talep Sayısı: %y',  defaultTheme: false, shifts: { x: 0, y: -40 } }
							}" style="height: 300px;width: 100%;">
                    </div>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
<?php } ?>
<?php if ($user->user_role_id == 4) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Sayın <b><?php echo $user->full_name; ?></b>;<br><br>Ekibiniz (<b><?php echo get_teamName($user->ekip_id); ?></b>)
                         bugün (<b><?php echo date("d/m/Y"); ?></b>) aşağıdaki mahalle ve sokaklarda görev yapacaktır.</h4>
                </header>
                <hr class="widget-separator"/>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Mahalle</th>
                                <th>Sokak</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tasks as $task) { ?>
                                <tr>
                                    <td class="text-center"><?php echo get_readable_fulldate($task->tarih); ?></td>
                                    <td class="text-center"><?php echo get_townname($task->mahalle); ?></td>
                                    <td class="text-center"><?php echo get_streetname($task->sokak); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- .widget -->
<!--            <div class="widget">-->
<!--                <header class="widget-header">-->
<!--                    <h4 class="widget-title"><b>--><?php //echo get_teamName($user->ekip_id); ?><!--</b> Personeli</h4>-->
<!--                </header>-->
<!--                <hr class="widget-separator"/>-->
<!--                <div class="widget-body">-->
<!--                    <div class="table-responsive">-->
<!--                        <table class="table table-bordered table-striped table-hover table-responsive">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Tarih</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php //foreach ($tasks as $task) { ?>
<!--                                <tr>-->
<!--                                    <td class="text-center">--><?php //echo get_readable_fulldate($team->tarih); ?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div> .widget -->
        </div><!-- END column -->
    </div>
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            <div class="widget">-->
<!--                <header class="widget-header">-->
<!--                    <h4 class="widget-title">Yarın (<b>--><?php //echo get_readable_onlydate($tomorrow); ?><!--</b>) aşağıdaki mahalle ve sokaklarda görev yapacaktır.</h4>-->
<!--                </header>-->
<!--                <hr class="widget-separator"/>-->
<!--                <div class="widget-body">-->
<!--                    <div class="table-responsive">-->
<!--                        <table class="table table-bordered table-striped table-hover table-responsive">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Tarih</th>-->
<!--                                <th>Mahalle</th>-->
<!--                                <th>Sokak</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php //foreach ($tasks as $task) { ?>
<!--                                <tr>-->
<!--                                    <td class="text-center">--><?php //echo get_readable_fulldate($tomorrow->tarih); ?><!--</td>-->
<!--                                    <td class="text-center">--><?php //echo get_townname($tomorrow->mahalle); ?><!--</td>-->
<!--                                    <td class="text-center">--><?php //echo get_streetname($tomorrow->sokak); ?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div><!-- .widget -->
<!--        </div><!-- END column -->
<!--    </div>-->
<?php } ?>
