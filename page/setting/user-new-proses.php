<?php
    
    include '../../conn.php';
    
    if (isset($_POST['save'])) {
        $department = $_POST['DEPARTMENT'];
        $username = $_POST['USERNAME'];
        $password = $_POST['PASSWORD'];
        $role = $_POST['ROLE'];

        // if($password != $passwordconfirm){
        //     echo "<script type='text/javascript'>alert('Password yang anda masukkan tidak sama dengan password confirmation.!');document.location='register.php'</script>";
        // } else {
            $query = oci_parse($conn, "INSERT INTO TBLUSER(DEPARTMENT, USERNAME, PASSWORD, ROLE)
                    VALUES('" . $department . "', '" . $username . "', '" . $password . "', '".$role."')");
            $result = oci_execute($query);
            if ($result){
                echo "<script type='text/javascript'>alert('Success!');document.location='user.php'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error!');document.location='user.php'</script>";
            }
        // }


    }

