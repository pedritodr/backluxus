<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Dimention Flowers</title>

	<style type="text/css">
		body {
			background-color: #fff;
			margin: 40px;
			font-family: Lucida Grande, Verdana, Sans-serif;
			font-size: 14px;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 16px;
			font-weight: bold;
			margin: 24px 0 2px 0;
			padding: 5px 0 6px 0;
		}

		code {
			font-family: Monaco, Verdana, Sans-serif;
			font-size: 12px;

			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}
	</style>
</head>

<body>


	<div style="margin-left: 100px; margin-right: 100px;">
		<div style="width: 355px; height:auto; float: left;">
			<img id="logo_cliente" style="width: 355px; height:100px;" class="img img-rounded img-responsive" src="<?= base_url('assets/login.png'); ?>" />
			<h3>Orden de Compra</h3>

			<div style=" background-color: #f4f4f4; width: 355px; height:auto;">
				<strong>
					<p style="font-size: 10px;" id="cliente_name"><?= $all_request[0]->cliente_name; ?></p>
				</strong>
				<strong style="font-size: 10px;">Fecha de vuelo:</strong>

				<p style="font-size: 10px;" id="fecha_pedido"><?= $all_request[0]->date_time_reception; ?></p>
			</div>
		</div>
		<div style=" background-color: #f4f4f4; width: 355px; height:auto; float: right;">
			<p style="font-size: 10px;" id="nro_orden"><strong>Nro de orden:</strong>
				<?= $all_request[0]->purchase_order; ?></p>
			<p style="font-size: 10px;" id="fecha_pedido"><strong>Fecha de la orden:</strong>
				<?= $all_request[0]->date_purchase; ?></p>
			<div style="padding:10px; background-color: #ffffff; width: 355px; height:auto;">

			</div>
			<div style="background-color: #f4f4f4; width: 355px; height:auto;">
				<strong style="font-size: 10px;">Direccion:</strong>
				<p style="font-size: 10px;" id="direccion">
					<?= $all_request[0]->address; ?>
				</p>
			</div>

		</div>
		<div style=" background-color: #f4f4f4; width:100%; height:auto;position: absolute; bottom: 300px; margin-top:25px;">
			<table id="tabla" class="table">
				<thead>
					<tr>
						<th style="width:350px; font-size: 18px;">Variedad</th>
						<th style="width:150px; font-size: 18px;">Unidad</th>
						<th style="width:180px; font-size: 18px;" class="text-center">Tipo de caja</th>
						<th class="text-center" style="width:150px; font-size: 18px;">Destino</th>
						<th style="width:150px; font-size: 18px;">Marcación</th>
						<th style="width:150px; font-size: 18px;">Cantidad</th>
						<th style="width:160px; font-size: 18px;">Precio por unidad</th>
						<th style="width:180px; font-size: 18px;">Total precio</th>

					</tr>
				</thead>
				<tbody id="cuerpo">
					<?= $total = 0 ?>
					<?php foreach ($all_request as $item) { ?>
						<tr>
							<td style="font-size: 18px; text-align: center"><?= $item->name; ?> <?= $item->measure; ?></td>
							<td style="font-size: 18px; text-align: center">PACK <?= $item->total_steams; ?></td>
							<td style="font-size: 18px; text-align: center"><?= $item->box->name; ?> </td>
							<td style="font-size: 18px; text-align: center"><?= $item->destination; ?></td>
							<td style="font-size: 18px; text-align: center"><?= $item->dialing; ?></td>
							<td style="font-size: 18px; text-align: center"><?= $item->box->qty; ?></td>
							<td style="font-size: 18px; text-align: center"><?= $item->unit_price; ?></td>
							<td style="font-size: 18px; text-align: center"><?= $item->total_price; ?></td>
						</tr>


						<?= $total = $total + $item->total_price; ?>


					<?php } ?>

				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>


						<td style="width:150px; font-size: 18px; text-align: center;">
							<strong>
								<h4>Total</h4>
							</strong>

							<h3 style="text-align: center" id="totales"><?= $total; ?></h3>
						</td>
						<td>

						</td>
					</tr>
					<tr>


					</tr>
				</tfoot>
			</table>
		</div>





	</div>















</body>

</html>