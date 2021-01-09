<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_variety_lang'); ?>
            <small><?= translate('update_variety_provider_lang'); ?></small>
            | <a href="<?= site_url('provider/products/' . $provider_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('manage_variety_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_variety_provider_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("provider/update_product"); ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <label><?= translate("subcategories_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrows"></i></span>
                                    <select id="categoria_id" name="categoria_id" class="form-control input-sm" style="width: 100%">
                                        <option>Selecciones una categoria</option>
                                        <?php
                                        if (isset($all_categories))
                                            foreach ($all_categories as $item) { ?>
                                        <option <?php if ($item->product_category_id == $object_product->product_category_id) { ?> selected <?php } ?> value="<?= $item->product_category_id; ?>"><?= $item->name; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label><?= translate("varieties_lang"); ?></label>
                                        <div id="select_varieties" class="input-group">
                                            <span id="span_variety" class="input-group-addon"><i class="fa fa-certificate"></i></span>
                                            <select id="variety" name="variety" class="form-control input-sm" data-placeholder="Seleccione las variedades" style="width: 100%">
                                                <?php
                                                if ($all_products)
                                                    foreach ($all_products as $item) { ?>
                                                <option <?php if ($item->product_id == $object_provider_product->product_id) { ?> selected <?php } ?> value="<?= $item->product_id; ?>"><?= $item->name; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <input type="hidden" name="provider_id" value="<?= $provider_id; ?>" />
                                <input type="hidden" name="provider_product_id" value="<?= $object_provider_product->provider_product_id; ?>" />

                                <div class="row">
                                    <br>
                                    <div class="col-xs-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                    </div>
                                </div>

                            </div>


                            <?= form_close(); ?>


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

    / $('#categoria_id').change(function() {

          var id = $("select[name=categoria_id]").val();
          $("select[name=variety]").remove();
          $('#span_variety').remove();
          $('#body_varieties').show();
          $.ajax({
              type: 'POST',
              url: "<?= site_url('provider/get_product_by_category') ?>",
              data: {
                  id: id
              },
              success: function(result) {
                  result = JSON.parse(result);

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
         /* $.ajax({
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
      });*/
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>