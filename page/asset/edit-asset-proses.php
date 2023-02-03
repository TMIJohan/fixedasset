<?php
    include '../../conn.php';


    session_start();
    $username = $_SESSION['username'];
    $role  = $_SESSION['role'];
    $department  = $_SESSION['department'];

    if ($role == "admin"){
        if(isset($_POST['save'])){
            /* $assetcategory = $_POST['assetcategory']; */
            $assetcode = $_POST['assetcode']; 
            $assetname = $_POST['assetname']; 
            $assetshortname = $_POST['assetshortname'];
            $assetlocation = $_POST['assetlocation']; 
            $assetdesc = $_POST['assetdesc']; 
            $assetqty = $_POST['assetqty'];
            $assetuseful = $_POST['assetuseful'];

            $assetsupplier = $_POST['assetsupplier']; 
            $assetform = $_POST['assetform']; 
            $assetmodel = $_POST['assetmodel'];
            $assetrefno = $_POST['assetrefno']; 
            $assetpono = $_POST['assetpono']; 
            $assetpodate = $_POST['assetpodate'];
            $assettransfer = $_POST['assettransfer']; 
            $assetremark = $_POST['assetremark'];

            $coaasset = $_POST['coaasset'];
            $coadepr = $_POST['coadepr'];
            $coadprexp = $_POST['coadprexp'];
            $amountusd = $_POST['amountusd'];
            $amountsgd = $_POST['amountsgd'];
            $atcost = $_POST['atcost'];
            $exchange = $_POST['exchange'];
            $deprrate = $_POST['deprrate'];

            $PHYSICALCHECK = $_POST['PHYSICALCHECK'];
            $PHYSICALACTION = $_POST['PHYSICALACTION'];
            $PHYSICALREMARK = $_POST['PHYSICALREMARK'];

            $assetcapex = $_POST['assetcapex'];
            $assetpic = $_POST['assetpic'];
            $assetproject = $_POST['assetproject'];

            //proses upload gambar
            $ekstensi_allowed = array('png', 'jpg', 'jpeg');
            $nama = $_FILES['uploadfoto']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['uploadfoto']['size'];
            $file_tmp = $_FILES['uploadfoto']['tmp_name'];
            if(in_array($ekstensi, $ekstensi_allowed) === true){
                move_uploaded_file($file_tmp, 'file/' . $nama);
            }

            $atcost = str_replace(',', '', $atcost);
            $atcost = str_replace('.00', '', $atcost);
            $amountusd = str_replace(',', '', $amountusd);
            $amountusd = str_replace('.00', '', $amountusd);
            $amountsgd = str_replace(',', '', $amountsgd);
            $amountsgd = str_replace('.00', '', $amountsgd);
            $exchange = str_replace(',', '', $exchange);
            $exchange = str_replace('.00', '', $exchange);

            $tinPeriod = 12;
            $sinMon = $assetuseful * $tinPeriod;
            $decOSAmt = $atcost;
            $sinCount = 1;
            $monthid = date("Ym", strtotime($assetpodate));
            $Var = substr($monthid, -2);
            $decAccAmt = 0;
            $varMonthID = $monthid;
            date_default_timezone_set('Asia/Jakarta');
            $curdatetime = date('d-m-Y H:i:s');


            
            $query = oci_parse($conn, "UPDATE TBLASSET SET ASSETNAME = '".$assetname."', ASSETSHORTNAME = '".$assetshortname."', ASSETLOC = '".$assetlocation."', ASSETDESC = '".$assetdesc."',
            QUANTITY = ".$assetqty.", USEFULL = ".$assetuseful.", ASSETSUPPLIER = '".$assetsupplier."', ASSETNO = '".$assetform."',
            ASSETMODEL = '".$assetmodel."', ASSETREFNO = '".$assetrefno."', ASSETPONO = '".$assetpono."', ASSERPODATE = DATE'".$assetpodate."', 
            TRANSFERCD = '".$assettransfer."', ASSETREMARK = '".$assetremark."', ASSETPHOTO = '".$nama."', ASSETCOA = '".$coaasset."',  ASSETDEPRCOA = '".$coadepr."', 
            ASSETDEPREXPCOA = '".$coadprexp."', AMOUNTUSD = ".$amountusd.", AMOUNTSGD = ".$amountsgd.", ATCOST = ".$atcost.", EXCHANGERATE = ".$exchange.", 
            DEPRRATE = ".$deprrate.", PHYSICALCHECK = '".$PHYSICALCHECK."', PHYSICALACTION = '".$PHYSICALACTION."', PHYSICALREMARK = '".$PHYSICALREMARK."', 
            ASSETCAPEX = '".$assetcapex."', PIC = '".$assetpic."', ASSETPROJECT = '".$assetproject."', 
            EDNAME = '".$username."', EDTIME = TO_DATE('".$curdatetime."', 'DD/MM/YYYY HH24:MI:SS') WHERE ASSETCODE = '".$assetcode."'");


            $result = oci_execute($query);
            if ($result){
                     echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error !');document.location='page-asset-new.php'</script>";
                }

            // if ($prosesasset) {
            //     $assetdepr = oci_parse($conn, "DELETE FROM TBLASSETDEPR WHERE ASSETCODE = '".$assetcode."'");
            //     oci_execute($assetdepr);

            //     // while ($sinCount <= $sinMon) {
            //     for ($sinCount=1; $sinCount <= $sinMon; $sinCount++){ 
            //         if ((($sinCount-1) % $tinPeriod) == 0) {
            //             $decDeprAmt = ($atcost / ($sinMon / $tinPeriod)) / $tinPeriod;
            //         }

            //         $decBookValue = $decOSAmt;
            //         if ($sinCount == $sinMon) {
            //             $decDeprAmt = $decOSAmt;
            //         }
            //         $decOSAmt = $decOSAmt - $decDeprAmt;
            //         $decAccAmt = $decAccAmt + $decDeprAmt;

            //         $asdStartAmt = $decOSAmt + $decDeprAmt;
            //         $asdbookvalue = ($asdStartAmt - $decDeprAmt);

    
            //         if (intval(substr($varMonthID, -2)) + 1 > $tinPeriod AND $sinCount > 1 ) {
            //             $varMonthID = strval(intval(substr($varMonthID, 0, 4)) + 1) . '01';
            //         } else {
            //             if ($sinCount > 1) {
            //                 $varMonthID = substr($varMonthID, 0,4) . substr('0' . strval(intval(substr($varMonthID, -2)) + 1), -2);
            //             }
            //         }

            //         $querydepr = oci_parse($conn, "INSERT INTO TBLASSETDEPR (ASSETCODE, MONTHID, ASDSTARTAMT, ASDDEPRAMT, ASDACCAMT, ASDBOOKVALUE)
            //             VALUES('".$assetcode."', '".$varMonthID."', ".$asdStartAmt.", ".$decDeprAmt.", ".$decAccAmt.",
            //                 ".$asdbookvalue.")");
            //         $result = oci_execute($querydepr);
            //     }    
            //     if ($result){
            //          echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            //     } else {
            //         echo "<script type='text/javascript'>alert('Error !');document.location='page-asset-new.php'</script>";
            //     }
            // }

        }

        if (isset($_POST['btnrunning'])) {
            $assetcode = $_POST['assetcode'];

            $query = oci_parse($conn, "UPDATE TBLASSET SET STATUS = 'RUNNING' WHERE ASSETCODE = '".$assetcode."'");
            $result = oci_execute($query);

            if ($result){
                //oci_commit($koneksi);
                echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            } else {
                //oci_rollback($koneksi);
                echo "<script type='text/javascript'>alert('Failed!');document.location='page-asset.php'</script>";
            }

        }
        if (isset($_POST['btnrevise'])) {
            $assetcode = $_POST['assetcode'];

            $query = oci_parse($conn, "UPDATE TBLASSET SET STATUS = 'REVISE' WHERE ASSETCODE = '".$assetcode."'");
            $result = oci_execute($query);

            if ($result){
                echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Failed!');document.location='page-asset.php'</script>";
            }

        }
    } elseif ($department == "AC"){
        if(isset($_POST['save'])){
            /* $assetcategory = $_POST['assetcategory']; */
            $assetcode = $_POST['assetcode']; 
            $assetname = $_POST['assetname']; 
            $assetshortname = $_POST['assetshortname'];
            $assetlocation = $_POST['assetlocation']; 
            $assetdesc = $_POST['assetdesc']; 
            $assetqty = $_POST['assetqty'];
            $assetunit = $_POST['assetunit']; 
            $assetcurrency = $_POST['assetcurrency']; 
            $assetuseful = $_POST['assetuseful'];

            $assetsupplier = $_POST['assetsupplier']; 
            $assetform = $_POST['assetform']; 
            $assetmodel = $_POST['assetmodel'];
            $assetrefno = $_POST['assetrefno']; 
            $assetpono = $_POST['assetpono']; 
            $assetpodate = $_POST['assetpodate'];
            $assettransfer = $_POST['assettransfer']; 
            $assetremark = $_POST['assetremark'];

            $coaasset = $_POST['coaasset'];
            $coadepr = $_POST['coadepr'];
            $coadprexp = $_POST['coadprexp'];
            $amountusd = $_POST['amountusd'];
            $amountsgd = $_POST['amountsgd'];
            $atcost = $_POST['atcost'];
            $exchange = $_POST['exchange'];
            $deprrate = $_POST['deprrate'];

            $PHYSICALCHECK = $_POST['PHYSICALCHECK'];
            $PHYSICALACTION = $_POST['PHYSICALACTION'];
            $PHYSICALREMARK = $_POST['PHYSICALREMARK'];

            $assetcapex = $_POST['assetcapex'];
            $assetpic = $_POST['assetpic'];
            $assetproject = $_POST['assetproject'];

            //proses upload gambar
            $ekstensi_allowed = array('png', 'jpg', 'jpeg');
            $nama = $_FILES['uploadfoto']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['uploadfoto']['size'];
            $file_tmp = $_FILES['uploadfoto']['tmp_name'];
            if(in_array($ekstensi, $ekstensi_allowed) === true){
                move_uploaded_file($file_tmp, 'file/' . $nama);
            }

            $atcost = str_replace(',', '', $atcost);
            $atcost = str_replace('.00', '', $atcost);
            $amountusd = str_replace(',', '', $amountusd);
            $amountusd = str_replace('.00', '', $amountusd);
            $amountsgd = str_replace(',', '', $amountsgd);
            $amountsgd = str_replace('.00', '', $amountsgd);
            $exchange = str_replace(',', '', $exchange);
            $exchange = str_replace('.00', '', $exchange);

            $tinPeriod = 12;
            $sinMon = $assetuseful * $tinPeriod;
            $decOSAmt = $atcost;
            $sinCount = 1;
            $monthid = date("Ym", strtotime($assetpodate));
            $Var = substr($monthid, -2);
            $decAccAmt = 0;
            $varMonthID = $monthid;
            date_default_timezone_set('Asia/Jakarta');
            $curdatetime = date('d-m-Y H:i:s');


            $query = oci_parse($conn, "UPDATE TBLASSET SET ASSETNAME = '".$assetname."', ASSETSHORTNAME = '".$assetshortname."', ASSETLOC = '".$assetlocation."', ASSETDESC = '".$assetdesc."',
            QUANTITY = ".$assetqty.", USEFULL = ".$assetuseful.", ASSETSUPPLIER = '".$assetsupplier."', ASSETNO = '".$assetform."',
            ASSETMODEL = '".$assetmodel."', ASSETREFNO = '".$assetrefno."', ASSETPONO = '".$assetpono."', ASSERPODATE = DATE'".$assetpodate."', 
            TRANSFERCD = '".$assettransfer."', ASSETREMARK = '".$assetremark."', ASSETPHOTO = '".$nama."', ASSETCOA = '".$coaasset."',  ASSETDEPRCOA = '".$coadepr."', 
            ASSETDEPREXPCOA = '".$coadprexp."', AMOUNTUSD = ".$amountusd.", AMOUNTSGD = ".$amountsgd.", ATCOST = ".$atcost.", EXCHANGERATE = ".$exchange.", 
            DEPRRATE = ".$deprrate.", PHYSICALCHECK = '".$PHYSICALCHECK."', PHYSICALACTION = '".$PHYSICALACTION."', PHYSICALREMARK = '".$PHYSICALREMARK."', 
            ASSETCAPEX = '".$assetcapex."', PIC = '".$assetpic."', ASSETPROJECT = '".$assetproject."', 
            EDNAME = '".$username."', EDTIME = TO_DATE('".$curdatetime."', 'DD/MM/YYYY HH24:MI:SS') WHERE ASSETCODE = '".$assetcode."'");

            $result = oci_execute($query);
            if ($result){
                     echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error !');document.location='page-asset-new.php'</script>";
                }

            // $prosesasset = oci_execute($query);

            // if ($prosesasset) {
            //     $assetdepr = oci_parse($conn, "DELETE FROM TBLASSETDEPR WHERE ASSETCODE = '".$assetcode."'");
            //     oci_execute($assetdepr);

            //     // while ($sinCount <= $sinMon) {
            //     for ($sinCount=1; $sinCount <= $sinMon; $sinCount++){ 
            //         if ((($sinCount-1) % $tinPeriod) == 0) {
            //             $decDeprAmt = ($atcost / ($sinMon / $tinPeriod)) / $tinPeriod;
            //         }

            //         $decBookValue = $decOSAmt;
            //         if ($sinCount == $sinMon) {
            //             $decDeprAmt = $decOSAmt;
            //         }
            //         $decOSAmt = $decOSAmt - $decDeprAmt;
            //         $decAccAmt = $decAccAmt + $decDeprAmt;

            //         $asdStartAmt = $decOSAmt + $decDeprAmt;
            //         $asdbookvalue = ($asdStartAmt - $decDeprAmt);

    
            //         if (intval(substr($varMonthID, -2)) + 1 > $tinPeriod AND $sinCount > 1 ) {
            //             $varMonthID = strval(intval(substr($varMonthID, 0, 4)) + 1) . '01';
            //         } else {
            //             if ($sinCount > 1) {
            //                 $varMonthID = substr($varMonthID, 0,4) . substr('0' . strval(intval(substr($varMonthID, -2)) + 1), -2);
            //             }
            //         }

            //         $querydepr = oci_parse($conn, "INSERT INTO TBLASSETDEPR (ASSETCODE, MONTHID, ASDSTARTAMT, ASDDEPRAMT, ASDACCAMT, ASDBOOKVALUE)
            //             VALUES('".$assetcode."', '".$varMonthID."', ".$asdStartAmt.", ".$decDeprAmt.", ".$decAccAmt.",
            //                 ".$asdbookvalue.")");
            //         $result = oci_execute($querydepr);
            //     }    
            //     if ($result){
            //          echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            //     } else {
            //         echo "<script type='text/javascript'>alert('Error !');document.location='page-asset-new.php'</script>";
            //     }
            // }

        }

        if (isset($_POST['btnrunning'])) {
            $assetcode = $_POST['assetcode'];

            $query = oci_parse($conn, "UPDATE TBLASSET SET STATUS = 'RUNNING' WHERE ASSETCODE = '".$assetcode."'");
            $result = oci_execute($query);

            if ($result){
                //oci_commit($koneksi);
                echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            } else {
                //oci_rollback($koneksi);
                echo "<script type='text/javascript'>alert('Failed!');document.location='page-asset.php'</script>";
            }

        }
        if (isset($_POST['btnrevise'])) {
            $assetcode = $_POST['assetcode'];

            $query = oci_parse($conn, "UPDATE TBLASSET SET STATUS = 'REVISE' WHERE ASSETCODE = '".$assetcode."'");
            $result = oci_execute($query);

            if ($result){
                //oci_commit($koneksi);
                echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            } else {
                //oci_rollback($koneksi);
                echo "<script type='text/javascript'>alert('Failed!');document.location='page-asset.php'</script>";
            }

        }
    } else {
        if(isset($_POST['save'])){
            $assetcode = $_POST['assetcode'];
            $PHYSICALCHECK = $_POST['PHYSICALCHECK'];
            $PHYSICALACTION = $_POST['PHYSICALACTION'];
            $PHYSICALREMARK = $_POST['PHYSICALREMARK'];
            date_default_timezone_set('Asia/Jakarta');
            $curdatetime = date('d-m-Y H:i:s');

            
            $query = oci_parse($conn, "UPDATE TBLASSET SET PHYSICALCHECK = '".$PHYSICALCHECK."', PHYSICALACTION = '".$PHYSICALACTION."', PHYSICALREMARK = '".$PHYSICALREMARK."', EDNAME = '".$username."', EDTIME = TO_DATE('".$curdatetime."', 'DD/MM/YYYY HH24:MI:SS') WHERE ASSETCODE = '".$assetcode."'");
            $result = oci_execute($query);

            if ($result){
                //oci_commit($koneksi);
                echo "<script type='text/javascript'>alert('Success!');document.location='page-asset.php'</script>";
            } else {
                //oci_rollback($koneksi);
                echo "<script type='text/javascript'>alert('Failed!');document.location='page-asset.php'</script>";
            }
            
        }
    }

    
?>