<?php
headerAdmin($data);

?>
<?php
include("BRM-master\php\Connet.php");
?>

<body data-ng-app="validationApp">
	<div class="container" data-ng-controller="RegistrationController">


		<data-uib-tabset data-active="activeJustified" data-justified="true">
			<data-uib-tab data-heading="BACKUP" data-index="0">
				<br />
				<center>
					<div class="main">
						<header class="page-header">
							<div class="branding">
								<br>
							
								<form action="BRM-master\php\Restore.php" method="POST">
								<h1 > <p><center>  </center></p></h1>
								<h1 > <p><center>  </center></p></h1>
									<h1 > 
										
										<center>Restauración base de datos</center>
										</p>
									</h1>
									<select name="restorePoint">
										<option value="" disabled="" selected="">Selecciona un punto de restauración
										<option>
											<?php
											$ruta = "C:/wamp64/www/Amalancetilla/BRM-master/backups/";
											if (is_dir($ruta)) {
												if ($aux = opendir($ruta)) {
													while (($archivo = readdir($aux)) !== false) {
														if ($archivo != "." && $archivo != "..") {
															$nombrearchivo = str_replace(".sql", "", $archivo);
															$nombrearchivo = str_replace("-", ":", $nombrearchivo);
															$ruta_completa = "C:/wamp64/www/Amalancetilla/BRM-master/backups/" . $archivo;
															if (is_dir($ruta_completa)) {
															} else {
																echo '<option value="' . $ruta_completa . '">' . $nombrearchivo . '</option>';
															}
														}
													}
													closedir($aux);
												}
											} else {
												echo $ruta . " No es ruta válida";
											}
											?>
									</select>
									<center><button type="submit" class="restaurar-button">Restaurar</button></center>
									
								</form> 

</body>

<script src="/JS/bitacora.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/JS/Menu.js"></script>
</body>
<?php footerAdmin($data); ?>