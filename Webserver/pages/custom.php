
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

<?php
if(isset($_POST['simpan'])){
    //Recolección de variables POST
    $fecha1=$_POST['datepicker'];
    $fecha2=$_POST['datepicker1'];
    $usuario=$_POST['usuario'];
    if($usuario=="Todos"){
        $query_start=mysqli_query($link,"SELECT id FROM minutedata WHERE Datex='$fecha1' ORDER BY id ASC LIMIT 0,1");
        $query_stop=mysqli_query($link,"SELECT id FROM minutedata WHERE Datex='$fecha2' ORDER BY id DESC LIMIT 0,1");
    }else{
        $query=mysqli_query($link,"SELECT * FROM minutedata WHERE Datex  BETWEEN '$fecha1' and '$fecha2' AND wellid LIKE '$usuario'");
    }
    $row_start = mysqli_fetch_array($query_start);
    $id_start = $row_start['id'];
    $row_stop = mysqli_fetch_array($query_stop);
    $id_stop = $row_stop['id'];
    echo "Start:$id_start Y Stop:$id_stop";
    echo "<script>setTimeout(\"location.href = 'pages/pdfcustom.php?st1=$id_start&st2=$id_stop';\");</script>";
    //Consulta a tabla de usuarios
    $query=mysqli_query($link,"SELECT * FROM usuarios WHERE usuario='$usuario'");
    $row=mysqli_fetch_array($query);
}
?>



<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
    <section class="panel">
        <header class="panel-heading" align="center">
            <div align="center"><h4><strong>Selecciona las fechas y el usuario para ver los registros de testing.</strong></h4></div>
        </header>
        <div class="panel-body">
            <div class="col-sm-12">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped">
                    <tr>
                        <td>
                            <strong>Fecha de busqueda inicio:</strong>&#160;</strong>
                        </td>
                        <td>                                    
                            <form method="post" action="">
                            <input type="text" name="datepicker" id="datepicker" readonly="readonly" data-date-format="yyyy-mm-dd" size="16" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form method="post" action="">
                            <strong>Fecha de busqueda fin:</strong>&#160;</strong>
                        </td>
                        <td>
                            <input type="text" name="datepicker1" id="datepicker2" readonly="readonly" data-date-format="yyyy-mm-dd" size="16" />                                   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Pozo:</strong>&#160;</strong>
                        </td>
                        <td>
                            <?php
                            $result=mysqli_query($link,"SELECT * FROM profile");
                            ?> 
                            <select name='usuario'>
                                <option value="Todos"><?php echo "Todos los pozos"; ?></option>
                                </form><?php while($registros=mysqli_fetch_array($result)){?>
                                <option value="<?php echo $registros["name"]; ?>"><?php echo $registros["name"] ?></option>
                                </form>
                                <?php } ?>
                            </select>                                   
                        </td>
                    </tr>
                </table>                                
                    <div align="center">
                        <button type="submit" name="simpan" class="btn btn-success btn-lg" alt="Submit Form">Ver reporte</button>
                    
                    </div>
            </div>
            </div>
        </div>
    </section>
</div>