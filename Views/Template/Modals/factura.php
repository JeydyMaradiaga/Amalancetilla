<?php 
//dep($descuento);
//die();
	$cliente = $data['cliente'];
	$orden = $data['orden'];
	$detalle = $data['detalle'];
	
	$ISV11 = 0;
	$descuento =  $data['orden']['0']['Total'];
	$descuento2 =0;
 ?>
<!DOCTYPE html>
<html lang="es">
<head> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<style>
		table{
			width: 100%;
		}
		table td, table th{
			font-size: 12px;
		}
		h4{
			margin-bottom: 0px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		.wd33{
			width: 33.33%;
		}
		.tbl-cliente{
			border: 1px solid #CCC;
			border-radius: 10px;
			padding: 5px;
		}
		.wd10{
			width: 10%;
		}
		.wd15{
			width: 15%;
		}
		.wd40{
			width: 40%;
		}
		.wd55{
			width: 55%;
		}
		.tbl-detalle{
			border-collapse: collapse;
		}
		.tbl-detalle thead th{
			padding: 5px;
			background-color: #009688;
			color: #FFF;
		}
		.tbl-detalle tbody td{
			border-bottom: 1px solid #CCC;
			padding: 5px;
		}
		.tbl-detalle tfoot td{
			padding: 5px;
		}
	</style>
</head>
<body>
	<table class="tbl-hader">
		<tbody>
			<tr>
				<td class="wd33">
			<img class="logo_login" style="max-width: 100px;" src="<?= base_url(); ?>/Assets/images/logo.jpeg" >
				</td>
				<td class="text-center wd33">
					<h4><strong><?= NOMBRE_EMPESA ?></strong></h4>
					<p><?= DIRECCION ?> <br>
					Teléfono: <?= TELEMPRESA ?> <br>
					Email: <?= EMAIL_EMPRESA  ?></p>
				</td>
				<td class="text-right wd33">
			
			
					<p>No. Orden <strong><?= $orden[0]['Id_Pedido'] ?></strong><br>
						Fecha: <?= $orden[0]['Fecha_Hora'] ?>  <br>
						<?php 
							
						 ?>
						
						
						Método Pago: Pago contra entrega <br>
						Tipo Pago: <?= $orden[0]['Nombre'] ?>
						
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="tbl-cliente">
		<tbody>
			<tr>
				<td class="wd10">Identidad:</td>
				<td class="wd40"><?= $cliente[0]['Numero_ID'] ?></td>
				<td class="wd10">Teléfono:</td>
				<td class="wd40"><?= $cliente[0]['Telefono'] ?></td>
			</tr>
			<tr>
				<td>Nombre:</td>
				<td><?= $cliente[0]['Nombre'].' '.$cliente[0]['Apellidos'] ?></td>
				<td>Dirección:</td>
				<td><?= $cliente[0]['Direccion'] ?></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="tbl-detalle">
		<thead>
			<tr>
				<th class="wd55">Descripción</th>
				<th class="wd15 text-right">Precio</th>
				<th class="wd15 text-center">Cantidad</th>
				<th class="wd15 text-right">Importe</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$subtotal = 0;
				$ISV11 = 0;
				foreach ($detalle as $producto) {
					$importe = $producto['Precio_Venta'] * $producto['Cantidad'];
					$subtotal = $subtotal + $importe;
					$ISV11 += $producto['Porcentaje_ISV'] *  ($importe) ;
			 ?>
			<tr>
				<td><?= $producto['Nombre'] ?></td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($producto['Precio_Venta']) ?></td>
				<td class="text-center"><?= $producto['Cantidad'] ?></td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($importe) ?></td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" class="text-right">Subtotal:</td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($subtotal) ?></td>
			</tr>
			<tr>
				<td colspan="3" class="text-right">Descuento:</td>
				<td class="text-right"><?php 

				$descuento2 = ($subtotal - $descuento ) + $ISV11  ;
				if ($descuento2 > 0){

					echo SMONEY.' '.formatMoney( ($subtotal - $descuento ) + $ISV11  ) ;
				}else{
					echo SMONEY.' '.formatMoney( 0) ;
					$descuento2  = 0;
				}
				?></td>
			</tr>
			<tr>
				<td colspan="3" class="text-right">Envío:</td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($orden[0]['Costo_envio']); ?></td>
			</tr>
			<tr>
                            <th colspan="3" class="text-right">ISV:</th>
                            <td class="text-right"><?php
                          
                        
                        //  $ISV11 +=  $subtotal * ($_SESSION['arrCarrito'][$_SESSION['contador']]['Porcentaje_ISV'] );
                      
                              echo   SMONEY . ' ' . formatMoney( $ISV11  ) ?></td>
                          
                          </tr>
			<tr>
				<td colspan="3" class="text-right">Total:</td>
				<td class="text-right"><?= SMONEY.' '.formatMoney($subtotal + $ISV11 -$descuento2 + $orden[0]['Costo_envio']); ?></td>
			</tr>
		</tfoot>
	</table>
	<?php if( $orden[0]['tipoFactura']  == 1){
		
							?>
	
	<p>No. C.A.I: <strong><?= $orden[0]['Numero_CAI'] ?></strong><br>
						FACTURA :000 - 001 - 000 - 00<?= $orden[0]['Numero_Factura'] ?>  <br>
						<?php 
							
						 ?>
						
						Rango Autorizado: 000 - 000 - 00 <?= $orden[0]['Rango_Inicial'] ?> al 000 - 001 -  <?= $orden[0]['Rango_Final'] ?>
						<br>
					
						Fecha limite de emision: <?= $orden[0]['Fecha_Vencimiento'] ?>
						
					</p>
					<?php 	
}
						
						?>
	<div class="text-center">
		<p>Si tienes preguntas sobre tu pedido, <br> pongase en contacto con nombre, teléfono y Email</p>
		<h4>¡Gracias por tu compra!</h4>
	</div>
	
</body>
<script> const base_url = "<?= base_url(); ?>"; </script>
</html>