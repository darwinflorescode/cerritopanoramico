<!-- Modal para mostrar los desarrolladores del sistema o copyright-->
<form class="form-horizontal" action="#" method="POST"  accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" >
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title">Desarrolladores</h4>

</div>
<div class="modal-body">
<center>
<img src="../imagenes/cerrito.png" width="100px" height="120px">
<img src="../imagenes/itca.jpg" width="155px" height="120px">
<img src="../imagenes/1.jpg" width="150px" height="120px">
<img src="../imagenes/3.jpg" width="150px" height="100px">
<img src="../imagenes/2.jpg" width="140px" height="150px">
<img src="../imagenes/mined.png" width="140px" height="100px">
</center>
<div class="form-group">

<div class="col-sm-50">
<div class="container">
<table align="center" width="80%" >
<tr>

<td><li><a href="">Daniela del Carmen Reyes</a></li></td>
<td>&nbsp;</td><td>&nbsp;</td>
<td><li><a href="">Yoselin Antonieta Ramos</a></li></td>
</tr>
<tr>
<td><img src="../imagenes/daniela.png" ></td>
<td>&nbsp;</td><td>&nbsp;</td>
<td><img src="../imagenes/yoselin.png" ></td>
</tr>

<tr><td>&nbsp;</td></tr>
<tr>

<td><li><a href="">Isaias Arbizú Jovel Carranza</a></li></td>
<td>&nbsp;</td><td>&nbsp;</td>
<td><li><a href="">Darwin Alfonso Flores Colindres</a></li></td>
</tr>
<tr>
<td><img src="../imagenes/arbi.jpg" width="150px" ></td>
<td>&nbsp;</td><td>&nbsp;</td>
<td><img src="../imagenes/darwin.png" ></td>
</tr>
</table>

</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

</div>
</div>
</div>
</div>
</form>

</div>
<footer class="main-footer">
<div class="pull-right hidden-xs">
<b><a href="#" data-toggle="modal" data-target="#modal_info">Desarrollado por:</a></b>
</div>
<strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://fademype.org.sv/fademype/?p=1647"  target="_blank">Sistema de Restaurante Cerrito Panor&aacute;mico</a></strong> Todos los derechos reservados.
</footer> </div> 

<script src="./lib/jQuery-2.1.4.min.js"></script>
<script src="../lib/bootstrap.min.js"></script>
<script src="../lib/app.min.js"></script>



</body></html>

<?php


//Revision de session de ingreso al sistema

if (!$_SESSION["ok"])

{


  header("location:../");

}

?>