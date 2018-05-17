<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<?php
$result=mysqli_query($link,"SELECT * FROM profile ORDER BY id DESC");
$get=$_GET['id'];
switch ($ge) {
    case '0':
        echo "Hola";
        break;
    case '1':
        echo "Adios";   
        break;
    default:
        # code...
        break;
}
?>
<div class="row">
  <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Perfiles pozos
            </header>
             <div class="panel-body"> 
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-square"></i> Nuevo perfil 
                            </button>
            </div>
            <section class="panel">
                        <div class="panel-body">
                         <div class="table-responsive">
                                <table  class="display table table-bordered table-striped" id="dynamic-table">
                                    <thead>
                                        <tr>
                                            <th>Perfil</th>
                                            <th><i class="fa fa-eye"></i></th>
                                            <th><i class="fa fa-trash"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach( $result as $row => $field ) : ?> <!-- Mulai loop -->
                                        <tr class="text-besar">
                                            <td><?php echo $field['name']; ?></td>
                                            <td>
                                                <a class="btn btn-success btn-xs" target="_blank" href="pages/pdf.php?id=<?php echo $field['id']; ?>" title="Editar reporte">
                                                    <i class="fa fa-eye"></i>
                                                    </form>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-xs" target="_blank" href="pages/pdf.php?id=<?php echo $field['id']; ?>" title="Eliminar reporte">
                                                    <i class="fa fa-trash"></i>
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?> <!-- Selesai loop -->                                  
                                    </tbody>
</table>
                        </div>
            </section>
        </section>
    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Nuevo perfil</h4>

            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Parameter 1</a>

                        </li>
                        <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Parameter 2</a>

                        </li>

                        </li>
                        <li role="presentation"><a href="#P3" aria-controls="P3" role="tab" data-toggle="tab">Parameter 3</a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab">
                    <form id="modal-form" action="" method="post">
                            <b><h3>Background Information</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Engineer *:</b></label>
                                <input type="text" class="form-control" name="en" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Customer *:</b></label>
                                <input type="text" class="form-control" name="cus" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Oil Field *:</b></label>
                                <input type="text" class="form-control" name="oil_f" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Station Name *:</b></label>
                                <input type="text" class="form-control" name="stn" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Software Version *:</b></label>
                                <input type="text" class="form-control" name="sfv" required>
                            </div>
                            <br>
                            <b><h3>Public</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Oil Density(Std kg/m3) *:</b></label>
                                <input type="text" class="form-control" name="oil_d" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Water Density(Std kg/m3) *:</b></label>
                                <input type="text" class="form-control" name="wa_d" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Gas Density(Std kg/m3) *:</b></label>
                                <input type="text" class="form-control" name="gas_d" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Atmospheric Press(kPa) *:</b></label>
                                <input type="text" class="form-control" name="at_press" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Gr *:</b></label>
                                <input type="text" class="form-control" name="gr" required>
                            </div>
                            <br>
                            <b><h3>Liquids Leg Major</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Temperature[URV][°C] *:</b></label>
                                <input type="text" class="form-control" name="temp_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Temperature[LRV][°C] *:</b></label>
                                <input type="text" class="form-control" name="temp_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pressure[URV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="press_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pressure[LRV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="press_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP High[URV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="dph_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP High[LRV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="dph_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP Low[URV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="dpl_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP Low[LRV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="dpl_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi C *:</b></label>
                                <input type="text" class="form-control" name="ven_c" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi E *:</b></label>
                                <input type="text" class="form-control" name="ven_e" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi High(mm) *:</b></label>
                                <input type="text" class="form-control" name="ven_h" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi d(mm) *:</b></label>
                                <input type="text" class="form-control" name="ven_d" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi D(mm) *:</b></label>
                                <input type="text" class="form-control" name="ven_dd" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Mode(0->Manual,0 to 1->ratio,2->auto) *:</b></label>
                                <input type="text" class="form-control" name="val_m" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve initialization(0~1) *:</b></label>
                                <input type="text" class="form-control" name="val_i" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Scale(0~1) *:</b></label>
                                <input type="text" class="form-control" name="val_s" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Vortex[LRV](am3/h) *:</b></label>
                                <input type="text" class="form-control" name="vortex" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Latency Time(min) *:</b></label>
                                <input type="text" class="form-control" name="val_lt" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Open Condition[GVF](0~1) *:</b></label>
                                <input type="text" class="form-control" name="val_o" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Close Condition[GVF](0~1) *:</b></label>
                                <input type="text" class="form-control" name="val_c" required>
                            </div>

                            <br>
                            <b><h3>Liquids Leg Minor</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Temperature[URV][°C] *:</b></label>
                                <input type="text" class="form-control" name="m_temp_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Temperature[LRV][°C] *:</b></label>
                                <input type="text" class="form-control" name="m_temp_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pressure[URV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="m_press_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pressure[LRV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="m_press_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP High[URV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="m_dph_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP High[LRV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="m_dph_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP Low[URV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="m_dpl_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP Low[LRV][kPa] *:</b></label>
                                <input type="text" class="form-control" name="m_dpl_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi C *:</b></label>
                                <input type="text" class="form-control" name="m_ven_c" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi E *:</b></label>
                                <input type="text" class="form-control" name="m_ven_e" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi High(mm) *:</b></label>
                                <input type="text" class="form-control" name="m_ven_h" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi d(mm) *:</b></label>
                                <input type="text" class="form-control" name="m_ven_d" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Venturi D(mm) *:</b></label>
                                <input type="text" class="form-control" name="m_ven_dd" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Mode(0->Manual,0 to 1->ratio,2->auto) *:</b></label>
                                <input type="text" class="form-control" name="m_val_m" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve initialization(0~1) *:</b></label>
                                <input type="text" class="form-control" name="m_val_i" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Scale(0~1) *:</b></label>
                                <input type="text" class="form-control" name="m_val_s" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Vortex[LRV](am3/h) *:</b></label>
                                <input type="text" class="form-control" name="m_vortex" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Latency Time(min) *:</b></label>
                                <input type="text" class="form-control" name="m_val_lt" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Open Condition[GVF](0~1) *:</b></label>
                                <input type="text" class="form-control" name="m_val_o" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Valve Close Condition[GVF](0~1) *:</b></label>
                                <input type="text" class="form-control" name="m_val_c" required>
                            </div>
                    </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="browseTab">
                        <form id="modal-form" action="" method="post">
                            <b><h3>Single/Dual Transmitter</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Single 1 Count[URV](Min) *:</b></label>
                                <input type="text" class="form-control" name="s1_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Single 1 Count[LRV](Min) *:</b></label>
                                <input type="text" class="form-control" name="s1_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Single 2 Count[URV](Min) *:</b></label>
                                <input type="text" class="form-control" name="s2_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Single 2 Count[LRV](Min) *:</b></label>
                                <input type="text" class="form-control" name="s2_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Dual Count[URV](Min) *:</b></label>
                                <input type="text" class="form-control" name="d_u" required>
                            </div>
                             <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Dual Count[LRV](Min) *:</b></label>
                                <input type="text" class="form-control" name="d_l" required>
                            </div>
                            <br>
                            <b><h3>Chief Pipe</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Inlet Pressure[URV](kPa) *:</b></label>
                                <input type="text" class="form-control" name="inp_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Inlet Pressure[LRV](kPa) *:</b></label>
                                <input type="text" class="form-control" name="inp_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Outlet Pressure[URV](kPa) *:</b></label>
                                <input type="text" class="form-control" name="oup_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Outlet Pressure[LRV](kPa) *:</b></label>
                                <input type="text" class="form-control" name="oup_l" required>
                            </div>
                            <br>
                            <b><h3>Shut Off Valve</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Mode(0 close, 1 open, 2 auto) *:</b></label>
                                <input type="text" class="form-control" name="soffv_m" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Open Condition[DP_Minor](kPa) *:</b></label>
                                <input type="text" class="form-control" name="soffv_oc" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Close Condition[DP_Minor](kPa) *:</b></label>
                                <input type="text" class="form-control" name="soffv_cc" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Latency Time(Min) *:</b></label>
                                <input type="text" class="form-control" name="soffv_lt" required>
                            </div>
                            
                            <br>
                            <b><h3>Water Cut Value</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Mode(0 manual,0~1 ratio,2 auto) *:</b></label>
                                <input type="text" class="form-control" name="wcv_m" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Initialization *:</b></label>
                                <input type="text" class="form-control" name="wcv_i" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Scale(0~1) *:</b></label>
                                <input type="text" class="form-control" name="wcv_s" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Latency Time(Min) *:</b></label>
                                <input type="text" class="form-control" name="wcv_lt" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Open Condition[GVF] *:</b></label>
                                <input type="text" class="form-control" name="wcv_oc" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Close Condition[GVF]  *:</b></label>
                                <input type="text" class="form-control" name="wcv_cc" required>
                            </div>

                            <br>
                            <b><h3>Alarm Settings</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Flow Alarm[LRV](m3/d)  *:</b></label>
                                <input type="text" class="form-control" name="as_fl_l" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Flow Alarm[URV](m3/d)  *:</b></label>
                                <input type="text" class="form-control" name="as_fl_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>WLR Alarm[URV](0~1)  *:</b></label>
                                <input type="text" class="form-control" name="as_wlr_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pressure Drop Alarm[URV](kPa)  *:</b></label>
                                <input type="text" class="form-control" name="as_pda_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Liquid Leg Pressure Alarm[URV](kPa)  *:</b></label>
                                <input type="text" class="form-control" name="as_llpa_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Gas Leg Pressure Alarm[URV](kPa)  *:</b></label>
                                <input type="text" class="form-control" name="as_glpa_u" required>
                            </div>

                            <br>
                            <b><h3>Analog Signals Output</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Liquid Flow[URV](am3/d)  *:</b></label>
                                <input type="text" class="form-control" name="aso_lf_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Oil Flow[URV](am3/d)  *:</b></label>
                                <input type="text" class="form-control" name="aso_of_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Water Flow[URV](am3/d)  *:</b></label>
                                <input type="text" class="form-control" name="aso_wf_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Gas Flow[URV](Sm3/d)  *:</b></label>
                                <input type="text" class="form-control" name="aso_gf_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Temperature Flow[URV](am3/d)  *:</b></label>
                                <input type="text" class="form-control" name="aso_tf_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pressure Flow[URV](am3/d)  *:</b></label>
                                <input type="text" class="form-control" name="aso_pf_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Density_Mix[URV](kg/m3)  *:</b></label>
                                <input type="text" class="form-control" name="aso_dm_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP_Major Leg[URV]  *:</b></label>
                                <input type="text" class="form-control" name="aso_dml_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>DP_Minor Leg[URV]  *:</b></label>
                                <input type="text" class="form-control" name="aso_dpl_u" required>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane active" id="P3">
                        <form id="modal-form" action="" method="post">
                        <b><h3>Other</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Lower Flow Judge(kPa)  *:</b></label>
                                <input type="text" class="form-control" name="o_lfj" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Single Energy_Na(1/Deg. C)  *:</b></label>
                                <input type="text" class="form-control" name="o_sen" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>GVF Formula Selection  *:</b></label>
                                <input type="text" class="form-control" name="o_gvffs" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>WLR Formula Selection  *:</b></label>
                                <input type="text" class="form-control" name="o_wflfs" required>
                            </div>

                            <br>
                            <b><h3>WLF Policy</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>GVF2_Limit[URV](0~1)  *:</b></label>
                                <input type="text" class="form-control" name="wlfp_gfvl_u" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>GVF2_Limit[LRV](0~1)  *:</b></label>
                                <input type="text" class="form-control" name="wlfp_gfvl_l" required>
                            </div>

                            <br>
                            <b><h3>PVT</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Oil Expansivity(1/Deg.C)  *:</b></label>
                                <input type="text" class="form-control" name="pvt_oe" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Water Expansivity(1/Deg.C)  *:</b></label>
                                <input type="text" class="form-control" name="pvt_we" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Oil Shrinkage Factor  *:</b></label>
                                <input type="text" class="form-control" name="pvt_osf" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Z Factor  *:</b></label>
                                <input type="text" class="form-control" name="pvt_zf" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Solution GOR(m3/m3)  *:</b></label>
                                <input type="text" class="form-control" name="pvt_solgor" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>PVT_Mode  *:</b></label>
                                <input type="text" class="form-control" name="pvt_mode" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>PVT_Para1  *:</b></label>
                                <input type="text" class="form-control" name="pvt_p1" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>PVT_Para2  *:</b></label>
                                <input type="text" class="form-control" name="pvt_p2" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>PVT_Para3  *:</b></label>
                                <input type="text" class="form-control" name="pvt_p3" required>
                            </div>

                            <br>
                            <b><h3>Formula</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Liquid C1  *:</b></label>
                                <input type="text" class="form-control" name="form_lc1" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Gas C2  *:</b></label>
                                <input type="text" class="form-control" name="form_gc2" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>WLR C3  *:</b></label>
                                <input type="text" class="form-control" name="form_wlrc3" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Sampling Water Ratio  *:</b></label>
                                <input type="text" class="form-control" name="form_swr" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Water Permission Range  *:</b></label>
                                <input type="text" class="form-control" name="form_wpr" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Zn  *:</b></label>
                                <input type="text" class="form-control" name="form_zn" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Mn  *:</b></label>
                                <input type="text" class="form-control" name="form_mn" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Mc  *:</b></label>
                                <input type="text" class="form-control" name="form_mc" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Mc1  *:</b></label>
                                <input type="text" class="form-control" name="form_mc1" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>H2S  *:</b></label>
                                <input type="text" class="form-control" name="form_h2s" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Pb(kPa)  *:</b></label>
                                <input type="text" class="form-control" name="form_pb" required>
                            </div>

                            <br>
                            <b><h3>C and Red Calculation</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>MixVisSel  *:</b></label>
                                <input type="text" class="form-control" name="crc_mvs" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>OilVisSel  *:</b></label>
                                <input type="text" class="form-control" name="crc_ovs" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>OilMolecularWeight  *:</b></label>
                                <input type="text" class="form-control" name="crc_omw" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>OilVis_A  *:</b></label>
                                <input type="text" class="form-control" name="crc_ova" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>OilVis_B  *:</b></label>
                                <input type="text" class="form-control" name="crc_ovb" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>OilVil_C  *:</b></label>
                                <input type="text" class="form-control" name="crc_ovc" required>
                            </div>

                            <br>
                            <b><h3>Gas Liquid Slip</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Slip_Major_A  *:</b></label>
                                <input type="text" class="form-control" name="gls_sma" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Slip_Major_B  *:</b></label>
                                <input type="text" class="form-control" name="gls_smb" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Slip_Major_C  *:</b></label>
                                <input type="text" class="form-control" name="gls_smc" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Slip_Minor_A  *:</b></label>
                                <input type="text" class="form-control" name="gls_smma" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Slip_Minor_B  *:</b></label>
                                <input type="text" class="form-control" name="gls_smmb" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Slip_Minor_C  *:</b></label>
                                <input type="text" class="form-control" name="gls_smmc" required>
                            </div>

                            <br>
                            <b><h3>Backup</h3></b>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Viscosity of 50°C  *:</b></label>
                                <input type="text" class="form-control" name="bu_v50" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Wet Gas Revise Mode  *:</b></label>
                                <input type="text" class="form-control" name="bu_wgrm" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>Surface Tension  *:</b></label>
                                <input type="text" class="form-control" name="bu_st" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>GVF(0:Limited;1 unlimited)  *:</b></label>
                                <input type="text" class="form-control" name="bu_gvf" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>New2  *:</b></label>
                                <input type="text" class="form-control" name="bu_ne2" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>New3  *:</b></label>
                                <input type="text" class="form-control" name="bu_ne3" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>New4  *:</b></label>
                                <input type="text" class="form-control" name="bu_ne4" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>New5  *:</b></label>
                                <input type="text" class="form-control" name="bu_ne5" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>New6  *:</b></label>
                                <input type="text" class="form-control" name="nbu_ne6" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><b>New7  *:</b></label>
                                <input type="text" class="form-control" name="bu_ne7" required>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">Save changes</button>
            </div>
        </div>
    </div>
</div>