<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<link rel="stylesheet preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
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
											<option value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name_legal . ' | ' . $item->name_commercial ?></option>
										<?php   } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-3" id="area_btn">
							<a onclick="buscarTransaccion()" id="btn_buscar" class="btn btn-primary" style="margin-top: 35px;"><?= translate('search_now_lang') ?></a>
							<div style="display:none;margin-top:35px" id="area_cargando"><a><img src="<?= base_url('assets/cargando.gif'); ?>" style="width:48px;height:48px" /></a></div>
						</div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<div class="statbox widget box box-shadow" style="margin-top: 25px;">
				<div class="widget-header">
					<h3 class="text-simple"><?= translate('list_invoice_farm_lang') ?></h3>
				</div><!-- /.box-header -->
				<div class="widget-content widget-content-area">
					<div class="table-responsive" id="area_contenido">
						<div class="alert alert-info"><?= translate('msg_range_date_lang') ?></div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
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


	const cargarTransacciones = function(pFechaDesde, pFechaHasta) {
		urlResultados = '<?= site_url('pedido/exportarResultadosTransacciones'); ?>' + '/' + pFechaDesde + '/' +
			pFechaHasta;
		btnClick = 1;
		let url = '<?= site_url("transacciones/load_by_fechas") ?>';
		$.post(url, {
			desde: pFechaDesde,
			hasta: pFechaHasta
		}, function(response) {
			response = JSON.parse(decodeUft8(response));
			$("#btn_buscar").show();
			$("#btn_buscar_2").show();
			$("#area_cargando").hide();
			if (response.status == 200) {
				if (response.data.length > 0) {
					let texto_tabla = '';
					texto_tabla +=
						'<table id="datatables-generales" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
					texto_tabla += '<thead>';
					texto_tabla += '<tr>';
					texto_tabla += '<th>Fecha</th>';
					texto_tabla += '<th>Cliente</th>';
					texto_tabla += '<th>Transacción</th>';
					texto_tabla += '<th>Detalle del pago</th>';
					texto_tabla += '<th>Acciones</th>';
					texto_tabla += '</tr>';
					texto_tabla += '</thead>';

					texto_tabla += '<tbody>';
					response.data.forEach(function(item) {
						texto_tabla += '<tr>';
						texto_tabla += '<td>';
						texto_tabla += item.fecha_hora;
						texto_tabla += '</td>';

						texto_tabla += '<td>';
						texto_tabla += item.cliente_object.nombre + ' ' + item.cliente_object.apellido;
						texto_tabla += '<br />';
						texto_tabla += item.cliente_object.email;
						texto_tabla += '</td>';

						texto_tabla += '<td>';
						let validaPagoMixto = false;
						if (typeof item.pago_mixto !== 'undefined') {
							if (item.pago_mixto) {
								validaPagoMixto = true;
								texto_tabla += '<span class="badge badge-info"> Pago mixto </span><br>';
								if (item.estado_pago == 1) {
									texto_tabla += '<b>Estado de la transacción: </b>' +
										'<span class="badge badge-success"> Pagada </span><br>';
								}
								if (item.estado_pago == 2) {
									texto_tabla += '<b>Estado de la transacción: </b>' +
										'<span class="badge badge-danger"> Pendiente </span><br>';
								}
								if (item.estado_pago == 4) {
									texto_tabla += '<span class="badge badge-danger"> Venta a proveedor </span><br>';
								}
								if (item.datos_paymentez) {
									texto_tabla += '<span class="badge badge-success"> Paymentez </span>';
									texto_tabla += '<br />';
									texto_tabla += 'ID Trx: <b>' + item.id_paymentez_response + '</b>';
									texto_tabla += '<br />';
									texto_tabla += 'Código autorización: <b>' + item.authorization_code + '</b>';
									texto_tabla += '<br />';

									if (item.pago_mixto.valorPaymentez > 0) {
										texto_tabla += '<b>Monto: </b>' + '<span class="badge badge-danger"> $ ' + parseFloat(item
											.pago_mixto.valorPaymentez).toFixed(2) + '</span><br>';
									}
								}
								if (item.pago_mixto.valorPaypal > 0) {
									texto_tabla += '<span class="badge badge-success"> Paypal</span>';
									texto_tabla += '<b>Monto: </b>' + '<span class="badge badge-danger"> $ ' + parseFloat(item
										.pago_mixto.valorPaypal).toFixed(2) + '</span><br>';
								}
								if (item.pago_mixto.valorBilletera > 0) {
									texto_tabla += '<span class="badge badge-success"> Billetera Mimall </span>';
									texto_tabla += '<b>Monto: </b>' + '<span class="badge badge-danger"> $ ' + parseFloat(item
										.pago_mixto.valorBilletera).toFixed(2) + '</span><br>';
								}
								if (item.pago_mixto.valorTarjetaRegalo > 0) {
									texto_tabla += '<span class="badge badge-success"> Tarjeta de regalo </span>';
									texto_tabla += '<b>Monto: </b>' + '<span class="badge badge-danger"> $ ' + parseFloat(item
										.pago_mixto.valorTarjetaRegalo).toFixed(2) + '</span><br>';
								}
							} else {
								if (item.estado_pago == 1) {
									texto_tabla += '<b>Estado de la transacción: </b>' +
										'<span class="badge badge-success"> Pagada </span><br>';
								}
								if (item.estado_pago == 2) {
									texto_tabla += '<b>Estado de la transacción: </b>' +
										'<span class="badge badge-danger"> Pendiente </span><br>';
								}
								if (item.estado_pago == 4) {
									texto_tabla += '<span class="badge badge-danger"> Venta a proveedor </span><br>';
								}
								if (item.datos_paymentez) {
									texto_tabla += '<span class="badge badge-success"> Paymentez </span>';
									texto_tabla += '<br />';
									texto_tabla += 'ID Trx: <b>' + item.id_paymentez_response + '</b>';
									texto_tabla += '<br />';
									texto_tabla += 'Código autorización: <b>' + item.authorization_code + '</b>';
									texto_tabla += '<br />';
								}
								if (item.tarjeta_regalo) {
									texto_tabla += '<span class="badge badge-success"> Tarjeta de regalo </span>';
								}
								if (item.billetera) {
									texto_tabla += '<span class="badge badge-success"> Billetera Mimall </span>';
								}
								if (item.paypal) {
									texto_tabla += '<span class="badge badge-success"> Pagada con paypal</span>';
								}
								if (item.pago_contra_entrega) {
									texto_tabla += '<span class="badge badge-success"> Pago contra entrega</span>';
								}
								if (typeof item.pago_credito_empresa !== 'undefined') {
									if (item.pago_credito_empresa) {
										texto_tabla += '<span class="badge badge-success"> Pago crédito empresarial</span>';
									}
								}
							}

						} else {
							if (item.estado_pago == 1) {
								texto_tabla += '<b>Estado de la transacción: </b>' +
									'<span class="badge badge-success"> Pagada </span><br>';
							}
							if (item.estado_pago == 2) {
								texto_tabla += '<b>Estado de la transacción: </b>' +
									'<span class="badge badge-danger"> Pendiente </span><br>';
							}
							if (item.estado_pago == 4) {
								texto_tabla += '<span class="badge badge-danger"> Venta a proveedor </span><br>';
							}
							if (item.datos_paymentez) {
								texto_tabla += '<span class="badge badge-success"> Paymentez </span>';
								texto_tabla += '<br />';
								texto_tabla += 'ID Trx: <b>' + item.id_paymentez_response + '</b>';
								texto_tabla += '<br />';
								texto_tabla += 'Código autorización: <b>' + item.authorization_code + '</b>';
								texto_tabla += '<br />';
							}
							if (item.tarjeta_regalo) {
								texto_tabla += '<span class="badge badge-success"> Tarjeta de regalo </span>';
							}
							if (item.billetera) {
								texto_tabla += '<span class="badge badge-success"> Billetera Mimall </span>';
							}
							if (item.paypal) {
								texto_tabla += '<span class="badge badge-success"> Pagada con paypal</span>';
							}
							if (item.pago_contra_entrega) {
								texto_tabla += '<span class="badge badge-success"> Pago contra entrega</span>';
							}
							if (typeof item.pago_credito_empresa !== 'undefined') {
								if (item.pago_credito_empresa) {
									texto_tabla += '<span class="badge badge-success"> Pago crédito empresarial</span>';
								}
							}
						}
						texto_tabla += '</td>';

						texto_tabla += '<td>';
						texto_tabla += 'Subtotal con impuesto: <b> $ ' + parseFloat(item.subtotal_12).toFixed(2)
							.toString() + '</b>';
						texto_tabla += '<br />';
						texto_tabla += 'Subtotal sin impuesto: <b> $ ' + parseFloat(item.subtotal_0).toFixed(2)
							.toString() + '</b>';
						texto_tabla += '<br />';
						texto_tabla += 'Impuesto: <b> $ ' + parseFloat(item.iva_12).toFixed(2).toString() + '</b>';
						texto_tabla += '<br />';
						texto_tabla += 'Total: <b> $ ' + parseFloat(item.total).toFixed(2).toString() + '</b>';

						if (item.pago_contra_entrega) {

							if (item.rutas.length > 0) {
								texto_tabla += '<br />';
								texto_tabla += '<b> Rutas:</b>';
								texto_tabla += '<br />';
								item.rutas.forEach(ruta => {
									texto_tabla += '<a href="#" onclick=mostrarRuta("' + encodeB64Uft8(JSON.stringify(ruta)) + '") class="btn btn-danger"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> ' + ruta.pedido_delivery_interno_id + '</a>'
								});
							}
						} else {
							if (item.rutas.length > 0) {
								texto_tabla += '<br />';
								texto_tabla += '<b> Rutas:</b>';
								texto_tabla += '<br />';
								item.rutas.forEach(ruta => {
									texto_tabla += '<a href="#" onclick=mostrarRutaAll("' + encodeB64Uft8(JSON.stringify(ruta)) + '") class="btn btn-danger"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> ' + ruta.pedido_delivery_interno_id + '</a>'
								});
							}
						}

						texto_tabla += '</td>';

						texto_tabla += '<td>';

						texto_tabla += '<div class="btn-group mb-4 mr-2" role="group">';
						texto_tabla +=
							'<button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">';
						texto_tabla += '<polyline points="6 9 12 15 18 9"></polyline>';
						texto_tabla += '</svg>';
						texto_tabla += '</button>';
						texto_tabla +=
							'<div class="dropdown-menu" aria-labelledby="btnOutline" style="will-change: transform;z-index:100000">';
						texto_tabla += '<a class="dropdown-item" onclick=loadDetalleProducto("' + item.pedido_mall_id +
							'") href="#"> Detalle</a>';

						let fecha_trx = item.fecha_hora.split(" ")[0];
						let fecha_hora_fin_boton = fecha_trx + ' 16:00:00';

						let fecha_hora_actual = '<?= date("Y-m-d H:i:s"); ?>';
						var date = new Date(item.fecha_create);
						let fechaPedido = sumarDias(date, 7).toISOString().substr(0, 10);
						let fechaActual = '<?= date("Y-m-d"); ?>';
						if ((item.estado_pago == 1) && (fecha_hora_actual < fecha_hora_fin_boton) && (item
								.datos_paymentez)) {
							texto_tabla += '<a class="dropdown-item" href="javascript:void(0);"  onclick=sendRefund("' +
								item.id_paymentez_response + '");> Reembolsar </a>';
						}
						if ((item.estado_pago == 2) && (item.datos_paymentez)) {
							texto_tabla +=
								'<a class="dropdown-item" href="javascript:void(0);"  onclick=checkTransaction("' + item
								.id_paymentez_response + '");> Activar </a>';
						}
						if (item.estado_pago != 1 && item.pago_contra_entrega) {
							texto_tabla += '<a class="dropdown-item" href="javascript:void(0);"  onclick=cancelarPedido("' +
								item.pedido_mall_id + '");> Cancelar pedido </a>';
						}
						if (!item.pago_contra_entrega && (fechaActual <= fechaPedido) && !validaPagoMixto) {
							texto_tabla += '<a class="dropdown-item" href="javascript:void(0);"  onclick=cancelarPedido("' +
								item.pedido_mall_id + '");> Cancelar pedido </a>';
						}
						texto_tabla +=
							'<a class="dropdown-item" href="javascript:void(0);"  onclick=generarNotaCredito("' + item
							.pedido_mall_id + '");> Generar Nota de crédito</a>';
						texto_tabla += '</div>';
						texto_tabla += '</div>';

						texto_tabla += '</td>';

						texto_tabla += '</tr>';
					});
					texto_tabla += '</tbody>';
					texto_tabla += '</table>'
					$("#area_contenido").empty();
					$("#area_contenido").html(texto_tabla);
					$('#btn_exportar').show();
					$("#datatables-generales").DataTable({
						"language": {
							"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
						}
					});

					$("#area_btn").append(
						'<button id="btn_limpiar" style="margin-top:35px" onclick="limpiarBusqueda();" class="btn btn-danger">Limpiar</button>'
					)

				} else {
					$('#btn_exportar').hide();
					$("#area_contenido").empty();
					$('#area_contenido').html(
						'<div class="alert alert-info">Usted debe seleccionar un rango de fechas</div>');
					swal({
						title: 'Uppsss!',
						text: "No se encuentran transacciones en este rango de fechas",
						type: 'error',
						padding: '2em'
					});
				}
			}
		});
	}

	const limpiarBusqueda = function() {
		$("#btn_limpiar").remove();
		$('#btn_exportar').hide();
		$("#fecha_desde").val('');
		$("#fecha_hasta").val('');

		$("#area_contenido").empty();
		$('#area_contenido').html('<div class="alert alert-info">Usted debe seleccionar un rango de fechas</div>');
	}

	const buscarTransaccion = function() {

		$("#btn_limpiar").remove();
		let fecha_desde = $("#fecha_desde").val();
		let fecha_hasta = $("#fecha_hasta").val();
		$('#btn_exportar').hide();
		if (fecha_desde.trim().length > 0) {
			if (fecha_hasta.trim().length > 0) {

				let fecha_inicio_separada = fecha_desde.trim().split('-');

				let yearInicio = fecha_inicio_separada[0];
				let mesInicio = fecha_inicio_separada[1];
				let diaInicio = fecha_inicio_separada[2];

				let fechaFinSeparada = fecha_hasta.trim().split('-');

				let yearFin = fechaFinSeparada[0];
				let mesFin = fechaFinSeparada[1];
				let diaFin = fechaFinSeparada[2];

				let fInicio = new Date(parseInt(yearInicio), parseInt(mesInicio), parseInt(diaInicio));
				let fFin = new Date(parseInt(yearFin), parseInt(mesFin), parseInt(diaFin));
				if (fFin >= fInicio) {
					$("#btn_buscar").hide();
					$("#btn_buscar_2").hide();
					$("#area_cargando").show();

					cargarTransacciones(fecha_desde, fecha_hasta);

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
	let btnClick = null;
</script>