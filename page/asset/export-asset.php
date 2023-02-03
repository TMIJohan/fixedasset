<?php

	include '../../conn.php';
	header("Content-type:application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan Fixed Asset.xls");

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
	
?>

<!-- <h3>LAPORAN FIXED ASSET</h3> -->

<table border="1">
	<tr>
		<!-- <th style="text-align:center;">No</th> -->
		<th style="text-align:center;">ASSET NO</th>
		<th style="text-align:center;">DATE OF PURCHASE</th>
		<th style="text-align:center;">DESCRIPTION</th>
		<th style="text-align:center;">MODEL / SERIAL NO.</th>
		<th style="text-align:center;">QTY</th>
		<th style="text-align:center;">UNIT</th>
		<th style="text-align:center;">LOCATION / DEPT</th>
		<th style="text-align:center;">ASSET FORM</th>
		<th style="text-align:center;">REF NO.</th>
		<th style="text-align:center;">PO NO.</th>
		<th style="text-align:center;">SUPPLIER</th>
		<th style="text-align:center;">CURRENCY</th>
		<th style="text-align:center;">AMOUNT (USD)</th>
		<th style="text-align:center;">AMOUNT (SGD)</th>
		<th style="text-align:center;">AT COST (Rp)</th>
		<th style="text-align:center;">EXCHANGE RATE</th>
		<th style="text-align:center;">USEFUL LIFE (YEAR)</th>
		<th style="text-align:center;">DEPR.RATE (%)</th>
		<th style="text-align:center;">DEPR EXP PER MONTH</th>
		<th style="text-align:center;">PREVIOUS YEAR ACC DEPR <?php echo $lastyear ?></th>
		<th style="text-align:center;">NBV PREVIOUS YEAR <?php echo $lastyear ?></th>
		<th style="text-align:center;">Jan <?php echo $currentyear ?></th>
		<th style="text-align:center;">Feb <?php echo $currentyear ?></th>
		<th style="text-align:center;">Mar <?php echo $currentyear ?></th>
		<th style="text-align:center;">Apr <?php echo $currentyear ?></th>
		<th style="text-align:center;">Mei <?php echo $currentyear ?></th>
		<th style="text-align:center;">Jun <?php echo $currentyear ?></th>
		<th style="text-align:center;">Jul <?php echo $currentyear ?></th>
		<th style="text-align:center;">Ags <?php echo $currentyear ?></th>
		<th style="text-align:center;">Sep <?php echo $currentyear ?></th>
		<th style="text-align:center;">Oct <?php echo $currentyear ?></th>
		<th style="text-align:center;">Nov <?php echo $currentyear ?></th>
		<th style="text-align:center;">Des <?php echo $currentyear ?></th>
		<th style="text-align:center;">CURRENT YEAR DEPR EXP <?php echo $currentyear ?></th>
		<th style="text-align:center;">TOTAL ACC DEPR CURRENT YEAR <?php echo $currentyear ?></th>
		<th style="text-align:center;">CURRENT YEAR BOOK VALUE <?php echo $currentyear ?></th>
		<th style="text-align:center;">CATEGORY</th>
		<th style="text-align:center;">NO NBV</th>
		<th style="text-align:center;">ASSET ACCOUNT CODE</th>
		<th style="text-align:center;">ACC DEPR ACCOUNT CODE</th>
		<th style="text-align:center;">DEPR EXP ACCOUNT CODE</th>
		<th style="text-align:center;">TOTAL MTH DEPR</th>
		<th style="text-align:center;">BAL DEPR MTH</th>
		<th style="text-align:center;">CAPEX ACROTEC</th>
		<!-- <th style="text-align:center;">PROJECT</th> -->
		<th style="text-align:center;">PIC</th>
		<th style="text-align:center;">USER</th>
		<th style="text-align:center;">PHYSICAL CHECK FOR OCT 22 (V IF HAS, X IF DON'T HAVE)</th>
		<th style="text-align:center;">REMARK</th>
		<th style="text-align:center;">ACTION</th>
	</tr>
	<?php
		$NO = 1;
		// $query = oci_parse($conn, "SELECT
		// 	ASSETCODE, ASSERPODATE, ASSETDESC, ASSETMODEL, QUANTITY, UNIT, ASSETLOC,
		// 	ASSETNO, ASSETREFNO, ASSETPONO, ASSETSUPPLIER, CURRENCY, AMOUNTUSD, AMOUNTSGD,
		// 	ATCOST, EXCHANGERATE, USEFULL, CONCAT(DEPRRATE * 100, '%') AS DEPRRATE, ROUND(ATCOST*DEPRRATE,0)/12 AS DEPREXPPERMONTH,
		// 	PREVYEARACCDPR, NBVPREVYEAR, 0 AS CURRENTYEAR, 0 AS CURRENTYEARDEPR, 0 AS CURRENTYEARBOOKVALUE,
		// 	ASSETCAT, NONBV, ASSETPHYSICAL, ASSETREMARK, ASSETCOA, ASSETDEPRCOA, ASSETDEPREXPCOA,
		// 	CASE WHEN DEPRRATE <> 0 THEN (ATCOST/(ROUND(ATCOST*DEPRRATE,0)/12)) ELSE 0 END AS TOTALMTH, 0 AS BALDEPR, ASSETCAPEX,ASSETPROJECT, PIC, ASSETUSER, PHYSICALCHECK, PHYSICALREMARK, PHYSICALACTION
		// 	FROM TBLASSET WHERE trunc(ASSETDATE) BETWEEN to_date('".$fromdate."','MM-DD-YYYY') AND TO_DATE('".$todate."','MM-DD-YYYY')");
		// oci_execute($query);

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
		 ((SELECT ASDDEPRAMT FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$prevyearmonth."') / (SELECT ASDBOOKVALUE FROM TBLASSETDEPR WHERE ASSETCODE = TBLASSET.ASSETCODE AND MONTHID = '".$currentyearmonth."')) AS BALDEPRMTH, ASSETCAPEX, 
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

		while($rows = oci_fetch_array($queryresult)){
	?>
	<tr>
		<!-- <td style="text-align:center;"><?php echo $NO++?></td> -->
		<td style="text-align:center;"><?php echo $rows['ASSETCODE'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSERPODATE'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETDESC'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETMODEL'] ?></td>
		<td style="text-align:center;"><?php echo $rows['QUANTITY'] ?></td>
		<td style="text-align:center;"><?php echo $rows['UOM'] ?></td>
		<td style="text-align:center;"><?php echo $rows['DEPT_NAME'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETNO'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETREFNO'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETPONO'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETSUPPLIER'] ?></td>
		<td style="text-align:center;"><?php echo $rows['CURRENCY'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['AMOUNTUSD'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['AMOUNTSGD'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['ATCOST'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['EXCHANGERATE'] ?></td>
		<td style="text-align:center;"><?php echo $rows['USEFULL'] ?></td>
		<td style="text-align:center;"><?php echo $rows['DEPRRATE'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['DEPREXPPERMONTH'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['PREVYEARACCDPR'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['NBVPREVYEAR'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['JAN'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['FEB'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['MAR'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['APR'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['MEI'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['JUN'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['JUL'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['AGS'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['SEP'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['OCT'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['NOV'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['DES'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['CURYEARDEPR'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['CURRENTDEPR'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['CURRENTYEAR'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETCAT'] ?></td>
		<td style="text-align:center;"><?php echo $rows['NONBV'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETCOA'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETDEPRCOA'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETDEPREXPCOA'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['TOTMTH'] ?></td>
		<td style="text-align:center;"><?php echo number_format($rows['BALDEPRMTH']?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETCAPEX'] ?></td>
		<!-- <td style="text-align:center;"><?php echo $rows['ASSETPROJECT'] ?></td> -->
		<td style="text-align:center;"><?php echo $rows['PIC'] ?></td>
		<td style="text-align:center;"><?php echo $rows['ASSETUSER'] ?></td>
		<td style="text-align:center;"><?php echo $rows['PHYSICALCHECK'] ?></td>
		<td style="text-align:center;"><?php echo $rows['PHYSICALREMARK'] ?></td>
		<td style="text-align:center;"><?php echo $rows['PHYSICALACTION'] ?></td>
	</tr>	
	<?php
		}
	?>
</table>