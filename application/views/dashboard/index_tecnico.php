<script src="<?= base_url(); ?>high/js/highcharts.js"></script>
<script src="<?= base_url(); ?>high/js/modules/exporting.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pizarra resumen
            <small>Panel de control</small>
        </h1>
        <div>
            <?= get_message_from_operation(); ?>
        </div>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('tecnico/index'); ?>"><i class="fa fa-dashboard"></i> Pizarra resumen</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue-active">
                    <div class="inner">
                        <h3><?= $solicitudes_recibidas->count_1; ?></h3>

                        <p>Solicitudes recibidas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a style="cursor:pointer;" href="<?= site_url('tecnico/index'); ?>" class="small-box-footer"><label>Más información <i class="fa fa-arrow-circle-right"></i></label></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-active">
                    <div class="inner">
                        <h3><?= $solicitudes_atendidas->count_2; ?></h3>

                        <p>Solicitudes atendidas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a style="cursor:pointer;" href="<?= site_url('tecnico/atendidas') ?>" class="small-box-footer"><label>Más información <i class="fa fa-arrow-circle-right"></i></label></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                    <div class="inner">
                        <h3><?= 0; ?></h3>

                        <p>Solicitudes en proceso</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a href="<?= site_url('opinion/index'); ?>" class="small-box-footer"><label>Más información <i class="fa fa-arrow-circle-right"></i></label></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-active">
                    <div class="inner">
                        <h3><?= 0; ?></h3>

                        <p>Ganancias</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <a href="<?= site_url('noticia/index'); ?>" class="small-box-footer"><label>Más información <i class="fa fa-arrow-circle-right"></i></label></a>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">


                <!-- Chat box -->
                <div class="box box-success">
                    <div class="box-header">
                        <i class="fa fa-line-chart"></i>

                        <h3 class="box-title">Mensajes recibidos</h3>


                    </div>
                    <div class="box-body chat" id="chat-box">

                        <div class="row">
                            <div class="col-xs-12">
                                <div id="chart1" style="height: 400px;">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><?= translate("date_lang"); ?></th>
                                                <th><?= translate("nombre_lang"); ?></th>
                                                <th><?= translate("email_lang"); ?></th>
                                                <th><?= "Teléfono"; ?></th>
                                                <th><?= translate("message_lang"); ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ([] as $item) { ?>
                                                <tr>
                                                    <td><?= $item->fecha_creacion; ?></td>
                                                    <td><?= $item->nombre; ?></td>
                                                    <td> <?= $item->email; ?> </td>
                                                    <td> <?= $item->telef; ?> </td>
                                                    <td> <?= $item->mensaje; ?></td>


                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><?= translate("date_lang"); ?></th>
                                                <th><?= translate("nombre_lang"); ?></th>
                                                <th><?= translate("email_lang"); ?></th>
                                                <th><?= "Teléfono"; ?></th>
                                                <th><?= translate("message_lang"); ?></th>

                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>


                        <!-- /.item -->
                    </div>
                    <!-- /.chat -->
                    <div class="box-footer">

                    </div>
                </div>
                <!-- /.box (chat box) -->





            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>

    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $(function() {
        $("#example1").DataTable();
    });
</script>