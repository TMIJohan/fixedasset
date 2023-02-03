<?php
	function generateRow(){
		$contents = '';
		include '../../conn.php';
		$fromdate = date("m/d/Y", strtotime($_POST['fromdate']));;
    	$todate = date("m/d/Y", strtotime($_POST['todate']));;
    	$category = $_POST['category'];
    	$location = $_POST['location'];
    	$currency = $_POST['currency'];
    	$lastyear = date('Y', strtotime('last year'));
	    $lastmonth = date('m', strtotime('last month'));
	    $prevyearmonth = $lastyear.$lastmonth;
	    $currentyear = date("Y");
	    $currentyearmonth = $currentyear.$lastmonth;
	    $jan = '01';
	    $feb = '02';
	    $mar = '03';
	    $apr = '04';
	    $mei = '05';
	    $jun = '06';
	    $jul = '07';
	    $ags = '08';
	    $sep = '09';
	    $oct = '10';
	    $nov = '11';
	    $des = '12';
    	$no = 1;

		$query = "SELECT ASSETCAT, ASSETCODE, ASSETDATE, ASSERPODATE, ASSETDESC, ASSETMODEL, ASSETNAME, QUANTITY, UNIT AS UOM, 
		ASSETLOC AS DEPT_NAME, ASSETNO, ASSETREFNO, ASSETPONO, ASSETSUPPLIER, CURRENCY, AMOUNTUSD, AMOUNTSGD, ATCOST, EXCHANGERATE, USEFULL,
        CONCAT(DEPRRATE * 100, '%') AS DEPRRATE, 
        (SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$prevyearmonth."') AS DEPREXPPERMONTH, 
        (SELECT ASDBOOKVALUE FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$prevyearmonth."') AS PREVYEARACCDPR,
		(SELECT ASDACCAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$prevyearmonth."') AS NBVPREVYEAR,
		
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$jan."') AS JAN,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$feb."') AS FEB,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$mar."') AS MAR,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$apr."') AS APR,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$mei."') AS MEI,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$jun."') AS JUN,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$jul."') AS JUL,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$ags."') AS AGS,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$sep."') AS SEP,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$oct."') AS OCT,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$nov."') AS NOV,
		(SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyear.$des."') AS DES,

		(SELECT (ASDDEPRAMT * 12) FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyearmonth."') AS CURYEARDEPR,
		(SELECT ASDACCAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyearmonth."') AS CURRENTDEPR,
		(SELECT ASDBOOKVALUE FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyearmonth."') AS CURRENTYEAR,
		NONBV, ASSETCOA, ASSETDEPRCOA, ASSETDEPREXPCOA, 
		(ATCOST / (SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$prevyearmonth."')) AS TOTMTH,
		PIC, ASSETUSER, PHYSICALCHECK, PHYSICALREMARK, PHYSICALACTION 
        FROM TBLASSET WHERE 
        trunc(ASSERPODATE) BETWEEN to_date('".$fromdate."','MM-DD-YYYY') AND TO_DATE('".$todate."','MM-DD-YYYY')
        ";

        if ($category != "-") {
        	$filcat = " AND ASSETCAT = '".$category."'";
        } else {
        	$filcat = " ";
        }

        if ($location != "-") {
        	$filloc = " AND ASSETLOC = '".$location."'";
        } else {
        	$filloc = " ";
        }

        if ($currency != "-") {
        	$filcur = " AND CURRENCY = '".$currency."'";
        } else {
        	$filcur = " ";
        }

        $queryresult = oci_parse($conn, $query.$filcat.$filloc.$filcur." ORDER BY TBLASSET.ASSETCODE ASC");       

        oci_execute($queryresult);

        while($rows = oci_fetch_assoc($queryresult)){
        	$contents .= "
        	<tr>
        		<td>".$no++."</td>
        		<td>".$rows['ASSETCODE']."</td>
        		<td>".$rows['ASSERPODATE']."</td>
        		<td>".$rows['ASSETDESC']."</td>
        		<td>".$rows['ASSETMODEL']."</td>
        		<td>".$rows['QUANTITY']."</td>
        		<td>".$rows['UOM']."</td>
        		<td>".$rows['DEPT_NAME']."</td>
        		<td>".$rows['ASSETNO']."</td>
        		<td>".$rows['ASSETREFNO']."</td>
        		<td>".$rows['ASSETPONO']."</td>
        		<td>".$rows['ASSETSUPPLIER']."</td>
        		<td>".$rows['CURRENCY']."</td>
        		<td>".number_format($rows['AMOUNTUSD'],2,".")."</td>
        		<td>".number_format($rows['AMOUNTSGD'],2,".")."</td>
        		<td>".number_format($rows['ATCOST'],2,".")."</td>
        		<td>".number_format($rows['EXCHANGERATE'],2,".")."</td>
        		<td>".$rows['USEFULL']."</td>
        		<td>".$rows['DEPRRATE']."</td>
        		<td>".number_format($rows['DEPREXPPERMONTH'],2,".")."</td>
        		<td>".number_format($rows['PREVYEARACCDPR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>

        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."></td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>
        		<td>".number_format($rows['NBVPREVYEAR'],2,".")."</td>

        		<td>".number_format($rows['CURYEARDEPR'],2,".")."</td>
        		<td>".number_format($rows['CURRENTDEPR'],2,".")."</td>
        		<td>".number_format($rows['CURRENTYEAR'],2,".")."</td>
        		<td>".$rows['NONBV']."</td>
        		<td>".$rows['ASSETCOA']."</td>
        		<td>".$rows['ASSETDEPRCOA']."</td>
        		<td>".$rows['ASSETDEPREXPCOA']."</td>
        		<td>".number_format($rows['TOTMTH'],2,".")."</td>
        		<td>".$rows['PIC']."</td>
        		<td>".$rows['ASSETUSER']."</td>
        		<td>".$rows['PHYSICALCHECK']."</td>
        		<td>".$rows['PHYSICALREMARK']."</td>
        		<td>".$rows['PHYSICALACTION']."</td>
        	</tr>
        	";
        }
        return $contents;
	}
 
	require_once('../../Plugin/tcpdf/tcpdf.php');
	$fromdate = date("m/d/Y", strtotime($_POST['fromdate']));;
    $todate = date("m/d/Y", strtotime($_POST['todate']));;
    $prevyear = date("Y",strtotime("-1 year"));
    $currentyear = date("Y");

	$pdf = new TCPDF('L', 'cm', 'A3', true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetTitle("Report Fixed Asset");
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont('times');
	$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetMargins('0.5', '1', '5', '1');
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->SetAutoPageBreak(true, 8);
	$pdf->SetFont('times', '', 8);
	$pdf->AddPage();
	$content = '';
	$content .= '
	<style>
		tr{
			page-break-inside: avoid;
		}
		td{
			page-break-inside: avoid;	
		}
		table{
			border-color: red yellow green transparent;
		}
		td{
			text-align: center;
			word-wrap: break-word;
		}
	</style>
		<h1 align="center">Report Fixed Asset</h1>
		<h4 align="center">Periode : '.$fromdate." S/D ".$todate.'</h2>
		<table border="1" cellspacing="0" cellpadding="1">
			<tr>
				<th width="2%" style="text-align:center; font-weight: bold;">No</th>
				<th width="3%" style="text-align:center; font-weight: bold;">ASSET NO</th>
				<th width="2.5%" style="text-align:center; font-weight: bold;">DATE OF PURCH</th>
				<th width="8%" style="text-align:center; font-weight: bold;">DESC</th>
				<th width="3%" style="text-align:center; font-weight: bold;">MODEL / SERIAL NO.</th>
				<th width="2%" style="text-align:center; font-weight: bold;">QTY</th>
				<th width="2.5%" style="text-align:center; font-weight: bold;">UNIT</th>
				<th width="2%" style="text-align:center; font-weight: bold;">LOC / DEPT</th>
				<th width="2.5%" style="text-align:center; font-weight: bold;">ASSET FORM</th>
				<th width="2.5%" style="text-align:center; font-weight: bold;">REF NO.</th>
				<th width="2%" style="text-align:center; font-weight: bold;">PO NO.</th>
				<th width="3%" style="text-align:center; font-weight: bold;">SUPPLIER</th>
				<th width="2.5%" style="text-align:center; font-weight: bold;">CURRENCY</th>
				<th width="3%" style="text-align:center; font-weight: bold;">AMOUNT(USD)</th>
				<th width="3%" style="text-align:center; font-weight: bold;">AMOUNT(SGD)</th>
				<th width="3%" style="text-align:center; font-weight: bold;">AT COST(Rp)</th>
				<th width="2.5%" style="text-align:center; font-weight: bold;">EXCHANGE RATE</th>
				<th width="2%" style="text-align:center; font-weight: bold;">USEFUL LIFE (YEAR)</th>
				<th width="2%" style="text-align:center; font-weight: bold;">DEPR.RATE (%)</th>
				<th width="3%" style="text-align:center; font-weight: bold;">DEPR/MONTH</th>
				<th width="3.5%" style="text-align:center; font-weight: bold;">PREVIOUS YEAR ACC DEPR '.$prevyear.'</th>
				<th width="3%" style="text-align:center; font-weight: bold;">NBV PREVIOUS YEAR '.$prevyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Jan '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Feb '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Mar '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Apr '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Mei '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Jun '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Jul '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Ags '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Sep '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Okt '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Nov '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">Des '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">CURRENT YEAR DEPR EXP '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">TOTAL ACC DEPR CURRENT YEAR '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">CURRENT YEAR BOOK VALUE '.$currentyear.'</th>
				<th width="2%" style="text-align:center; font-weight: bold;">NO NBV</th>
				<th width="2%" style="text-align:center; font-weight: bold;">ACC CD</th>
				<th width="2%" style="text-align:center; font-weight: bold;">ACC DEPR CD</th>
				<th width="2%" style="text-align:center; font-weight: bold;">DEPR EXP ACC CD</th>
				<th width="2%" style="text-align:center; font-weight: bold;">TOT MTH DEPR</th>
				<th width="2%" style="text-align:center; font-weight: bold;">PIC</th>
				<th width="2%" style="text-align:center; font-weight: bold;">USER</th>
				<th width="2%" style="text-align:center; font-weight: bold;">PHYSICAL CHECK</th>
				<th width="2%" style="text-align:center; font-weight: bold;">REMARK</th>
				<th width="2%" style="text-align:center; font-weight: bold;">ACTION</th>
			</tr>
	';
	$content .= generateRow();
	$content .= '</table>';
	$pdf->writeHTML($content);
	$pdf->Output('reportasset.php', 'I');
?>