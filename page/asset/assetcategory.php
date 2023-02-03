<?php
    include '../../conn.php';

    $id = $_POST['id'];
    $getlastcode = oci_parse($conn, "SELECT MAX(ASSETCODE) AS ASSETCODE FROM TBLASSET WHERE ASSETCAT = '" . $id . "'");
    oci_execute($getlastcode);
    $data = oci_fetch_array($getlastcode);
    $code = $data['ASSETCODE'];
    $Lenghtcode = strlen($assetcategory);
    $last = (int) substr($code, $Lenghtcode);
    $last++;
    $assetcode = $assetcategory . sprintf("%04s", $last);
    echo $assetcode;
?>