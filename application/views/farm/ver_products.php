<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_providers_lang'); ?>
            <small> <?= translate('ver_variedades_lang'); ?></small>
            | <a href="<?= site_url('provider/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('ver_variedades_lang'); ?>
            </li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_variety_lang'); ?>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("varieties_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_products as $item) { ?>
                                <tr>
                                    <td style="width:50%">
                                        <?= $item->name ?>
                                    </td>
                                    <td>
                                        <img style="width:350px;height:150px;" class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" />
                                    </td>

                                </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("varieties_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
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
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        $(".select2").select2();

    });

    var provider_id = <?= json_encode($provider_id); ?>;
    //console.log(all_products);
    $('#categoria_id').change(function() {

        var id = $("select[name=categoria_id]").val();
        // var provider_id = $("select[name=provider_id]").val();
        $('#body_varieties').show();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('provider/get_product_by_category') ?>",
            data: {
                id: id,
                provider_id: provider_id
            },
            success: function(result) {
                result = JSON.parse(result);
                console.log(result);
                var opcion = "Seleccione una opción";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-tags' aria-hidden='true'></i></i></span><select id='variety' name='variety' class='form-control input-sm'  style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";

                for (let i = 0; i < result.length; i++) {
                    cadena = cadena + "<option value='" + result[i].product_id + "'>" + result[i].name + "</option>";

                }
                cadena = cadena + "</select>"
                $('#select_varieties').html(cadena);
            }
        });
        $.ajax({
            type: 'POST',
            url: "<?= site_url('provider/get_all_measures') ?>",

            success: function(result) {
                result = JSON.parse(result);
                var cadena = "";
                for (let i = 0; i < result.length; i++) {
                    cadena = cadena + "<option value='" + result[i].measure_id + "'>" + result[i].name + "</option>";
                }

                $('#medida').html(cadena);
            }
        });
    });

    $(".box-body").bind("click", function() {
        $('#variety').change(function() {
            $('#body_measure').show();
        });
    });
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>