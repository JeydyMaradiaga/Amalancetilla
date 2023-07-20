<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<select id="miSelect">
  <option value="1">Opción 1</option>
  <option value="2">Opción 2</option>
  <option value="3">Opción 3</option>
</select>
<button id="ocultarOpcionButton">Ocultar y limpiar</button>
<script src="<?= base_url(); ?>/Assets/js/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
  $("#ocultarOpcionButton").click(function() {
    var opcionSeleccionadaText = $("#miSelect option:selected").text();
    
    $("#miSelect option").filter(function() {
      return $(this).text() === opcionSeleccionadaText;
    }).hide();
    
    $("#miSelect").val("");
  });
});

</script>
</body>
</html> 