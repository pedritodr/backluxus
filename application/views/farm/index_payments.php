<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>admin_template/assets/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
<style>
	#modalDetails {
		background-color: rgba(0, 0, 0, 0.5) !important;
	}

	#modalRegisterPayment {
		background-color: rgba(0, 0, 0, 0.5) !important;
	}
</style>
<div class="main-container" id="container">
	<div class="layout-px-spacing" style="width:100%">
		<p class="titulo">
			<small class="titulo-2"><?= translate('manage_payment_farm_lang'); ?></small>
		</p>
		<div class="col-xs-12 col-margin-top">

			<div class="statbox widget box box-shadow">
				<div class="widget-header">
					<h3 class="text-simple"><?= translate('form_search_lang') ?></h3>
				</div><!-- /.box-header -->
				<div class="widget-content widget-content-area">
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<label><?= translate('fecha_lang') ?></label>
								<input type="text" disabled class="form-control" id="until" />
							</div>
						</div>
						<div class="col-6">
							<label><?= translate("farms_lang"); ?></label>
							<div class="input-group">
								<select id="selectFarms" name="farms" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
									<option value="0"><?= translate('select_opction_lang') ?></option>
									<?php if ($farms) { ?>
										<?php foreach ($farms as $item) { ?>
											<option itemId="<?= $item->farm_id ?>" value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name_legal . ' | ' . $item->name_commercial ?></option>
										<?php   } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-3" id="zoneBtn">
							<a onclick="searchInvoices()" id="btnSearch" class="btn btn-primary" style="margin-top: 35px;"><?= translate('search_now_lang') ?></a>
							<div style="display:none;margin-top:35px" id="zoneLoading"><a><img src="<?= base_url('assets/img/cargando.gif'); ?>" style="width:50%" /></a></div>
						</div>
					</div>

					<div class="row" id="bodyResumen" style="display:none">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<h3 class="text-left"><b><?= translate('resumen_mes_lang') ?>: </b><span id="textResumenActual" style="color:#e7515a"></span></h3>
						</div>
					</div>

				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<div class="statbox widget box box-shadow" style="margin-top: 25px;">
				<div class="widget-header">
					<h3 class="text-simple"><?= translate('list_invoice_farm_lang') ?></h3>
				</div><!-- /.box-header -->
				<div class="widget-content widget-content-area">
					<div class="row" id="bodyResumenBtn" style="margin-bottom:10px; display:none">
						<div class="col-lg-12">
							<h3 class="text-left"><b><?= translate('resumen_selected_invoice_lang') ?>: </b><span id="textResumenSelected" style="color:#e7515a">$ 0.00</span><span style="display:none" id="bodyBtnRegisterPayment"> <button type="button" class="btn btn-outline-dark" onclick="handleRegisterPayment()"><?= translate('register_payment_lang') ?></button></span></h3>
							<button type="button" class="btn btn-success" id="btnSelected"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
									<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
									<polyline points="22 4 12 14.01 9 11.01"></polyline>
								</svg> <?= translate('selected_all_invoice_lang') ?></button>
						</div>
					</div>
					<div class="table-responsive" id="zoneContents">
						<div class="alert alert-info"><?= translate('msg_range_date_lang') ?></div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
</div>
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?= translate('details_lang') ?></h5>
			</div>
			<div class="modal-body table-responsive" id="bodyModalDetails">

			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalRegisterPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?= translate('register_payment_lang') ?></h5>
			</div>
			<div class="modal-body">
				<h1 class="text-center"><span class="badge outline-badge-secondary" id="spanModalBalance"> </span></h1>
				<div class="form-group">
					<label for="bank"><?= translate('bank_lang') ?></label>
					<input autocomplete="off" type="text" class="form-control" id="bank">
				</div>
				<label><?= translate('type_transaction_lang') ?></label>
				<div class="form-group">
					<select class="form-control" id="selectTypeTransaction" onchange="handleChangeSelectType()">
						<option value="1">Cheque</option>
						<option value="2">Deposito</option>
						<option value="3">transferencia</option>
						<option value="4">Efectivo</option>
					</select>
				</div>
				<div class="form-group">
					<label for="numberTransaction"><?= translate('number_transaction_lang') ?></label>
					<input autocomplete="off" type="text" class="form-control" id="numberTransaction">
				</div>
				<div class="form-group">
					<label for="amount"><?= translate('amount_lang') ?></label>
					<input autocomplete="off" type="number" class="form-control" id="amount">
				</div>
				<div class="form-group" id="bodyCostoTransfer" style="display:none">
					<label for="costeTransfer"><?= translate('costo_transferencia_lang') ?></label>
					<input autocomplete="off" type="number" class="form-control" id="costeTransfer" value="0">
				</div>

			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
				<button class="btn btn-primary" onclick="handleSubmitPayment()"><?= translate('process_payment_lang') ?></button>
			</div>
		</div>
	</div>
</div>
<script>
	$(() => {

		let until = flatpickr(document.getElementById('until'), {
			defaultDate: 'today'
		});
		$("#selectFarms").select2({
			tags: false,
			placeholder: '<?= translate('select_opction_lang') ?>',
			allowClear: false,
		});
		$("#selectFarms").select2('open');
	})

	let arrInvoicesFarm = [];

	const encodeB64Uft8 = (str) => {
		return btoa(unescape(encodeURIComponent(str)));
	}
	const decodeB64Uft8 = (str) => {
		return decodeURIComponent(escape(atob(str)));
	}


	const loadInvoices = (farmId) => {
		let url = '<?= site_url("farm/loadInvoicePayment") ?>';
		$.post(url, {
			farmId
		}, function(response) {
			response = JSON.parse(response);
			//console.log(response);
			$("#btnSearch").show();
			$("#zoneLoading").hide();
			let balance = 0;
			if (response.status == 200) {
				if (response.data.length > 0) {
					arrInvoicesFarm = response.data;
					let stringTable = '';
					stringTable +=
						'<table id="datatableGeneral" class="table table-striped table-no-bordered" cellspacing="0" width="100%" style="width:100%">';
					stringTable += '<thead>';
					stringTable += '<tr>';
					stringTable += '<th>Fecha</th>';
					stringTable += '<th>Detalle</th>';
					stringTable += '<th>Marcación</th>';
					stringTable += '<th>Debe</th>';
					stringTable += '<th>Crédito</th>';
					stringTable += '<th>Pago</th>';
					stringTable += '<th>Saldo</th>';
					stringTable += '<th>Acciones</th>';
					stringTable += '</tr>';
					stringTable += '</thead>';

					stringTable += '<tbody>';
					arrInvoicesFarm.forEach(function(item, indice, arr) {
						item.selected = false;
						delete(item.change);
						stringTable += '<tr>';

						stringTable += '<td>';
						stringTable += item.date_create;
						stringTable += '</td>';

						stringTable += '<td>';
						if (item.viewed !== undefined) {
							stringTable += '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#1b55e2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
						}
						stringTable += '<span style="margin-left:4px">' + item.invoice_number + '-' + item.farms.name_commercial + '</span>';
						stringTable += '</td>';

						stringTable += '<td>';
						stringTable += item.markings.name_marking;
						stringTable += '</td>';
						let acumDebe = 0;
						if (item.details.length > 0) {
							item.details.forEach(box => {
								if (box.varieties.length > 0) {
									box.varieties.forEach(element => {
										acumDebe += parseFloat(element.price) * (parseInt(element.stems) * parseInt(box.boxNumber) * parseInt(element.bunches));
									});
								}
							});
						}

						stringTable += '<td>';
						stringTable += acumDebe.toFixed(2);
						stringTable += '</td>';

						stringTable += '<td>';
						let amountCredit = 0;
						item.credit !== undefined ? amountCredit = item.credit.amount : amountCredit = 0;
						stringTable += parseFloat(amountCredit).toFixed(2);
						stringTable += '</td>';

						stringTable += '<td>';
						let amountPayment = 0;
						if (item.payments !== undefined) {
							if (item.payments.length > 0) {
								item.payments.forEach(payment => {
									amountPayment += parseFloat(parseFloat(payment.payment.amount).toFixed(2));
								});
							}
						}
						stringTable += parseFloat(amountPayment).toFixed(2);
						let totalActual = parseFloat(acumDebe.toFixed(2)) - amountPayment;
						item.amountInvoice = parseFloat(totalActual.toFixed(2));
						let saldo = acumDebe - (amountCredit + amountPayment);
						balance += saldo;
						stringTable += '</td>';

						stringTable += '<td>';
						stringTable += saldo.toFixed(2);
						stringTable += '</td>';

						stringTable += '<td>';
						stringTable += '<button type="button" class="btn btn-outline-primary" onclick=watchDetails("' + encodeB64Uft8(JSON.stringify(item.details)) + '")>Ver detalle</button><br>';
						if (saldo > 0) {
							stringTable += '<div class="n-chk" style="margin-top:8px"><label class="new-control new-checkbox checkbox-outline-secondary new-checkbox-text"><input type="checkbox" class="new-control-input" id="check' + item.invoice_farm + '" onclick=handleSelectedInvoice("' + indice + '")><span class="new-control-indicator"></span><span class="new-chk-content" id="spanCheck' + item.invoice_farm + '"><?= translate('selected_invoice_lang') ?></span></label> </div>';
						}
						stringTable += '</td>';

						stringTable += '</tr>';
					});
					stringTable += '</tbody>';
					stringTable += '</table>'
					$("#zoneContents").empty();
					$("#zoneContents").html(stringTable);
					$('#btn_exportar').show();
					$("#datatableGeneral").DataTable({
						"language": {
							"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
						}
					});

					$('#textResumenActual').text('$ ' + balance.toFixed(2));
					let until = flatpickr(document.getElementById('until'), {
						defaultDate: response.date
					});
					$('#btnSelected').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> <?= translate('selected_all_invoice_lang') ?>')
					$('#btnSelected').attr('onclick', 'handleSelectedAll()')
					$('#bodyResumenBtn').show();
					$('#bodyResumen').show();
					$("#zoneBtn").append(
						'<button id="btnClear" style="margin-top:35px" onclick="limpiarBusqueda();" class="btn btn-danger">Limpiar</button>'
					);
				} else {
					arrInvoicesFarm = [];
					$('#bodyResumenBtn').hide();
					$('#btn_exportar').hide();
					$("#zoneContents").empty();
					$('#zoneContents').html(
						'<div class="alert alert-info">Usted debe seleccionar un rango de fechas</div>');
					swal({
						title: 'Uppsss!',
						text: "No se encuentran facturas en este rango de fechas",
						type: 'error',
						padding: '2em'
					});
				}
			}
		});
	}

	const limpiarBusqueda = () => {
		arrInvoicesFarm = [];
		$('#bodyResumenBtn').hide();
		$("#btnClear").remove();
		$("#since").val('');
		$("#until").val('');
		$('#bodyResumen').hide();
		$("#zoneContents").empty();
		$('#zoneContents').html('<div class="alert alert-info">Usted debe seleccionar un rango de fechas</div>');
	}

	const searchInvoices = () => {

		$("#btnClear").remove();
		let selectFarms = $('select[id=selectFarms] option').filter(':selected').attr('itemId');
		if (selectFarms !== undefined) {
			$("#btnSearch").hide();
			$("#zoneLoading").show();
			loadInvoices(selectFarms);
		} else {
			swal({
				title: 'Uppsss!',
				text: "Seleccione la finca para realizar la busqueda",
				type: 'error',
				padding: '2em'
			});
		}

	}

	const watchDetails = (details) => {
		details = decodeB64Uft8(details);
		details = JSON.parse(details);
		$("#modalDetails").modal('show');
		$("#bodyModalDetails").empty();
		let qtyBox = 0;
		let qtyStems = 0;
		let qtyBouquets = 0;
		let acumTotalStm = 0;
		let acumPrice = 0;
		let acumTotal = 0;
		let acumHb = 0;
		let acumQb = 0;
		let acumEb = 0;
		if (details.length > 0) {
			let texto_tabla = '';
			texto_tabla += '<table id="datatablesVarieties" class="table table-striped table-no-bordered" cellspacing="0" width="100%" style="width:100%">';
			texto_tabla += '<thead>';
			texto_tabla += '<tr>';
			texto_tabla += '<th>NRO BOX</th>';
			texto_tabla += '<th>BOX TYPE</th>';
			texto_tabla += '<th>VARIETIES</th>';
			texto_tabla += '<th>CM</th>';
			texto_tabla += '<th>STEMS</th>';
			texto_tabla += '<th>BOUQUETS</th>';
			texto_tabla += '<th>TOTAL STM</th>';
			texto_tabla += '<th>PRICE</th>';
			texto_tabla += '<th>TOTAL</th>';
			texto_tabla += '</tr>';
			texto_tabla += '</thead>';
			texto_tabla += '<tbody id="bodyTableDetails">';

			texto_tabla += '</tbody>';
			texto_tabla += '</table>';
			$("#bodyModalDetails").html(texto_tabla);

			details.forEach((item, indice, array) => {

				if (item.typeBoxs.name.toUpperCase().trim() === "HB") {
					acumHb += parseInt(item.boxNumber);
				} else if (item.typeBoxs.name.toUpperCase().trim() === "QB") {
					acumQb += parseInt(item.boxNumber);
				} else {
					acumEb += parseInt(item.boxNumber);
				}

				item.indice = indice;
				let textBox = '<tr>';
				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += item.boxNumber;
				qtyBox += parseInt(item.boxNumber);
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += item.typeBoxs.name;
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '<td bgcolor= "#f1f2f3">';
				textBox += '</td>';

				textBox += '</tr>';
				let acumBoxStems = 0;
				let acumBoxBunches = 0;
				let acumTotalBox = 0;
				let acumBoxTotalStems = 0;
				$('#bodyTableDetails').append(textBox);
				if (item.varieties.length > 0) {
					item.varieties.forEach(element => {
						let textVariety = '<tr>';
						textVariety += '<td>';
						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += element.products.name;
						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += element.measures.name;
						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += element.stems;
						acumBoxStems += parseInt(element.stems) * parseInt(item.boxNumber);
						qtyStems += parseInt(element.stems) * parseInt(item.boxNumber);

						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += element.bunches;
						acumBoxBunches += parseInt(element.bunches) * parseInt(item.boxNumber);
						qtyBouquets += parseInt(element.bunches) * parseInt(item.boxNumber);
						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += parseInt(element.stems) * parseInt(element.bunches);
						acumTotalStm += parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(element.bunches);
						acumBoxTotalStems += parseInt(element.stems) * parseInt(element.bunches) * parseInt(item.boxNumber);
						textVariety += '</td>';

						textVariety += '<td>';
						textVariety += parseFloat(element.price).toFixed(2);
						textVariety += '</td>';

						textVariety += '<td>';
						let totalBoxItem = parseFloat(element.price) * (parseInt(element.stems) * parseInt(element.bunches));
						let totalTable = parseFloat(element.price) * (parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(element.bunches));
						acumTotal += totalTable;
						acumTotalBox += totalTable
						textVariety += totalBoxItem.toFixed(2);
						textVariety += '</td>';

						textVariety += '</tr>';
						$('#bodyTableDetails').append(textVariety);
					});
				}
				let textFooterBox = '<tr>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += acumBoxBunches;
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += acumBoxTotalStems;
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += '</td>';

				textFooterBox += '<td bgcolor= "#b9e0f1">';
				textFooterBox += acumTotalBox.toFixed(2);
				textFooterBox += '</td>';

				textFooterBox += '</tr>';
				$('#bodyTableDetails').append(textFooterBox);

			});
			let textFooter = '<tfoot>';
			textFooter += '<tr>';

			textFooter += '<td>';
			textFooter += qtyBox;
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += qtyBouquets;
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += acumTotalStm;
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += '</td>';

			textFooter += '<td>';
			textFooter += acumTotal.toFixed(2);
			textFooter += '</td>';

			textFooter += '</tr>';
			textFooter += '</tfoot>';
			$('#bodyTableDetails').after(textFooter);
			let fulles = (acumHb * 0.50) + (acumQb * 0.25) + (acumEb * 0.125);
			if (acumEb > 0) {
				fulles = fulles.toFixed(3);
			} else {
				fulles = fulles.toFixed(2);
			}
			let textResumen = '<div class="row">';
			textResumen += '<div class="col-3" style="background:#f9f9c6">';
			textResumen += '<p class="text-left"><b>FULLES= </b> <span id="spanFulles" style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + fulles + '</span></p>';
			textResumen += '<p class="text-left"><b>PIEZAS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + qtyBox + '</span></p>';
			textResumen += '<p class="text-left"><b>TALLOS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + acumTotalStm + '</span></p>';
			textResumen += '<p class="text-left"><b>TOTAL= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">$ ' + acumTotal.toFixed(2) + '</span></p>';
			textResumen += '</div>';
			textResumen += '</div>';
			$('#datatablesVarieties').after(textResumen);
		} else {
			$('#bodyModalDetails').append('<div class="alert alert-info">Se encuentra vacio</div>');
		}

	}

	let acumBalanceSelect = 0;

	const handleSelectedAll = () => {
		acumBalanceSelect = 0;
		if (arrInvoicesFarm.length > 0) {
			$('#btnSelected').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> <?= translate('quit_invoice_all_lang') ?>')
			$('#btnSelected').attr('onclick', 'handleSelectedQuit()');
			$('#btnSelected').removeClass('btn-success').addClass('btn-warning');
			arrInvoicesFarm.forEach(function(item, indice, arr) {
				let acumDebe = 0;
				if (item.details.length > 0) {
					item.details.forEach(box => {
						if (box.varieties.length > 0) {
							box.varieties.forEach(element => {
								acumDebe += parseFloat(element.price) * (parseInt(element.stems) * parseInt(box.boxNumber) * parseInt(element.bunches));
							});
						}
					});
				}
				let amountCredit = 0;
				arrInvoicesFarm[indice].credit !== undefined ? amountCredit = parseFloat(parseFloat(arrInvoicesFarm[indice].credit.amount.toFixed(2))) : amountCredit = 0;
				let amountPayment = 0;
				if (arrInvoicesFarm[indice].payments !== undefined) {
					if (arrInvoicesFarm[indice].payments.length > 0) {
						arrInvoicesFarm[indice].payments.forEach(payment => {
							amountPayment += parseFloat(parseFloat(payment.payment.amount).toFixed(2));
						});
					}
				}
				let saldo = parseFloat(acumDebe.toFixed(2)) - (amountCredit + amountPayment);
				if (saldo > 0) {
					$('#check' + item.invoice_farm).prop('checked', true);
					$('#spanCheck' + arrInvoicesFarm[indice].invoice_farm).text('<?= translate('quit_invoice_lang') ?>');
					$('#check' + arrInvoicesFarm[indice].invoice_farm).attr('onclick', 'handleQuitSelected("' + indice + '")');
					item.selected = true;
				} else {
					item.selected = false;
				}
				acumBalanceSelect += parseFloat(saldo.toFixed(2));
			});
			$('#textResumenSelected').text('$ ' + acumBalanceSelect.toFixed(2));
			acumBalanceSelect > 0 ? $('#bodyBtnRegisterPayment').show() : $('#bodyBtnRegisterPayment').hide();
		} else {
			$('#bodyBtnRegisterPayment').hide();
			swal({
				title: 'Uppsss!',
				text: "No hay facturas para seleccionar",
				type: 'error',
				padding: '2em'
			});
		}
	}

	const handleSelectedInvoice = (indice) => {
		if (arrInvoicesFarm.length > 0) {
			arrInvoicesFarm[indice].selected = true;
			$('#spanCheck' + arrInvoicesFarm[indice].invoice_farm).text('<?= translate('quit_invoice_lang') ?>');
			$('#check' + arrInvoicesFarm[indice].invoice_farm).attr('onclick', 'handleQuitSelected("' + indice + '")');
			$('#btnSelected').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> <?= translate('quit_invoice_all_lang') ?>')
			$('#btnSelected').attr('onclick', 'handleSelectedQuit()');
			$('#btnSelected').removeClass('btn-success').addClass('btn-warning');
			let acumDebe = 0;
			arrInvoicesFarm[indice].details.forEach((box) => {
				if (box.varieties.length > 0) {
					box.varieties.forEach(element => {
						acumDebe += parseFloat(element.price) * (parseInt(element.stems) * parseInt(box.boxNumber) * parseInt(element.bunches));
					});
				}
			})
			let amountCredit = 0;
			arrInvoicesFarm[indice].credit !== undefined ? amountCredit = parseFloat(parseFloat(arrInvoicesFarm[indice].credit.amount.toFixed(2))) : amountCredit = 0;
			let amountPayment = 0;
			if (arrInvoicesFarm[indice].payments !== undefined) {
				if (arrInvoicesFarm[indice].payments.length > 0) {
					arrInvoicesFarm[indice].payments.forEach(payment => {
						amountPayment += parseFloat(parseFloat(payment.payment.amount).toFixed(2));
					});
				}
			}
			let saldo = parseFloat(acumDebe.toFixed(2)) - (amountCredit + amountPayment);
			acumBalanceSelect = parseFloat(acumBalanceSelect.toFixed(2)) + parseFloat(saldo.toFixed(2));
			$('#textResumenSelected').text('$ ' + acumBalanceSelect.toFixed(2));
			acumBalanceSelect > 0 ? $('#bodyBtnRegisterPayment').show() : $('#bodyBtnRegisterPayment').hide();
			$('#bodyBtnRegisterPayment').show();
		} else {
			$('#bodyBtnRegisterPayment').hide();
			swal({
				title: 'Uppsss!',
				text: "No hay facturas para seleccionar",
				type: 'error',
				padding: '2em'
			});
		}
	}

	const handleQuitSelected = (indice) => {
		if (arrInvoicesFarm.length > 0) {
			arrInvoicesFarm[indice].selected = false;
			$('#spanCheck' + arrInvoicesFarm[indice].invoice_farm).text('<?= translate('selected_invoice_lang') ?>');
			$('#check' + arrInvoicesFarm[indice].invoice_farm).attr('onclick', 'handleSelectedInvoice("' + indice + '")');
			$('#btnSelected').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> <?= translate('selected_all_invoice_lang') ?>')
			$('#btnSelected').attr('onclick', 'handleSelectedAll()');
			$('#btnSelected').removeClass('btn-warning').addClass('btn-success');
			let acumDebe = 0;
			arrInvoicesFarm[indice].details.forEach((box) => {
				if (box.varieties.length > 0) {
					box.varieties.forEach(element => {
						acumDebe += parseFloat(element.price) * (parseInt(element.stems) * parseInt(box.boxNumber) * parseInt(element.bunches));
					});
				}
			})
			let amountCredit = 0;
			arrInvoicesFarm[indice].credit !== undefined ? amountCredit = parseFloat(parseFloat(arrInvoicesFarm[indice].credit.amount.toFixed(2))) : amountCredit = 0;
			let amountPayment = 0;
			if (arrInvoicesFarm[indice].payments !== undefined) {
				if (arrInvoicesFarm[indice].payments.length > 0) {
					arrInvoicesFarm[indice].payments.forEach(payment => {
						amountPayment += parseFloat(parseFloat(payment.payment.amount).toFixed(2));
					});
				}
			}
			let saldo = parseFloat(acumDebe.toFixed(2)) - (amountCredit + amountPayment);
			acumBalanceSelect = parseFloat(acumBalanceSelect.toFixed(2)) - parseFloat(saldo.toFixed(2));
			$('#textResumenSelected').text('$ ' + acumBalanceSelect.toFixed(2));
			acumBalanceSelect > 0 ? $('#bodyBtnRegisterPayment').show() : $('#bodyBtnRegisterPayment').hide();
		} else {
			$('#bodyBtnRegisterPayment').hide();
			swal({
				title: 'Uppsss!',
				text: "No hay facturas para quitar la selección",
				type: 'error',
				padding: '2em'
			});
		}
	}

	const handleSelectedQuit = () => {
		if (arrInvoicesFarm.length) {
			$('#btnSelected').html('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> <?= translate('selected_all_invoice_lang') ?>')
			$('#btnSelected').attr('onclick', 'handleSelectedAll()');
			$('#btnSelected').removeClass('btn-warning').addClass('btn-success');
			arrInvoicesFarm.forEach(function(item, indice, arr) {
				$('#check' + item.invoice_farm).prop('checked', false);
				$('#spanCheck' + item.invoice_farm).text('<?= translate('selected_invoice_lang') ?>');
				$('#check' + item.invoice_farm).attr('onclick', 'handleSelectedInvoice("' + indice + '")');
				item.selected = false;
			});
			acumBalanceSelect = 0;
			$('#textResumenSelected').text('$ 0.00');
			$('#bodyBtnRegisterPayment').hide();
		} else {
			$('#bodyBtnRegisterPayment').hide();
			swal({
				title: 'Uppsss!',
				text: "No hay facturas para quitar la selección",
				type: 'error',
				padding: '2em'
			});
		}

	}

	const handleRegisterPayment = () => {
		if (acumBalanceSelect > 0) {
			$('#spanModalBalance').text('Total seleccionado: $ ' + acumBalanceSelect.toFixed(2));
			$('#amount').val(acumBalanceSelect.toFixed(2));
			$('#modalRegisterPayment').modal({
				backdrop: false
			})
		} else {
			swal({
				title: 'Uppsss!',
				text: "No hay facturas seleccionadas para procesar el pago",
				type: 'error',
				padding: '2em'
			});
		}
	}

	const handleChangeSelectType = () => {
		let selectTypeTransaction = $('#selectTypeTransaction').val();
		if (selectTypeTransaction == 3) {
			$('#bodyCostoTransfer').show();
		} else {
			$('#bodyCostoTransfer').hide();
		}
	}

	const handleSubmitPayment = async () => {
		let selectFarms = $('select[id=selectFarms] option').filter(':selected').val();
		selectFarms = JSON.parse(decodeB64Uft8(selectFarms));
		let bank = $('#bank').val().trim();
		let selectTypeTransaction = $('#selectTypeTransaction').val();
		let numberTransaction = $('#numberTransaction').val().trim();
		let amount = $('#amount').val().trim() !== '' ? parseFloat($('#amount').val().trim()) : 0;
		let costeTransfer = $('#costeTransfer').val() == '' ? 0 : parseFloat($('#costeTransfer').val().trim());
		if (bank == '') {
			const toast = swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				padding: '2em'
			});

			toast({
				type: 'info',
				title: 'El nombre del banco es obligatorio',
				padding: '2em',
			})
		} else if (numberTransaction == '') {
			const toast = swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				padding: '2em'
			});

			toast({
				type: 'info',
				title: 'El número de la transacción es obligatorio',
				padding: '2em',
			})
		} else if (amount <= 0) {
			const toast = swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				padding: '2em'
			});

			toast({
				type: 'info',
				title: 'El monto de la transacción es obligatorio',
				padding: '2em',
			})
		} else if (costeTransfer < 0 && selectTypeTransaction == 3) {
			const toast = swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				padding: '2em'
			});

			toast({
				type: 'info',
				title: 'El costo de la transferencia no puede ser menor a 0',
				padding: '2em',
			})
		} else if (acumBalanceSelect < amount) {
			const toast = swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				padding: '2em'
			});

			toast({
				type: 'info',
				title: 'El monto no puede ser mayor al monto de las facturas seleccionadas',
				padding: '2em',
			})
		} else {
			$('#modalRegisterPayment').modal('hide');
			Swal.fire({
				title: 'Completando operación',
				text: 'Creando pago de facturas de fincas...',
				imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
				imageAlt: 'No realice acciones sobre la página',
				showConfirmButton: false,
				allowOutsideClick: false,
				footer: '<a href>No realice acciones sobre la página</a>',
			});
			arrInvoicesFarm = await sortArrTemp(arrInvoicesFarm);
			let arrayRequest = JSON.stringify(arrInvoicesFarm);
			let farm = JSON.stringify(selectFarms);
			let balance = amount;
			let data = {
				acumBalanceSelect,
				arrayRequest,
				amount,
				selectTypeTransaction,
				costeTransfer,
				numberTransaction,
				bank,
				farm,
				balance
			}
			setTimeout(function() {
				$.ajax({
					type: 'POST',
					url: "<?= site_url('farm/add_payment_invoice_farm') ?>",
					data: data,
					success: function(result) {
						result = JSON.parse(result);
						if (result.status == 200) {
							const toast = swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 2000,
								padding: '2em'
							});
							toast({
								type: 'success',
								title: '¡Correcto!',
								padding: '2em',
							})
							setTimeout(function() {
								window.location = '<?= site_url('farm/index_payments') ?>';
							}, 1000);
						} else {
							Swal.close();
							swal({
								title: '¡Error!',
								text: result.msj,
								padding: '2em'
							});
							$('#modalRegisterPayment').modal({
								backdrop: false
							})
						}
					}
				});
			}, 1500)
		}
	}

	const sortArrTemp = async (arr = []) => {
		arr.sort((a, b) => {
			if (a.timestamp > b.timestamp) {
				return 1;
			}
			if (a.timestamp < b.timestamp) {
				return -1;
			}
			return 0;
		});
		return arr;
	}
</script>