<?php
    include '../../conn.php';
    $id = $_POST['id'];
    $modul = $_POST['modul'];

    if($modul=='AssetCOA'){
        $query = oci_parse($conn, "SELECT MS_SUB_ACNT_CODE, MS_SUB_ACNT_CODE || ' - ' || MS_SUB_ACNT_NAME AS MS_SUB_ACNT_NAME
            FROM TMS.FM_MAIN_SUB WHERE MS_MAIN_ACNT_CODE = '".$id."' ORDER BY MS_SUB_ACNT_CODE");
            oci_execute($query);
        $coaassetsub = '<option>SELECT ASSET SUB A/C CODE</option>';
        while ($dt = oci_fetch_array($query)){
            $coaassetsub = '<option value="' . $dt['MS_SUB_ACNT_CODE'] . '">' . $dt['MS_SUB_ACNT_NAME'] . '</option>';
        }
    echo $coaassetsub;
    }


?>