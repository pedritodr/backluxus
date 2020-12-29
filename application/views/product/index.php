<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_productos_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('product/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_productos_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("description_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_productos) { ?>
                                    <?php foreach ($all_productos as $item) { ?>
                                        <tr>
                                            <td>
                                                <p><?= $item->name; ?></p>
                                                <?php if (isset($item->categoria)) { ?>
                                                    <p><strong><?= translate("category_lang"); ?> : </strong><?= $item->categoria->name; ?></p>
                                                <?php } ?>
                                                <?php if (isset($item->type)) { ?>
                                                    <p><strong><?= "Tipo" ?> : </strong><?= $item->type->name ?></p>
                                                <?php } ?>
                                                <?php if (isset($item->color)) { ?>
                                                    <p><strong><?= "Color" ?> : </strong><?= $item->color->name ?></p>
                                                <?php } ?>
                                            </td>
                                            <td style="width:20%">
                                                <?php if (file_exists($item->photo)) { ?>
                                                    <img class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" style="width: 45%" />
                                                <?php } else { ?>
                                                    <img src="<?= base_url('assets/img/imagen-no-found.png') ?>" style="width:100%" class="img-fluid" alt="">
                                                <?php } ?>
                                            </td>
                                            <td><?= $item->description; ?></td>

                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" href="<?= site_url('product/update_index/' . $item->product_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                                        <a class="dropdown-item btn btn-danger" href="javascript:void(0)" onclick="deleteProduct('<?= $item->product_id ?>')"><i class="fa fa-edit"></i> <?= translate("delete_lang"); ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("description_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->


<script>
    const deleteProduct = (productId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("product/delete"); ?>' + '/' + productId;
                window.location.href = urlDelete;
            }
        })
    }
    $(function() {

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });
</script>