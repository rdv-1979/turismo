<?php
    require('../fpdf/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',8);
    $pdf->Image('../imagenes/logo.png',10,12,30,0,'');
    $fecha = date(':i:s');

    $fecha_actual = "Hoy ".date('d')." de ".date('m').utf8_decode(" del año ").date('Y');
    $hora_actual = date('H')-5;
  
    $pdf->Cell(100,20);
    $pdf->Cell(130,20,$fecha_actual.' '.$hora_actual.''.$fecha,0,1,'C');

    $pdf->SetFont('Arial','I',16);

    $pdf->Cell(55,10);
    $pdf->Cell(75,10,utf8_decode('Turismo S.R.L'),1,1,'C');
        
    $pdf->Cell(55,10,"",0,1);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetDrawColor(0,80,180);
    $pdf->SetFillColor(100,34,112);
    $pdf->SetTextColor(45,23,89);
    $pdf->Cell(10,10,"ID",1,0,'C',True);
    $pdf->Cell(35,10,"Correo",1,0,'C',True);
    $pdf->Cell(30,10,"fecha venta",1,0,'C',True);
    $pdf->Cell(20,10,"Total clientes",1,0,'C',True);
    $pdf->Cell(25,10,"Total venta",1,0,'C',True);
    $pdf->Cell(25,10,"Estado",1,1,'C',True);

    include('../bd/conectar.php');

    $id = $_REQUEST['id'];
    
    $sql = mysqli_query($conexion, "SELECT * FROM ventas WHERE id_venta='$id'");
    
    while($datos = mysqli_fetch_array($sql)){
        $pdf->Cell(10,10,$datos['id_venta'],1,0,'C');
        $pdf->Cell(35,10,$datos['correo_usuario'],1,0,'C');
        $pdf->Cell(30,10,$datos['fecha_venta'],1,0,'C');
        $pdf->Cell(20,10,$datos['total_clientes'],1,0,'C');
        $pdf->Cell(25,10,$datos['total_venta'],1,0,'C');
        $pdf->Cell(25,10,$datos['estado_v'],1,1,'C');
    }
   
    $pdf->Output();
?>