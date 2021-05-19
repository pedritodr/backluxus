<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<link rel="stylesheet preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
<style>
	#modalDetails {
		background-color: rgba(0, 0, 0, 0.5) !important;
	}
</style>
<div class="main-container" id="container">
	<div class="layout-px-spacing" style="width:100%">
		<p class="titulo">
			<small class="titulo-2"><?= translate('balance_lang'); ?></small>
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
								<label><?= translate('since_lang') ?></label>
								<input type="text" class="form-control" id="since" />
							</div>
						</div>

						<div class="col-3">
							<div class="form-group">
								<label><?= translate('until_lang') ?></label>
								<input type="date" class="form-control" id="until" />
							</div>
						</div>
						<div class="col-3">
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
							<h3 class="text-left"><b><?= translate('latest_payment_lang') ?>: </b><span id="textLatestPaymnet" style="color:#e7515a"></span> <b><?= translate('fecha_lang') ?>: </b><span id="textLatestPaymnetDate" style="color:#e7515a"></span></h3>
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
<script>
	$(() => {
		let since = flatpickr(document.getElementById('since'));

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
	let urlResultados = null;
	const exportarResultados = () => {
		location.href = urlResultados;
	}

	const encodeB64Uft8 = (str) => {
		return btoa(unescape(encodeURIComponent(str)));
	}
	const decodeB64Uft8 = (str) => {
		return decodeURIComponent(escape(atob(str)));
	}


	const loadInvoices = (since, until, farmId) => {
		let url = '<?= site_url("farm/loadInvoiceRangeDate") ?>';
		$.post(url, {
			since,
			until,
			farmId
		}, function(response) {
			response = JSON.parse(response);
			console.log(response);
			$("#btnSearch").show();
			$("#zoneLoading").hide();
			let balance = 0;
			if (response.status == 200) {
				if (response.data.length > 0) {
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
					response.data.forEach(function(item) {
						stringTable += '<tr>';

						stringTable += '<td>';
						stringTable += item.date_create;
						stringTable += '</td>';

						stringTable += '<td>';
						if (item.viewed !== undefined) {
							stringTable += '<svg id="check' + item.invoice_farm + '" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#8dbf41" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
						} else {
							stringTable += '<svg style="display:none" id="check' + item.invoice_farm + '" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#8dbf41" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
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
						if (item.credits !== undefined) {
							if (item.credits) {
								if (item.credits.length > 0) {
									item.credits.forEach(credit => {
										amountCredit += parseFloat(parseFloat(parseFloat(credit.itemSelected.price) * parseInt(credit.qtyStems)).toFixed(2));
									});
								}
							}
						}
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
						stringTable += '</td>';

						stringTable += '<td>';
						let saldo = acumDebe - (amountCredit + amountPayment);
						balance += saldo;
						stringTable += balance.toFixed(2);
						stringTable += '</td>';

						stringTable += '<td>';
						stringTable += '<button type="button" class="btn btn-outline-primary" onclick=watchDetails("' + encodeB64Uft8(JSON.stringify(item.details)) + '")>Ver detalle</button>';
						if (item.viewed === undefined) {
							stringTable += '<button type="button" class="btn btn-outline-success" id="btnCheck' + item.invoice_farm + '" onclick=handleViewed("' + item.invoice_farm + '")>Marcar</button>';
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
					if (response.latestPayment) {
						$('#textLatestPaymnet').text('$ ' + parseFloat(response.latestPayment.balance).toFixed(2));
						$('#textLatestPaymnetDate').text(response.latestPayment.date_create);
					} else {
						$('#textLatestPaymnet').text('$ 0.00');
						$('#textLatestPaymnetDate').text('----/--/--');
					}
					let balanceActual = 0;
					if (response.balance.length > 0) {
						response.balance.forEach(function(item) {
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
							item.credit !== undefined ? amountCredit = item.credit.amount : amountCredit = 0;

							let amountPayment = 0;
							if (item.payments !== undefined) {
								if (item.payments.length > 0) {
									item.payments.forEach(payment => {
										amountPayment += parseFloat(parseFloat(payment.payment.amount).toFixed(2));
									});
								}
							}

							let saldo = acumDebe - (amountCredit + amountPayment);
							balanceActual += saldo;

						});
					}
					$('#textResumenActual').text('$ ' + balanceActual.toFixed(2))
					$('#bodyResumen').show();
					$("#zoneBtn").append(
						'<button id="btnClear" style="margin-top:35px" onclick="limpiarBusqueda();" class="btn btn-danger">Limpiar</button>'
					);
				} else {
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
		$("#btnClear").remove();
		$("#since").val('');
		$("#until").val('');
		$('#bodyResumen').hide();
		$("#zoneContents").empty();
		$('#zoneContents').html('<div class="alert alert-info">Usted debe seleccionar un rango de fechas</div>');
	}

	const searchInvoices = () => {

		$("#btnClear").remove();
		let since = $("#since").val();
		let until = $("#until").val();
		let selectFarms = $('select[id=selectFarms] option').filter(':selected').attr('itemId');

		if (since.trim().length > 0) {
			if (until.trim().length > 0) {

				let dateSinceSeparated = since.trim().split('-');

				let yearInicio = dateSinceSeparated[0];
				let mesInicio = dateSinceSeparated[1];
				let diaInicio = dateSinceSeparated[2];

				let dateUntilSeparated = until.trim().split('-');

				let yearFin = dateUntilSeparated[0];
				let mesFin = dateUntilSeparated[1];
				let diaFin = dateUntilSeparated[2];

				let fInicio = new Date(parseInt(yearInicio), parseInt(mesInicio), parseInt(diaInicio));
				let fFin = new Date(parseInt(yearFin), parseInt(mesFin), parseInt(diaFin));
				if (fFin >= fInicio) {

					if (selectFarms !== undefined) {
						$("#btnSearch").hide();
						$("#zoneLoading").show();
						loadInvoices(since, until, selectFarms);
					} else {
						swal({
							title: 'Uppsss!',
							text: "Seleccione la finca para realizar la busqueda",
							type: 'error',
							padding: '2em'
						});
					}
				} else {
					swal({
						title: 'Uppsss!',
						text: "La fecha de fin no puede ser menor a la fecha de inicio",
						type: 'error',
						padding: '2em'
					});
				}



			} else {
				swal({
					title: 'Uppsss!',
					text: "La fecha de fin no puede estar en blanco",
					type: 'error',
					padding: '2em'
				});
			}
		} else {
			swal({
				title: 'Uppsss!',
				text: "La fecha de inicio no puede estar en blanco",
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

	const handleViewed = (id) => {
		let url = '<?= site_url("invoice_farm/viewed_check") ?>';
		$.post(url, {
			id
		}, function(response) {
			response = JSON.parse(response);
			if (response.status == 200) {
				$('#check' + id).show();
				$('#btnCheck' + id).hide();
				swal({
					title: 'Correcto!',
					text: "Factura marcada como vista",
					type: 'success',
					padding: '2em'
				});
			} else {
				swal({
					title: 'Uppsss!',
					text: response.msj,
					type: 'error',
					padding: '2em'
				});
			}
		})
	}
</script>