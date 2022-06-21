<?php
    require('FPDF/fpdf.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        // Logo
        
        // Arial bold 15
        $this->SetFont('Arial','B',20);
        // Movernos a la derecha
        $this->Cell(1,0);
        //color

        
        $this->SetTextColor(255,165,0);
        // Título
        $this->Cell(190,20,'Reporte de las Categorias',1,0,'C',true);
        $this->Image('logo.jpg',10,10,20);
        // Salto de línea
        $this->Ln(25);


        $this->SetTextColor(0,0,0);
        $this->SetFillColor(255,165,0);
        

        $this->SetFont('Arial','',12);
        $this->Cell(70, 10, "",0,0,'C',false);
        $this->Cell(10, 10, 'ID',1,0,'C',true);
        $this->Cell(50, 10, 'CATEGORIAS',1,1,'C',true);

    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    include_once '../negocios/Negocios_Categorias.php';
    $datosCategorias = N_mostrar_categorias();
    

    $pdf = new PDF();
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $i = 1;
    foreach($datosCategorias as $categorias){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(200,200,200);
        }

        $pdf->Cell(70, 10, "",0,0,'C',false);
        $pdf->Cell(10, 10, $categorias['cat_id'],1,0,'C',true);
        $pdf->Cell(50, 10, $categorias['cat_descripcion'],1,1,'C',true);

        $i++;
    }

    $pdf->Output();




?>