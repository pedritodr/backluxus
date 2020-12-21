<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Dimention Flowers</title>

</head>
<style>
	.clearfix:after {
		content: "";
		display: table;
		clear: both;

	}

	a {
		color: #0087C3;
		text-decoration: none;
	}

	body {
		position: relative;
		width: 75%;
		height: 100%;
		margin: 0 auto;
		color: #555555;
		background: #FFFFFF;
		font-family: Arial, sans-serif;
		font-size: 14px;
		font-family: SourceSansPro;
	}

	header {
		padding: 5px 0;
		margin-bottom: 1px;
		border-bottom: 1px solid #006c7d;
	}

	#logo {
		float: left;
		margin-top: 8px;
	}

	#logo img {
		height: 70px;

	}

	#company {
		float: right;
		text-align: right;
	}


	#details {
		margin-bottom: 50px;
	}

	#client {
		padding-left: 6px;
		border-left: 6px solid #006c7d;
		float: left;
	}

	#client .to {
		color: #777777;
	}

	h2.name {
		font-size: 0.8em;
		font-weight: normal;
		margin: 0;
	}

	#invoice {
		float: right;
		text-align: right;

	}

	#invoice h1 {
		color: #006c7d;
		font-size: 1em;
		line-height: 1em;
		font-weight: normal;
		margin: 0 0 10px 0;
	}

	#invoice .date {
		font-size: 0.7em;
		color: #777777;
	}

	table {
		width: 100%;
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 20px;
	}

	table th,
	table td {
		padding: 20px;
		background: #EEEEEE;
		text-align: center;
		border-bottom: 1px solid #FFFFFF;
	}

	table th {
		white-space: nowrap;
		font-weight: normal;
	}

	table td {
		text-align: center;
	}

	table td h3 {
		color: #006c7d;
		font-size: 1em;
		font-weight: normal;
		margin: 0 0 0.2em 0;
	}

	table .no {
		color: #FFFFFF;
		font-size: 0.7em;
		background: #006c7d;
	}

	table .sub {
		color: #006c7d;
		font-size: 0.7em;
		background: #EEEEEE;
	}

	table .desc {
		text-align: left;
		font-size: 0.7em;

	}

	table .unit {
		font-size: 0.7em;
		background: #EEEEEE;
	}

	table .qty {
		font-size: 0.7em;
		background: #DDDDDD;

	}

	table .total {
		font-size: 0.7em;
		background: #006c7d;
		color: #FFFFFF;
	}

	table td.unit,
	table td.qty,
	table td.desc,
	table td.total {
		font-size: 0.7em;
	}

	table tbody tr:last-child td {
		border: none;
	}

	table tfoot td {
		padding: 10px 20px;
		background: #FFFFFF;
		border-bottom: none;
		font-size: 1em;
		white-space: nowrap;

	}

	table tfoot tr:first-child td {
		border-top: none;
	}

	table tfoot tr:last-child td {
		color: #006c7d;
		font-size: 1em;
		border-top: 1px solid #006c7d;

	}

	table tfoot tr td:first-child {
		border: none;
	}

	#thanks {
		font-size: 2em;
		margin-bottom: 50px;
	}

	#notices {
		padding-left: 6px;
		border-left: 6px solid #006c7d;
	}

	#notices .notice {
		font-size: 1em;
	}

	footer {
		color: #777777;
		width: 100%;
		height: 30px;
		position: absolute;
		bottom: 0;
		border-top: 1px solid #AAAAAA;
		padding: 8px 0;
		text-align: center;
	}
</style>

<body>
	<header class="clearfix">
		<div id="logo" style="width:50%">
			<img src="<?= base_url('assets/login.png'); ?>">


		</div>
		<div id="company">
			<h2 class="name">Dimention flowers</h2>

			<h2 class="name">Address: Beck Rollo OE7 132 y Alonso de Torres</h2>
			<h2 class="name">QUITO - ECUADOR</h2>


			<h2 class="name">Phone: (593-2) 2 263 742 </h2>
			<h2 class="name">US Phone: 786 4018355</h2>
			<h2 class="name">Mobile: (593) 9853 43 67</h2>

		</div>
		</div>
	</header>
	<main>
		<div id="details" class="clearfix">
			<div id="client" style="width:55%">
				<div class="to">INVOICE TO:</div>
				<div class="name">AWB: 406-06387640</div>
				<h2 class="name"><strong>Client:</strong> John Doe | <strong>Address:</strong>796 Silver Harbour, TX 79273, US
				</h2>
				<h2 class="name"><strong>Country:</strong> Estados Unidos | <strong>Mark:</strong> 1PBLX | <strong> PO:</strong> 790138</h2>
			</div>
			<div id="invoice">
				<h1>INVOICE N°: UB25276</h1>
				<div class="date">Date: 01/06/2014</div>
			</div>
		</div>
		<table border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th style="width:130px;" class="no">Farm</th>
					<th style="width:10px;" class="unit">
						<p>N°</p>
						<p>Boxes</p>
					</th>
					<th style="width:10px;" class="qty">
						<p>Type</p>
						<p>Boxes</p>
					</th>
					<th style="width:130px;" class="desc">Description</th>
					<th style="width:10px;" class="unit">Lenght</th>
					<th style="width:10px;" class="qty">Bunches</th>
					<th style="width:10px;" class="unit">
						<p>Stems</p>Bunch<p></p>
					</th>
					<th style="width:10px;" class="qty">
						<p>Total</p>
						<p>Steams</p>
					</th>
					<th style="width:10px;" class="unit">Price</th>
					<th style="width:10px;" class="total">
						<p>Total</p>
						<p>price</p>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="no">ROSERO TAQUIRE MIGUEL ANGEL</td>
					<td class="unit">1</td>
					<td class="qty">HB</td>
					<td class="desc">
						<h3>Website Design Creating</h3>
					</td>
					<td class="unit">50 cm</td>
					<td class="qty">6</td>
					<td class="unit">25</td>
					<td class="qty">150</td>
					<td class="unit">0.24</td>
					<td class="total">36</td>
				</tr>
				<tr>
					<td class="no">ROSERO TAQUIRE MIGUEL ANGEL</td>
					<td class="unit">1</td>
					<td class="qty">HB</td>
					<td class="desc">
						<h3>Website Design Creating</h3>
					</td>
					<td class="unit">50 cm</td>
					<td class="qty">6</td>
					<td class="unit">25</td>
					<td class="qty">150</td>
					<td class="unit">0.24</td>
					<td class="total">36</td>
				</tr>
				<tr>
					<td class="no">ROSERO TAQUIRE MIGUEL ANGEL</td>
					<td class="unit">1</td>
					<td class="qty">HB</td>
					<td class="desc">
						<h3>Website Design Creating</h3>
					</td>
					<td class="unit">50 cm</td>
					<td class="qty">6</td>
					<td class="unit">25</td>
					<td class="qty">150</td>
					<td class="unit">0.24</td>
					<td class="total">36</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td class="sub" colspan="3"></td>
					<td class="sub" colspan="2" class="sub">Totales</td>
					<td class="sub">45</td>
					<td class="sub"></td>
					<td class="sub">45</td>
					<td class="sub"></td>
					<td class="sub"></td>

				</tr>
				<tr>
					<td colspan="7"></td>
					<td class="sub" colspan="2">TOTAL FLOR</td>
					<td class="sub">$5,200.00</td>
				</tr>
				<tr>
					<td colspan="7"></td>
					<td class="sub" colspan="2">TRASPORTE</td>
					<td class="sub">$1,300.00</td>
				</tr>
				<tr>
					<td colspan="7"></td>
					<td class="sub" colspan="2">TOTAL INVOICE</td>
					<td class="sub">$6,500.00</td>
				</tr>
			</tfoot>
		</table>
		<div id="notices">
			<div class="notice">Thank you!</div>
		</div>
	</main>
	<footer>
		Skype: xasaprdu•dimention.flowers2 |
		<a href="mailto:company@example.com">Email: sales@dimentionflowers.com </a> |
		<a href="www.dimentionflowers.com">Web: www.dimentionflowers.com</a>
		<p>
			Invoice was created on a computer and is valid
			without the signature and seal.
		</p>
	</footer>
</body>

</html>