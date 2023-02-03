<?php
    include "../../conn.php";
    require('../../vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if(isset($_POST['import'])){
        $err = "";
        $ekstansi = "";
        $success = "";

        $file_name = $_FILES['fileimport']['name'];
        $file_data = $_FILES['fileimport']['tmp_name'];

        if(empty($file_name)){
            $err .= "Silahkan Pilih File Excel!!";
        } else {
            $ekstansi = pathinfo($file_name)['extension'];
        }

        $extensi_allowed = array("xls", "xlsx");
        if(!in_array($ekstansi, $extensi_allowed)){
            $err .= "Silahkan masukkan file type xls, xlsx";
        }
        if(empty($err)){
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
            $spreadsheet = $reader->load($file_data);
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();

            $jumlahdata = 0;
            for($i=1;$i<count($sheetdata);$i++){
                $ASSETCAT = $sheetdata[$i]['0'];
                $ASSETCODE = $sheetdata[$i]['1'];
                $ASSETNAME = $sheetdata[$i]['2'];
                $ASSETSHORTNAME = $sheetdata[$i]['3'];
                $ASSERPODATE = $sheetdata[$i]['4'];
                $NEWDATE = str_replace('/', '-',$sheetdata[$i]['4']);
                $DATEASSET = date('Ym', strtotime($NEWDATE));
                $ASSETDESC = $sheetdata[$i]['5'];
                $ASSETMODEL = $sheetdata[$i]['6'];
                    if($ASSETMODEL == null){
                        $ASSETMODEL = "-";
                    }
                $QUANTITY = $sheetdata[$i]['7'];
                    if($QUANTITY == null){
                        $QUANTITY = 0;
                    }
                $UNIT = $sheetdata[$i]['8'];
                    if($UNIT == null){
                        $UNIT = "-";
                    }
                $ASSETLOC = $sheetdata[$i]['9'];
                    if($ASSETLOC == null){
                    $ASSETLOC = "-";
                    }
                $ASSETNO = $sheetdata[$i]['10'];
                if($ASSETNO == null){
                    $ASSETNO = "-";
                    }
                $ASSETREFNO = $sheetdata[$i]['11'];
                if($ASSETREFNO == null){
                    $ASSETREFNO = "-";
                    }
                $ASSETPONO = $sheetdata[$i]['12'];
                if($ASSETPONO == null){
                    $ASSETPONO = "-";
                    }
                $ASSETSUPPLIER = $sheetdata[$i]['13'];
                if($ASSETSUPPLIER == null){
                    $ASSETSUPPLIER = "-";
                    }
                $CURRENCY = $sheetdata[$i]['14'];
                if($CURRENCY == null){
                    $CURRENCY = "-";
                    }
                $AMOUNTUSD = $sheetdata[$i]['15'];
                if($AMOUNTUSD == null){
                    $AMOUNTUSD = 0;
                }
                $AMOUNTSGD = $sheetdata[$i]['16'];
                if($AMOUNTSGD == null){
                    $AMOUNTSGD = 0;
                }
                $ATCOST = $sheetdata[$i]['17'];
                if($ATCOST == null){
                    $ATCOST = 0;
                }
                $EXCHANGERATE = $sheetdata[$i]['18'];
                if($EXCHANGERATE == null){
                    $EXCHANGERATE = 1;
                }
                $USEFULL = $sheetdata[$i]['19'];
                if($USEFULL == null){
                    $USEFULL = 0;
                }
                $DEPRRATE = $sheetdata[$i]['20'];
                if($DEPRRATE == null){
                    $DEPRRATE = 0;
                }
                $NONBV = $sheetdata[$i]['21'];
                if($NONBV == null){
                    $NONBV = 0;
                }
                $ASSETCOA = $sheetdata[$i]['22'];
                if($ASSETCOA == null){
                    $ASSETCOA = "-";
                    }
                $ASSETDEPRCOA = $sheetdata[$i]['23'];
                if($ASSETDEPRCOA == null){
                    $ASSETDEPRCOA = "-";
                    }
                $ASSETDEPREXPCOA = $sheetdata[$i]['24'];
                if($ASSETDEPREXPCOA == null){
                    $ASSETDEPREXPCOA = "-";
                    }
                $ASSETCAPEX = $sheetdata[$i]['25'];
                if($ASSETCAPEX == null){
                    $ASSETCAPEX = "-";
                    }
                $PIC = $sheetdata[$i]['26'];
                if($PIC == null){
                    $PIC = "-";
                    }
                $ASSETUSER = $sheetdata[$i]['27'];
                if($ASSETUSER == null){
                    $ASSETUSER = "-";
                    }
                $PHYSICALCHECK = $sheetdata[$i]['28'];
                if($PHYSICALCHECK == null){
                    $PHYSICALCHECK = "-";
                    }
                $PHYSICALREMARK = $sheetdata[$i]['29'];
                if($PHYSICALREMARK == null){
                    $PHYSICALREMARK = "-";
                    }
                $PHYSICALACTION = $sheetdata[$i]['30'];
                if($PHYSICALACTION == null){
                    $PHYSICALACTION = "-";
                    }

                    $tinPeriod = 12;
                    $sinMon = $USEFULL * $tinPeriod;
                    $decOSAmt = $ATCOST;
                    $sinCount = 1;
                    // $monthid = date("Ym", strtotime($ASSERPODATE));
                    // $Var = substr($monthid, -2);
                    $decAccAmt = 0;
                    $varMonthID = $DATEASSET;                   

                 
                if ($ASSETCODE) {
                    try {
                        $query = oci_parse($conn, "INSERT INTO TBLASSET (ASSETCAT, ASSETCODE, ASSETNAME, ASSETSHORTNAME, ASSETDATE, ASSERPODATE, ASSETDESC, ASSETMODEL, QUANTITY, UNIT, ASSETLOC, ASSETNO, ASSETREFNO, ASSETPONO, ASSETSUPPLIER, CURRENCY, AMOUNTUSD, AMOUNTSGD, ATCOST, EXCHANGERATE, USEFULL, DEPRRATE,NONBV, ASSETCOA, ASSETDEPRCOA, ASSETDEPREXPCOA, ASSETCAPEX, PIC, ASSETUSER, PHYSICALCHECK, PHYSICALREMARK, PHYSICALACTION)
                        VALUES('".$ASSETCAT."', '".$ASSETCODE."', '".$ASSETNAME."', '".$ASSETSHORTNAME."', TO_DATE('" . date('d/m/Y') . "','DD.MM.YYYY'), 
                            TO_DATE('" . $ASSERPODATE . "','DD.MM.YYYY'), '".$ASSETDESC."', '".$ASSETMODEL."', ".$QUANTITY.", '".$UNIT."', '".$ASSETLOC."', 
                            '".$ASSETNO."','".$ASSETREFNO."', '".$ASSETPONO."', '".$ASSETSUPPLIER."', '".$CURRENCY."', ".$AMOUNTUSD.", ".$AMOUNTSGD.", 
                            ".$ATCOST.", ".$EXCHANGERATE.",".$USEFULL.", ".$DEPRRATE.", ".$NONBV.", '".$ASSETCOA."', '".$ASSETDEPRCOA."',                      
                            '".$ASSETDEPREXPCOA."','".$ASSETCAPEX."', '".$PIC."', '".$ASSETUSER."', '".$PHYSICALCHECK."', '".$PHYSICALREMARK."', 
                            '".$PHYSICALACTION."')");
                        $result = oci_execute($query);
                        if ($result) {
                            if ($USEFULL > 0 ) {
                                $assetdepr = oci_parse($conn, "DELETE FROM TBLASSETDEPR WHERE ASSETCODE = '".$ASSETCODE."'");
                                oci_execute($assetdepr);

                                for ($sinCount=1; $sinCount <= $sinMon; $sinCount++) { 
                                    if ((($sinCount-1) % $tinPeriod) == 0) {
                                        $decDeprAmt = ($ATCOST / ($sinMon / $tinPeriod)) / $tinPeriod;
                                    }

                                    $decBookValue = $decOSAmt;
                                    if ($sinCount == $sinMon) {
                                        $decDeprAmt = $decOSAmt;
                                    }
                                    $decOSAmt = $decOSAmt - $decDeprAmt;
                                    $decAccAmt = $decAccAmt + $decDeprAmt;

                                    $asdStartAmt = $decOSAmt + $decDeprAmt;
                                    $asdbookvalue = ($asdStartAmt - $decDeprAmt);

                        
                                    if (intval(substr($varMonthID, -2)) + 1 > $tinPeriod AND $sinCount > 1 ) {
                                        $varMonthID = strval(intval(substr($varMonthID, 0, 4)) + 1) . '01';
                                    } else {
                                        if ($sinCount > 1) {
                                            $varMonthID = substr($varMonthID, 0,4) . substr('0' . strval(intval(substr($varMonthID, -2)) + 1), -2);
                                        }
                                    }


                                    
                                     $querydepr = oci_parse($conn, "INSERT INTO TBLASSETDEPR (ASSETCODE, MONTHID, ASDSTARTAMT, ASDDEPRAMT, ASDACCAMT, ASDBOOKVALUE)
                                    VALUES('".$ASSETCODE."', '".$varMonthID."', ".$asdStartAmt.", ".$decDeprAmt.", ".$decAccAmt.",
                                    ".$asdbookvalue.")");
                                    $resultdepr = oci_execute($querydepr);
                                    // if ($resultdepr) {
                                    //     echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
                                    // } 
                                    // else {
                                    //     echo "<script type='text/javascript'>alert('Error !');document.location='page-asset-new.php'</script>";
                                    // }                            
                                }
                            }
                            // echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";

                        }

                    } catch (Exception $e) {
                        // echo "Error: {$error->getMessage()}";
                        // echo "<script type='text/javascript'>alert('Error !');document.location='page-asset-new.php'</script>";
                    }
                     

                    
                }
            }
        }
    }

?>