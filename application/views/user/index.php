<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_users_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('user/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('user_list_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Usuario</th>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th><?= translate("phone_lang"); ?></th>
                                    <th><?= translate("date_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_users as $item) { ?>
                                    <tr>
                                        <td><?= $item->user_id ?></td>
                                        <td><?= $item->name; ?></td>
                                        <td><?= $item->email; ?></td>
                                        <td><?= $item->phone; ?></td>
                                        <td><?= $item->date_create; ?></td>
                                        <td>
                                            <div class="btn-group mb-4 mr-2" role="group">
                                                <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg></button>
                                                <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                    <a class="dropdown-item" href="<?= site_url('user/update_index/' . $item->user_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                    <?php if ($item->user_id != $this->session->userdata('user_id')) { ?>
                                                        <a onclick="sureUser('<?= $item->user_id; ?>');" class="dropdown-item btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                                    <?php } ?>
                                                </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID Usuario</th>
                                    <th><?= translate("fullname_lang"); ?></th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th><?= translate("phone_lang"); ?></th>
                                    <th><?= translate("date_lang"); ?></th>
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
    const sureUser = function(pUserId) {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("user/delete"); ?>' + '/' + pUserId;
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