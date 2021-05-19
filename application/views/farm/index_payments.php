<style>
	.nav-margin-bottom {
		margin-bottom: 20px;
	}

	#modalDetails {
		background-color: rgba(0, 0, 0, 0.5) !important;
	}

	#modalImages {
		background-color: rgba(0, 0, 0, 0.5) !important;
	}
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
	<div class="layout-px-spacing" style="width:100%">
		<p class="titulo">
			<?= translate('manage_payment_farm_lang'); ?>
			<small class="titulo-2"></small>
			| <a href="<?= site_url('farm/add_payments'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
		</p>
		<div class="col-xs-12">
			<div class="statbox widget box box-shadow">
				<div class="widget-header">
					<h3 class="text-simple"><?= translate('list_payment_farm_lang'); ?></h3>
				</div><!-- /.box-header -->
				<div class="widget-content widget-content-area">
					<?= get_message_from_operation(); ?>
					<div class="table-responsive">
						<br />
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><?= translate("data_payment_lang"); ?></th>
									<th><?= translate("farms_lang"); ?></th>
									<th><?= translate("actions_lang"); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ($payments) { ?>
									<?php foreach ($payments as $item) { ?>
										<tr>
											<td>
												<p><b><?= translate("bank_lang"); ?>: <?= $item->bank ?></b></p>
												<?php
												$tranfers = false;
												if ($item->selectTypeTransaction == 1) {
													$type = "Cheque";
												} elseif ($item->selectTypeTransaction == 2) {
													$type = "Deposito";
												} else if ($item->selectTypeTransaction == 3) {
													$type = "transferencia";
													$tranfers = true;
												} else {
													$type = "Efectivo";
												}
												?>
												<p><strong><?= translate("type_transaction_lang"); ?> : </strong><?= $type; ?></p>
												<p><strong><?= translate("number_transaction_lang"); ?> : </strong><?= $item->numberTransaction; ?></p>
												<p><strong><?= translate("amount_lang"); ?> : </strong><?= number_format($item->balance, 2); ?></p>
												<?php if ($tranfers) { ?>
													<p><strong><?= translate("costo_transferencia_lang"); ?> : </strong><?= number_format($item->costeTransfer, 2); ?></p>
												<?php } ?>
											</td>
											<td>
												<p><?= $item->farm->name_commercial; ?></p>
											</td>
											<td>
												<a href="javascript:void(0)" onclick="handleDetails('<?= base64_encode(json_encode($item->invoices)) ?>')" class="btn btn-primary"><i class="fa fa-remove"></i> <?= translate("details_lang"); ?></a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th><?= translate("data_payment_lang"); ?></th>
									<th><?= translate("farms_lang"); ?></th>
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
<div class="modal fadeInDown" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?= translate('details_lang') ?></h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 table-responsive" id="bodyDetails">

					</div>
					<div class="col-lg-12">
						<h2 class="text-right" id="amountTotal"></h2>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>


<script>
	$(function() {

		$("#example1").DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			}
		});

	});

	const encodeB64Uft8 = (str) => {
		return btoa(unescape(encodeURIComponent(str)));
	}

	const decodeB64Uft8 = (str) => {
		return decodeURIComponent(escape(atob(str)));
	}

	const handleDetails = (items) => {
		let arrItemsCredit = JSON.parse(decodeB64Uft8(items));
		$('#modalDetails').modal({
			backdrop: false
		})
		$('#bodyDetails').empty();
		let acumTotal = 0;
		if (arrItemsCredit.length > 0) {
			let textVariety = '';
			textVariety +=
				'<table id="datatablesVarieties" class="table table-striped" cellspacing="0" width="100%" style="width:100%">';
			textVariety += '<thead>';
			textVariety += '<tr>';
			textVariety += '<th>Nro de factura</th>';
			textVariety += '<th>Marcación</th>';
			textVariety += '<th>Monto cancelado</th>';
			textVariety += '</tr>';
			textVariety += '</thead>';
			textVariety += '<tbody id="bodyTableDetails">';
			arrItemsCredit.forEach((element, indice, varieties) => {
				textVariety += '<tr>';
				textVariety += '<td>';
				textVariety += element.invoice_number;
				textVariety += '</td>';

				textVariety += '<td>';
				textVariety += element.markings.name_marking;
				textVariety += element.markings.name_commercial + ' | ' + element.markings.name_company;
				textVariety += '</td>';

				textVariety += '<td>';
				acumTotal += parseFloat(element.amountInvoice);
				textVariety += parseFloat(element.amountInvoice).toFixed(2);
				textVariety += '</td>';

				textVariety += '</tr>';

			});
			textVariety += '</tbody>';
			textVariety += '</table>';
			$('#bodyDetails').html(textVariety);
			$('#amountTotal').text('$ ' + acumTotal.toFixed(2));
		} else {
			$('#amountTotal').text('$ 0.00');
			$('#bodyDetails').append('<div class="alert alert-info"><?= translate('msg_load_invoice_lang') ?></div>');
		}
	}
</script>