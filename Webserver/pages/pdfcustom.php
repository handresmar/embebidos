<?php

/*
  An Example PDF Report Using FPDF
  by Matt Doyle

  From "Create Nice-Looking PDFs with PHP and FPDF"
  http://www.elated.com/articles/create-nice-looking-pdfs-php-fpdf/
*/

require( "fpdf/fpdf.php" );
require('../inc/config.php');

//Get variables
$start_id = mysqli_real_escape_string($link,$_GET['st1']);
$stop_id = mysqli_real_escape_string($link,$_GET['st2']);
//MPFM data
$Query_MPFM   = mysqli_query($link,"SELECT AVG(LFR) AS LFR, AVG(OFR) AS OFR, AVG(WFR) AS WFR, AVG(GFR) AS GFR, AVG(WCUT) AS WCUT, AVG(GVF) AS GVF, AVG(TMP) AS TMP, AVG(PRE) AS PRE FROM minutedata WHERE id >= $start_id AND id <= $stop_id");
$Row_MPFM     = mysqli_fetch_array($Query_MPFM);
$LT     =   round($Row_MPFM['LFR'],2);
$WC     =   round($Row_MPFM['WCUT'],2);
$OIL    =   round($Row_MPFM['OFR'],2);
$WAT    =   round($Row_MPFM['WFR'],2);
$GAS    =   round($Row_MPFM['GFR'],2);
$PRE    =   round($Row_MPFM['PRE'],2);
$TMP    =   round($Row_MPFM['TMP'],2);
$GVF    =   round($Row_MPFM['GVF'],2);
$date   =   date('Y-m-d');

// Begin configuration
$textColour = array( 0, 0, 0 );
$headerColour = array( 0, 0, 0 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 100, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 174, 214, 241 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "Reporte $Pozo";
$reportNameYPos = 160;
$logoFile = "../backend/panel/images/logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;


// End configuration


/**
  Create the title page
**/
$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetAutoPageBreak(true,10);
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();
$pdf->SetTitle("Reporte $Nom $date");
// Logo
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

// Report Name
$pdf->SetFont( 'Arial', 'B', 24 );
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, utf8_decode("Reporte de prueba de producción"), 0, 0, 'C' );



/**
  Create the page header, main heading, and intro text
**/

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Cell( -190, 23, $reportName, 0, 0, 'C' );
$pdf->SetFont( 'Arial', 'B', 15 );
$pdf->Ln( 10 );

$pdf -> SetX(15);
$pdf->SetFont( 'Arial', 'B', 15 );
$pdf->Cell( 0, 50, utf8_decode("SUMARIO DE RESULTADOS"), 0, 0, 'C' ); 

$pdf->Ln( 40 );
$pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
// Create the table header row
$pdf->SetFont( 'Arial', 'B', 6 );
// "PRODUCT" cell
$pdf->SetTextColor( $tableHeaderTopProductTextColour[0], $tableHeaderTopProductTextColour[1], $tableHeaderTopProductTextColour[2] );
$pdf->SetFillColor( $tableHeaderTopProductFillColour[0], $tableHeaderTopProductFillColour[1], $tableHeaderTopProductFillColour[2] );

//Cells
$pdf -> SetX(17);
$pdf->Cell( '170', 10, utf8_decode("HAIMO MFPM"), 1, 0, 'C', true );
$pdf->Ln( 10 );
$pdf -> SetX(17);
$pdf->Cell( '20', 8, utf8_decode("Duración (Horas)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Líquido Total"), 1, 0, 'C', true );
$pdf->Cell( '10', 8, utf8_decode("WC (%)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Crudo (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Agua (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Gas (SCFD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Presión (PSI)"), 1, 0, 'C', true );
$pdf->Cell( '30', 8, utf8_decode("Temperatura (°F)"), 1, 0, 'C', true );
$pdf->Cell( '10', 8, utf8_decode("GVF (%)"), 1, 0, 'C', true );
$pdf->Ln( 8 );
$pdf -> SetX(17);
$pdf->Cell( 20, 5, utf8_decode("$DU"), 1, 0, 'C', false );
$pdf->Cell( 20, 5, utf8_decode("$LT"), 1, 0, 'C', false );
$pdf->Cell( 10, 5, utf8_decode("$WC"), 1, 0, 'C', false );
$pdf->Cell( 20, 5, utf8_decode("$OIL"), 1, 0, 'C', false );
$pdf->Cell( 20, 5, utf8_decode("$WAT"), 1, 0, 'C', false );
$pdf->Cell( 20, 5, utf8_decode("$GAS"), 1, 0, 'C', false );
$pdf->Cell( 20, 5, utf8_decode("$PRE"), 1, 0, 'C', false );
$pdf->Cell( 30, 5, utf8_decode("$TMP"), 1, 0, 'C', false );
$pdf->Cell( 10, 5, utf8_decode("$GVF"), 1, 0, 'C', false );

$pdf->Ln(20);
$pdf->SetFont( '', 'BU', 12 );
$pdf->Write( 6, "NOTAS:" );
$pdf->Ln(8);
$pdf->SetFont( 'Arial', '', 10 );
$pdf->Write( 6, "1. Las tasas de flujo que se miden en el MPFM son a condiciones de linea." );
$pdf->Ln(5);
$pdf->Write( 6, "2. Los datos mostrados en el cuadro anterior corresponden al promedio de los resultados tomados durante la prueba." );


$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Ln(6);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tasas de flujo (crudo, agua, liquido) VS tiempo", 0, 0, 'C' );
$pdf->Ln(15);
$Query2 = mysqli_query($link,"SELECT HOUR(hour) as hour, AVG(LFR) AS LFR, AVG(OFR) AS OFR, AVG(WFR) AS WFR, AVG(GFR) AS GFR, AVG(WCUT) AS WCUT, AVG(GVF) AS GVF, AVG(TMP) AS TMP, AVG(PRE) AS PRE FROM `minutedata` WHERE id >= $start_id AND id <= $stop_id GROUP BY HOUR(hour)");
$data['crudo (SBPD)'] = array();
$data['agua (SBPD)'] = array();
foreach ($Query2 as $Row){
        $data['crudo (SBPD)'][$Row['hour']] = $Row['OFR'];
  $data['agua (SBPD)'][$Row['hour']] = $Row['WFR'];
  $data['liquido (SBPD)'][$Row['hour']] = $Row['LFR'];
}
$colors = array(
    'crudo (SBPD)' => array(104,121,207),
    'agua (SBPD)' => array(200,232,137),
    'liquido (SBPD)' => array(200,132,137)
);

$pdf->Ln(10);
$w=190;
$h=100;
$options='VHvBdB';
$maxVal=24;
$nbDiv=10;
        /*******************************************
        Explain the variables:
        $w = the width of the diagram
        $h = the height of the diagram
        $data = the data for the diagram in the form of a multidimensional array
        $options = the possible formatting options which include:
            'V' = Print Vertical Divider lines
            'H' = Print Horizontal Divider Lines
            'kB' = Print bounding box around the Key (legend)
            'vB' = Print bounding box around the values under the graph
            'gB' = Print bounding box around the graph
            'dB' = Print bounding box around the entire diagram
        $colors = A multidimensional array containing RGB values
        $maxVal = The Maximum Value for the graph vertically
        $nbDiv = The number of vertical Divisions
        *******************************************/
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $keys = array_keys($data);
        $ordinateWidth = 10;
        $w -= $ordinateWidth;
        $valX = $pdf->getX()+$ordinateWidth;
        $valY = $pdf->getY();
        $margin = 1;
        $titleH = 8;
        $titleW = $w;
        $lineh = 5;
        $keyH = count($data)*$lineh;
        $keyW = $w/5;
        $graphValH = 5;
        $graphValW = $w-$keyW-3*$margin;
        $graphH = $h-(3*$margin)-$graphValH;
        $graphW = $w-(2*$margin)-($keyW+$margin);
        $graphX = $valX+$margin;
        $graphY = $valY+$margin;
        $graphValX = $valX+$margin;
        $graphValY = $valY+2*$margin+$graphH;
        $keyX = $valX+(2*$margin)+$graphW;
        $keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
        //draw graph frame border
        if(strstr($options,'gB')){
            $pdf->Rect($valX,$valY,$w,$h);
        }
        //draw graph diagram border
        if(strstr($options,'dB')){
            $pdf->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
        }
        //draw key legend border
        if(strstr($options,'kB')){
            $pdf->Rect($keyX,$keyY,$keyW,$keyH);
        }
        //draw graph value box
        if(strstr($options,'vB')){
            $pdf->Rect($graphValX,$graphValY,$graphValW,$graphValH);
        }
        //define colors
        if($colors===null){
            $safeColors = array(0,51,102,153,204,225);
            for($i=0;$i<count($data);$i++){
                $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
            }
        }
        //form an array with all data values from the multi-demensional $data array
        $ValArray = array();
        foreach($data as $key => $value){
            foreach($data[$key] as $val){
                $ValArray[]=$val;                    
            }
        }
        //define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }
        //draw horizontal lines
        $vertDivH = $graphH/$nbDiv;
        if(strstr($options,'H')){
            for($i=0;$i<=$nbDiv;$i++){
                if($i<$nbDiv){
                    $pdf->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
                } else{
                    $pdf->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw vertical lines
        $horiDivW = floor($graphW/(count($data[$keys[0]])-1));
        if(strstr($options,'V')){
            for($i=0;$i<=(count($data[$keys[0]])-1);$i++){
                if($i<(count($data[$keys[0]])-1)){
                    $pdf->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
                } else {
                    $pdf->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw graph lines
        foreach($data as $key => $value){
            $pdf->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
            $pdf->SetLineWidth(0.8);
            $valueKeys = array_keys($value);
            for($i=0;$i<count($value);$i++){
                if($i==count($value)-2){
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+$graphW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                } else if($i<(count($value)-1)) {
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+($i+1)*$horiDivW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                }
            }
            //Set the Key (legend)
            $pdf->SetFont('Courier','',10);
            if(!isset($n))$n=0;
            $pdf->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
            $pdf->SetXY($keyX+8,$keyY+$n*$lineh);
            $pdf->Cell($keyW,$lineh,$key,0,1,'L');
            $n++;
        }
        //print the abscissa values
        foreach($valueKeys as $key => $value){
            if($key==0){
                $pdf->SetXY($graphValX,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'L');
            } else if($key==count($valueKeys)-1){
                $pdf->SetXY($graphValX+$graphValW-30,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'R');
            } else {
                $pdf->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'C');
            }
        }
        //print the ordinate values
        for($i=0;$i<=$nbDiv;$i++){
            $pdf->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
            $pdf->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
        }
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);

$pdf->Ln(100);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tiempo (Horas)", 0, 0, 'C' );


$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Ln(6);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tasas de flujo (WC,GVF) vs tiempo", 0, 0, 'C' );
$pdf->Ln(15);
$data2['WC (%)'] = array();
$data2['GVF (%)'] = array();
foreach ($Query2 as $Row){
        $data2['WC (%)'][$Row['hour']] = $Row['WCUT'];
  $data2['GVF (%)'][$Row['hour']] =$Row['GVF'];
}
$colors = array(
    'WC (%)' => array(114,171,237),
    'GVF (%)' => array(104,121,207),
);
$pdf->Ln(10);
$w=190;
$h=100;
$options='VHvBdB';
$maxVal=24;
$nbDiv=10;
        /*******************************************
        Explain the variables:
        $w = the width of the diagram
        $h = the height of the diagram
        $data = the data for the diagram in the form of a multidimensional array
        $options = the possible formatting options which include:
            'V' = Print Vertical Divider lines
            'H' = Print Horizontal Divider Lines
            'kB' = Print bounding box around the Key (legend)
            'vB' = Print bounding box around the values under the graph
            'gB' = Print bounding box around the graph
            'dB' = Print bounding box around the entire diagram
        $colors = A multidimensional array containing RGB values
        $maxVal = The Maximum Value for the graph vertically
        $nbDiv = The number of vertical Divisions
        *******************************************/
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $keys = array_keys($data2);
        $ordinateWidth = 10;
        $w -= $ordinateWidth;
        $valX = $pdf->getX()+$ordinateWidth;
        $valY = $pdf->getY();
        $margin = 1;
        $titleH = 8;
        $titleW = $w;
        $lineh = 5;
        $keyH = count($data2)*$lineh;
        $keyW = $w/5;
        $graphValH = 5;
        $graphValW = $w-$keyW-3*$margin;
        $graphH = $h-(3*$margin)-$graphValH;
        $graphW = $w-(2*$margin)-($keyW+$margin);
        $graphX = $valX+$margin;
        $graphY = $valY+$margin;
        $graphValX = $valX+$margin;
        $graphValY = $valY+2*$margin+$graphH;
        $keyX = $valX+(2*$margin)+$graphW;
        $keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
        //draw graph frame border
        if(strstr($options,'gB')){
            $pdf->Rect($valX,$valY,$w,$h);
        }
        //draw graph diagram border
        if(strstr($options,'dB')){
            $pdf->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
        }
        //draw key legend border
        if(strstr($options,'kB')){
            $pdf->Rect($keyX,$keyY,$keyW,$keyH);
        }
        //draw graph value box
        if(strstr($options,'vB')){
            $pdf->Rect($graphValX,$graphValY,$graphValW,$graphValH);
        }
        //define colors
        if($colors===null){
            $safeColors = array(0,51,102,153,204,225);
            for($i=0;$i<count($data2);$i++){
                $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
            }
        }
        //form an array with all data values from the multi-demensional $data array
        $ValArray = array();
        foreach($data2 as $key => $value){
            foreach($data2[$key] as $val){
                $ValArray[]=$val;                    
            }
        }
        //define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }
        //draw horizontal lines
        $vertDivH = $graphH/$nbDiv;
        if(strstr($options,'H')){
            for($i=0;$i<=$nbDiv;$i++){
                if($i<$nbDiv){
                    $pdf->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
                } else{
                    $pdf->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw vertical lines
        $horiDivW = floor($graphW/(count($data2[$keys[0]])-1));
        if(strstr($options,'V')){
            for($i=0;$i<=(count($data2[$keys[0]])-1);$i++){
                if($i<(count($data2[$keys[0]])-1)){
                    $pdf->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
                } else {
                    $pdf->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw graph lines
        foreach($data2 as $key => $value){
            $pdf->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
            $pdf->SetLineWidth(0.8);
            $valueKeys = array_keys($value);
            for($i=0;$i<count($value);$i++){
                if($i==count($value)-2){
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+$graphW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                } else if($i<(count($value)-1)) {
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+($i+1)*$horiDivW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                }
            }
            //Set the Key (legend)
            $pdf->SetFont('Courier','',10);
            if(!isset($n))$n=0;
            $pdf->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
            $pdf->SetXY($keyX+8,$keyY+$n*$lineh);
            $pdf->Cell($keyW,$lineh,$key,0,1,'L');
            $n++;
        }
        //print the abscissa values
        foreach($valueKeys as $key => $value){
            if($key==0){
                $pdf->SetXY($graphValX,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'L');
            } else if($key==count($valueKeys)-1){
                $pdf->SetXY($graphValX+$graphValW-30,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'R');
            } else {
                $pdf->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'C');
            }
        }
        //print the ordinate values
        for($i=0;$i<=$nbDiv;$i++){
            $pdf->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
            $pdf->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
        }
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
$pdf->Ln(100);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tiempo (Horas)", 0, 0, 'C' );

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Ln(6);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tasas de flujo(Gas) vs tiempo", 0, 0, 'C' );
$pdf->Ln(15);
$data3['Gas (SCFD)'] = array();
foreach ($Query2 as $Row){
        $data3['Gas (SCFD)'][$Row['hour']] = $Row['GFR'];
}
$data2 = $data3;
$colors = array(
    'Gas (SCFD)' => array(0,251,237),
);
$pdf->Ln(10);
$w=190;
$h=100;
$options='VHvBdB';
$maxVal=1;
$nbDiv=10;
        /*******************************************
        Explain the variables:
        $w = the width of the diagram
        $h = the height of the diagram
        $data = the data for the diagram in the form of a multidimensional array
        $options = the possible formatting options which include:
            'V' = Print Vertical Divider lines
            'H' = Print Horizontal Divider Lines
            'kB' = Print bounding box around the Key (legend)
            'vB' = Print bounding box around the values under the graph
            'gB' = Print bounding box around the graph
            'dB' = Print bounding box around the entire diagram
        $colors = A multidimensional array containing RGB values
        $maxVal = The Maximum Value for the graph vertically
        $nbDiv = The number of vertical Divisions
        *******************************************/
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $keys = array_keys($data2);
        $ordinateWidth = 10;
        $w -= $ordinateWidth;
        $valX = $pdf->getX()+$ordinateWidth;
        $valY = $pdf->getY();
        $margin = 1;
        $titleH = 8;
        $titleW = $w;
        $lineh = 5;
        $keyH = count($data2)*$lineh;
        $keyW = $w/5;
        $graphValH = 5;
        $graphValW = $w-$keyW-3*$margin;
        $graphH = $h-(3*$margin)-$graphValH;
        $graphW = $w-(2*$margin)-($keyW+$margin);
        $graphX = $valX+$margin;
        $graphY = $valY+$margin;
        $graphValX = $valX+$margin;
        $graphValY = $valY+2*$margin+$graphH;
        $keyX = $valX+(2*$margin)+$graphW;
        $keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
        //draw graph frame border
        if(strstr($options,'gB')){
            $pdf->Rect($valX,$valY,$w,$h);
        }
        //draw graph diagram border
        if(strstr($options,'dB')){
            $pdf->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
        }
        //draw key legend border
        if(strstr($options,'kB')){
            $pdf->Rect($keyX,$keyY,$keyW,$keyH);
        }
        //draw graph value box
        if(strstr($options,'vB')){
            $pdf->Rect($graphValX,$graphValY,$graphValW,$graphValH);
        }
        //define colors
        if($colors===null){
            $safeColors = array(0,51,102,153,204,225);
            for($i=0;$i<count($data2);$i++){
                $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
            }
        }
        //form an array with all data values from the multi-demensional $data array
        $ValArray = array();
        foreach($data2 as $key => $value){
            foreach($data2[$key] as $val){
                $ValArray[]=$val;                    
            }
        }
        //define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }
        //draw horizontal lines
        $vertDivH = $graphH/$nbDiv;
        if(strstr($options,'H')){
            for($i=0;$i<=$nbDiv;$i++){
                if($i<$nbDiv){
                    $pdf->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
                } else{
                    $pdf->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw vertical lines
        $horiDivW = floor($graphW/(count($data2[$keys[0]])-1));
        if(strstr($options,'V')){
            for($i=0;$i<=(count($data2[$keys[0]])-1);$i++){
                if($i<(count($data2[$keys[0]])-1)){
                    $pdf->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
                } else {
                    $pdf->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw graph lines
        foreach($data2 as $key => $value){
            $pdf->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
            $pdf->SetLineWidth(0.8);
            $valueKeys = array_keys($value);
            for($i=0;$i<count($value);$i++){
                if($i==count($value)-2){
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+$graphW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                } else if($i<(count($value)-1)) {
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+($i+1)*$horiDivW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                }
            }
            //Set the Key (legend)
            $pdf->SetFont('Courier','',10);
            if(!isset($n))$n=0;
            $pdf->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
            $pdf->SetXY($keyX+8,$keyY+$n*$lineh);
            $pdf->Cell($keyW,$lineh,$key,0,1,'L');
            $n++;
        }
        //print the abscissa values
        foreach($valueKeys as $key => $value){
            if($key==0){
                $pdf->SetXY($graphValX,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'L');
            } else if($key==count($valueKeys)-1){
                $pdf->SetXY($graphValX+$graphValW-30,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'R');
            } else {
                $pdf->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'C');
            }
        }
        //print the ordinate values
        for($i=0;$i<=$nbDiv;$i++){
            $pdf->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
            $pdf->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
        }
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
$pdf->Ln(100);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tiempo (Horas)", 0, 0, 'C' );

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Ln(6);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, utf8_decode("Temperatura y presión vs tiempo"), 0, 0, 'C' );
$pdf->Ln(15);
$data4['Temp (°F)'] = array();
$data4['Press (PSI)'] = array();
foreach ($Query2 as $Row){
        $data4['Temp (°F)'][$Row['hour']] = $Row['TMP'];
  $data4['Press (PSI)'][$Row['hour']] =$Row['PRE'];
}
$colors = array(
    'Temp (°F)' => array(255,0,0),
    'Press (PSI)' => array(104,21,247),
);
$data2=$data4;
$pdf->Ln(10);
$w=190;
$h=100;
$options='VHvBdB';
$maxVal=24;
$nbDiv=10;
        /*******************************************
        Explain the variables:
        $w = the width of the diagram
        $h = the height of the diagram
        $data = the data for the diagram in the form of a multidimensional array
        $options = the possible formatting options which include:
            'V' = Print Vertical Divider lines
            'H' = Print Horizontal Divider Lines
            'kB' = Print bounding box around the Key (legend)
            'vB' = Print bounding box around the values under the graph
            'gB' = Print bounding box around the graph
            'dB' = Print bounding box around the entire diagram
        $colors = A multidimensional array containing RGB values
        $maxVal = The Maximum Value for the graph vertically
        $nbDiv = The number of vertical Divisions
        *******************************************/
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
        $keys = array_keys($data2);
        $ordinateWidth = 10;
        $w -= $ordinateWidth;
        $valX = $pdf->getX()+$ordinateWidth;
        $valY = $pdf->getY();
        $margin = 1;
        $titleH = 8;
        $titleW = $w;
        $lineh = 5;
        $keyH = count($data2)*$lineh;
        $keyW = $w/5;
        $graphValH = 5;
        $graphValW = $w-$keyW-3*$margin;
        $graphH = $h-(3*$margin)-$graphValH;
        $graphW = $w-(2*$margin)-($keyW+$margin);
        $graphX = $valX+$margin;
        $graphY = $valY+$margin;
        $graphValX = $valX+$margin;
        $graphValY = $valY+2*$margin+$graphH;
        $keyX = $valX+(2*$margin)+$graphW;
        $keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
        //draw graph frame border
        if(strstr($options,'gB')){
            $pdf->Rect($valX,$valY,$w,$h);
        }
        //draw graph diagram border
        if(strstr($options,'dB')){
            $pdf->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
        }
        //draw key legend border
        if(strstr($options,'kB')){
            $pdf->Rect($keyX,$keyY,$keyW,$keyH);
        }
        //draw graph value box
        if(strstr($options,'vB')){
            $pdf->Rect($graphValX,$graphValY,$graphValW,$graphValH);
        }
        //define colors
        if($colors===null){
            $safeColors = array(0,51,102,153,204,225);
            for($i=0;$i<count($data2);$i++){
                $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
            }
        }
        //form an array with all data values from the multi-demensional $data array
        $ValArray = array();
        foreach($data2 as $key => $value){
            foreach($data2[$key] as $val){
                $ValArray[]=$val;                    
            }
        }
        //define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }
        //draw horizontal lines
        $vertDivH = $graphH/$nbDiv;
        if(strstr($options,'H')){
            for($i=0;$i<=$nbDiv;$i++){
                if($i<$nbDiv){
                    $pdf->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
                } else{
                    $pdf->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw vertical lines
        $horiDivW = floor($graphW/(count($data2[$keys[0]])-1));
        if(strstr($options,'V')){
            for($i=0;$i<=(count($data2[$keys[0]])-1);$i++){
                if($i<(count($data2[$keys[0]])-1)){
                    $pdf->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
                } else {
                    $pdf->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw graph lines
        foreach($data2 as $key => $value){
            $pdf->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
            $pdf->SetLineWidth(0.8);
            $valueKeys = array_keys($value);
            for($i=0;$i<count($value);$i++){
                if($i==count($value)-2){
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+$graphW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                } else if($i<(count($value)-1)) {
                    $pdf->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+($i+1)*$horiDivW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                }
            }
            //Set the Key (legend)
            $pdf->SetFont('Courier','',10);
            if(!isset($n))$n=0;
            $pdf->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
            $pdf->SetXY($keyX+8,$keyY+$n*$lineh);
            $pdf->Cell($keyW,$lineh,utf8_decode($key),0,1,'L');
            $n++;
        }
        //print the abscissa values
        foreach($valueKeys as $key => $value){
            if($key==0){
                $pdf->SetXY($graphValX,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'L');
            } else if($key==count($valueKeys)-1){
                $pdf->SetXY($graphValX+$graphValW-30,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'R');
            } else {
                $pdf->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
                $pdf->Cell(30,$lineh,$value,0,0,'C');
            }
        }
        //print the ordinate values
        for($i=0;$i<=$nbDiv;$i++){
            $pdf->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
            $pdf->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
        }
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0.2);
$pdf->Ln(100);
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell( 0, 10, "Tiempo (Horas)", 0, 0, 'C' );

//Hour Data Table

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Ln(6);
$pdf->Cell( 0, 10, "DATA POR HORA", 0, 0, 'C' );
$pdf->Ln(15);
$pdf->SetFont( 'Arial', 'B', 7 );
$pdf -> SetX(17);
$pdf->Cell( '20', 8, utf8_decode("Hora"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Líquido (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Crudo (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Agua (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Gas (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '10', 8, utf8_decode("WC (%)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("GVF (%)"), 1, 0, 'C', true );
$pdf->Cell( '30', 8, utf8_decode("Temperatura (°F)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Pres (PSI)"), 1, 0, 'C', true );
$pdf->Ln(8);
$i=0;
$pdf->SetFont( 'Arial', '', 6 );
$Query = mysqli_query($link,"SELECT HOUR(hour) as hour, AVG(LFR) AS LFR, AVG(OFR) AS OFR, AVG(WFR) AS WFR, AVG(GFR) AS GFR, AVG(WCUT) AS WCUT, AVG(GVF) AS GVF, AVG(TMP) AS TMP, AVG(PRE) AS PRE FROM `minutedata` WHERE id >= $start_id AND id <= $stop_id GROUP BY HOUR(hour)");
while($Row = mysqli_fetch_array($Query)){
  $pdf -> SetX(17);
  $pdf->Cell( '20', 8, round($Row['hour'],2) , 1, 0, 'C', false );
  $pdf->Cell( '20', 8, round($Row['LFR'],2), 1, 0, 'C', false );
  $pdf->Cell( '20', 8, round($Row['OFR'],2), 1, 0, 'C', false );
  $pdf->Cell( '20', 8, round($Row['WFR'],2), 1, 0, 'C', false );
  $pdf->Cell( '20', 8, round($Row['GFR'],2), 1, 0, 'C', false );
  $pdf->Cell( '10', 8, round($Row['WCUT'],2), 1, 0, 'C', false );
  $pdf->Cell( '20', 8, round($Row['GVF'],2), 1, 0, 'C', false );
  $pdf->Cell( '30', 8, round($Row['TMP'],2), 1, 0, 'C', false );
  $pdf->Cell( '20', 8, round($Row['PRE'],2), 1, 0, 'C', false );
  $pdf->Ln(8);
  $i++;
}

//Minute data table

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'Arial', 'B', 17 );
$pdf->Image('../backend/panel/images/logo.png' , 10 ,8, 40 , 20,'PNG');
$pdf->Cell( 0, 10, "HAIMO MPFM", 0, 0, 'C' );
$pdf->Ln(6);
$pdf->Cell( 0, 10, "DATA POR MINUTO", 0, 0, 'C' );
$pdf->Ln(15);
$pdf->SetFont( 'Arial', 'B', 7 );
$pdf -> SetX(17);
$pdf->Cell( '20', 8, utf8_decode("Tiempo"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Líquido (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Crudo (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Agua (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Gas (SBPD)"), 1, 0, 'C', true );
$pdf->Cell( '10', 8, utf8_decode("WC (%)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("GVF (%)"), 1, 0, 'C', true );
$pdf->Cell( '30', 8, utf8_decode("Temperatura (°F)"), 1, 0, 'C', true );
$pdf->Cell( '20', 8, utf8_decode("Pres (PSI)"), 1, 0, 'C', true );
$pdf->Ln(8);
$i=0;
$pdf->SetFont( 'Arial', '', 6 );
$Query = mysqli_query($link,"SELECT * FROM minutedata WHERE id >= $start_id AND id <= $stop_id ORDER BY id DESC");
while($Row = mysqli_fetch_array($Query)){
  $pdf -> SetX(17);
  $pdf->Cell( '20', 8, $Row['hour'] , 1, 0, 'C', false );
  $pdf->Cell( '20', 8, $Row['LFR'], 1, 0, 'C', false );
  $pdf->Cell( '20', 8, $Row['OFR'], 1, 0, 'C', false );
  $pdf->Cell( '20', 8, $Row['WFR'], 1, 0, 'C', false );
  $pdf->Cell( '20', 8, $Row['GFR'], 1, 0, 'C', false );
  $pdf->Cell( '10', 8, $Row['WCUT'], 1, 0, 'C', false );
  $pdf->Cell( '20', 8, $Row['GVF'], 1, 0, 'C', false );
  $pdf->Cell( '30', 8, $Row['TMP'], 1, 0, 'C', false );
  $pdf->Cell( '20', 8, $Row['PRE'], 1, 0, 'C', false );
  $pdf->Ln(8);
  $i++;
}

$pdf->Output( "Reporte $Nom $date.pdf", "I" );
?>

