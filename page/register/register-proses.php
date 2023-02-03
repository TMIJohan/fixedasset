<?php
    
    include '../../conn.php';
    error_reporting(0);

    session_start();
    

    if (isset($_POST['btnsumbit'])) {
        $department = $_POST['val-skill'];
        $username = $_POST['val-username'];
        $password = $_POST['val-password'];
        $passwordconfirm = $_POST['val-password2'];

        if($password != $passwordconfirm){
            echo "<script type='text/javascript'>alert('Password yang anda masukkan tidak sama dengan password confirmation.!');document.location='register.php'</script>";
        } else {
            $query = oci_parse($conn, "INSERT INTO TBLUSER(DEPARTMENT, USERNAME, PASSWORD)
                    VALUES('" . $department . "', '" . $username . "', '" . $password . "')");
            $result = oci_execute($query);
            if ($result){
                echo "<script type='text/javascript'>alert('Success!');document.location='register.php'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error!');document.location='register.php'</script>";
            }
        }


    }

