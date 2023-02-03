<?php
	require('../../Plugin/fpdf/fpdf.php');
	include '../../conn.php';

	if (isset($_POST['btndisposal'])) {
		$DisposalCode = $_POST['DisposalCode'];
		
		$query = oci_parse($conn, "SELECT TBLASSET.ASSETCODE, TBLASSET.ASSETDESC, TBLINV.INVSERIAL, TBLINV.INVMODEL, TBLINV.YEAR, 
			TBLASSET.ASSETLOC, TBLINV.REASON, TBLINV.INVDATE
			 FROM TBLASSET INNER JOIN TBLINV ON TBLASSET.ASSETCODE = TBLINV.ASSETCODE 
			 WHERE INVTYPE = 'DISPOSAL' AND TBLINV.DELETED = 0 AND TBLINV.INVCODE = '".$DisposalCode."'
			"); 
		oci_execute($query);
		$row = oci_fetch_array($query);

		$date=date_create($row['INVDATE']);
		$dateinv =  date_format($date,"Ym");
			

		class PDF_reciept extends FPDF
	    {
	        function __construct($orientation = 'P', $unit = 'pt', $format = 'A4', $margin = 40)
	        {
	            parent::__construct($orientation, $unit, $format, $margin);
	            $this->SetTopMargin($margin);
	            $this->SetLeftMargin($margin);
	            $this->SetRightMargin($margin);
	            $this->SetAutoPageBreak(true, $margin);
	        }

	        function Header()
	        {
	        	$this->Image('Picture1.png', 42, 30, 90, 0, 'PNG');
	            $this->SetFont('Arial', 'B', 8);
	            // $this->SetFillColor(36, 96, 84);
	            // $this->SetTextColor(0);
	            $this->Cell(0, 40, "PT. Team Metal Indonesia", 0, 0, 'L', false);
	        }
	    }

	 	$pdf = new PDF_reciept();
    	$pdf->AddPage();

	    $pdf->SetFont('Arial', 'BU', 12);
	    $pdf->SetY(80);
	    $pdf->Cell(0, 0, "Asset Disposal Form", 0, 1, 'C', false);

	    $pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(120);
	    $pdf->Cell(170, 10, "Asset No");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10,  $row['ASSETCODE'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(140);
	    $pdf->Cell(170, 10, "Description");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  $row['ASSETDESC'], 'B', 'L', false);

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(160);
	    $pdf->Cell(170, 10, "Serial No");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  $row['INVSERIAL'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(180);
	    $pdf->Cell(170, 10, "Model No");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  $row['INVMODEL'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(200);
	    $pdf->Cell(170, 10, "Year Mfg");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10,  $row['YEAR'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(220);
	    $pdf->Cell(170, 10, "Original Dept");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10,  $row['ASSETLOC'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(240);
	    $pdf->Cell(170, 10, "Reason for Disposal");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  $row['REASON'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(300);
	    $pdf->Cell(120, 10, "Requested by,");
	    $pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10, "Received by,");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(100, 10, "Approved by,");

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(380);
	    $pdf->Cell(120, 10, "Dept HOD");
	    $pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10, "Dept HOD");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(100, 10, "Management");

	    $pdf->SetFont('Arial', '', 12); 
	    $pdf->SetTextColor(0); 
	    $pdf->SetY(400);
	    $pdf->Cell(0, 20, "", 'T', 0, 'C'); 

	    $pdf->SetFont('Arial', 'BIU', 11); 
	    $pdf->SetY(440);
	    $pdf->Cell(0, 0, "For Account Dept Only", 0, 0, 'L', false);


		$querydepr = oci_parse($conn, "SELECT TBLASSET.ASSERPODATE, TBLASSET.ATCOST, TBLASSETDEPR.MONTHID, TBLASSETDEPR.ASDACCAMT, 
			TBLASSETDEPR.ASDBOOKVALUE, TBLASSET.ATCOST - TBLASSETDEPR.ASDACCAMT AS GAINLOSE, TBLCATASSET.CATNAME
			FROM TBLASSET INNER JOIN TBLINV ON TBLASSET.ASSETCODE = TBLINV.ASSETCODE
			INNER JOIN TBLASSETDEPR ON TBLINV.ASSETCODE = TBLASSETDEPR.ASSETCODE
			INNER JOIN TBLCATASSET ON TBLASSET.ASSETCAT = TBLCATASSET.CATCODE 
			WHERE INVTYPE = 'DISPOSAL' AND TBLINV.DELETED = 0 AND TBLASSETDEPR.MONTHID = '".$dateinv."'
			 AND TBLINV.INVCODE = '".$DisposalCode."'
		 	"); 
		oci_execute($querydepr);
		$rows = oci_fetch_array($querydepr);

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(460);
	    $pdf->Cell(170, 10, "Date of Purchase");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10,  $rows['ASSERPODATE'], 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(480);
	    $pdf->Cell(170, 10, "Cost of Purchase");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  number_format($rows['ATCOST'],2,'.', ','), 'B', 'L', false);

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(500);
	    $pdf->Cell(170, 10, "Acc Depreciation");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  number_format($rows['ASDACCAMT'],2,'.', ','), 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(520);
	    $pdf->Cell(170, 10, "Net Book Value");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->MultiCell(300, 10,  number_format($rows['ASDBOOKVALUE'],2,'.', ','), 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(540);
	    $pdf->Cell(170, 10, "Gain/Loss of Disposal");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10,  number_format($rows['GAINLOSE'],2,'.', ','), 'B', 'L');

		$pdf->SetFont('Arial', '', 10);
	    $pdf->SetY(560);
	    $pdf->Cell(170, 10, "Asset Category");
	    $pdf->SetFont('Arial', 'B');
		$pdf->Cell(10, 10, ":");    
		$pdf->SetFont('Arial', '');
		$pdf->Cell(300, 10,  $rows['CATNAME'], 'B', 'L');

		$pdf->SetFont('Arial', '', 11); 
	    $pdf->SetY(600);
	    $pdf->Cell(0, 0, "Prepared by,", 0, 0, 'L', false);

	    $pdf->SetFont('Arial', '', 11); 
	    $pdf->SetY(680);
	    $pdf->Cell(0, 0, "Recorded Date :", 0, 0, 'L', false);

	    $pdf->Output();
	}
?>


