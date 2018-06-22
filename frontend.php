<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CALCULA UF</title>
</head>
<body>
    


<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 10%;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
<center>
      <h4><label style="color: red;"><?php echo ($count = 2); ?></label> propiedades fueron actualizadas!</h4>
      <h4>Valor de la UF: <label style="color: red;"><?php echo ($ufhoy = 22); ?></label></h4>
</center>
      </div>
      <div class="modal-footer">
<center>
        <a class="btn btn-default" href="http://corredoramendez.cl/wp-admin/" role="button">Volver al Panel de Administracion</a>
</center>
      </div>
    </div>
  </div>
</div>


    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('#myModal').modal({
    backdrop: 'static',
    keyboard: false
});
    $('#myModal').modal('show'); 
});
</script>


</body>
</html>

