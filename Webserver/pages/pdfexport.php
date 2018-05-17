<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<style>
.datepicker{z-index:1151 !important;}
</style>
<?php
$id	= 	mysqli_real_escape_string($link,$_GET['id']);
if(isset($_POST['simpan'])){
	echo "<body onLoad=$('#myModal').modal('hide')>";
	//Get post variables
	$LP			=	mysqli_real_escape_string($link,$_POST['LP']);
	$NP			=	mysqli_real_escape_string($link,$_POST['NP']);
	$SN			=	mysqli_real_escape_string($link,$_POST['SN']);
	$HZ			=	mysqli_real_escape_string($link,$_POST['HZ']);
	$SISB		=	mysqli_real_escape_string($link,$_POST['SISB']);
	$FA			=	mysqli_real_escape_string($link,$_POST['FA']);
	$DEN		=	mysqli_real_escape_string($link,$_POST['DEN']);
	$API		=	mysqli_real_escape_string($link,$_POST['API']);
	$GR			=	mysqli_real_escape_string($link,$_POST['GR']);
	$TK			=	mysqli_real_escape_string($link,$_POST['TK']);
	$OSS		=	mysqli_real_escape_string($link,$_POST['OSS']);
	$CL			=	mysqli_real_escape_string($link,$_POST['CL']);

	mysqli_query($link,"UPDATE testing SET LP='$LP',NP='$NP',SN='SN',HZ='$HZ',SISB='$SISB',FA='$FA',DEN='$DEN',API='$API',GR='$GR',TK='$TK',OSS='$OSS',CL='$CL' WHERE id='$id'");

   echo "<div class='alert alert-success' align=center>";
   echo "<h2>¡Será redirigido al reporte en breve!</h2>";
   echo "</div>";
   echo "<script>setTimeout(\"location.href = 'pages/pdf.php?id=$id';\", 3000);</script>";

}else{
	echo "<body onLoad=$('#myModal').modal('show')>";
}
?>

<!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Información preliminar del informe</h4>
                            </div>
                        <div class="modal-body">
                        <form id="modal-form" action="" method="post">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Localización del pozo:</label>
                                <input type="text" class="form-control" name="LP" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre del pozo:</label>
                                <input type="text" class="form-control" name="NP" required>
                            </div>
                            <div class="form-group">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Medidor SN</label>
                                <input type="text" class="form-control" name="SN" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Frecuencia (Hz):</label>
                                <input type="text" class="form-control" name="HZ" required>
                            </div>
                            <div class="form-group">
         						<label for="recipient-name" class="control-label">Sistema de bombeo:</label>
         						<select class="form-control" name="SISB">
         						<option>Sistema 1</option>
                                <option>Sistema 2</option>
                                <option>Sistema 3</option>
                                <option>Sistema 4</option>
                                <option>Sistema 5</option>
         						</select>
         					</div>
         					 <div class="form-group">
                                <label for="recipient-name" class="control-label">Fecha alineación del pozo:</label>
                                <input type="text" required id="datepicker" data-date-format="yyyy-mm-dd" readonly="readonly" class="form-control" name="FA" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Densidad del agua @60°F(kg/m3)</label>
                                <input type="text" class="form-control" name="DEN" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Crudo API@60°F</label>
                                <input type="text" class="form-control" name="API" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Gr @60°F(14.7psi)</label>
                                <input type="text" class="form-control" name="GR" required>
                            </div>
                            <div class="form-group">
         						<label for="recipient-name" class="control-label">Prueba TK:</label>
         						<select class="form-control" name="TK" required>
         						<option>Si</option>
                                <option>No</option>
         						</select>
         					</div>
         					<div class="form-group">
                                <label for="recipient-name" class="control-label">Representante OSS:</label>
                                <input type="text" class="form-control" name="OSS" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Representante Cliente:</label>
                                <input type="text" class="form-control" name="CL" required>
                            </div>
                            <div class="text-right">
								<td><a class="btn btn-default" title="Cerrar" href="index.php">Cerrar</a></td>
                                <button type="submit" class="btn btn-primary" name="simpan" value="Sign up">Generar informe</button>
                            </div>
                        </form>
                    </div>
                </div>
</div>