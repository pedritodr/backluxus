<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?= base_url();?>admin_lte/plugins/timepicker/bootstrap-timepicker.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('listar_log')." ( ".$fecha." )"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_log'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_log'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>

                        <?= form_open("activelog/buscar_por_fecha");?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group"> <!-- Date input -->
                                    <label class="control-label" for="date"><?= translate("date_lang");?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="date" id="date" required value="<?= $fecha;?>"
                                               placeholder="YYYY-mm-dd">
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-8">
                                <button type="submit" style="margin-top: 25px;" class="btn btn-primary"><i class="fa fa-search"></i> Buscar...</button>
                            </div>
                        </div>
                        <?= form_close();?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= translate("id_lang"); ?></th>
                                <th><?= translate("description_lang"); ?></th>
                                <th><?= translate("action_lang"); ?></th>
                                <th><?= translate("model_lang"); ?></th>
                                <th><?= translate("idModel_lang"); ?></th>
                                <th><?= translate("field_lang"); ?></th>
                                <th><?= translate("creationdate_lang"); ?></th>
                                <th><?= translate("userid_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_logs as $item) { ?>
                                <tr>
                                    <td><?= $item->id;?></td>
                                    <td><?= $item->description;?></td>
                                    <td><?= $item->action; ?></td>
                                    <td><?= $item->model;?></td>
                                    <td><?= $item->idModel;?></td>
                                    <td><?= $item->field;?></td>
                                    <td><?= $item->creationdate;?></td>
                                    <td><?= $item->userid;?></td>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><?= translate("id_lang"); ?></th>
                                <th><?= translate("description_lang"); ?></th>
                                <th><?= translate("action_lang"); ?></th>
                                <th><?= translate("model_lang"); ?></th>
                                <th><?= translate("idModel_lang"); ?></th>
                                <th><?= translate("field_lang"); ?></th>
                                <th><?= translate("creationdate_lang"); ?></th>
                                <th><?= translate("userid_lang"); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function () {
        $("#example1").DataTable(
                {"order": [[ 0, "desc" ]]}
                );

        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        });
        
    });
</script>