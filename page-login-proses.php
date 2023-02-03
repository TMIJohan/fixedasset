<?php
    session_start();
    include 'conn.php';

    if(isset($_POST['btnlogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            echo "Silahkan masukkan username dan password";
        } else {
            $query = oci_parse($conn, "SELECT USERNAME, PASSWORD, DEPARTMENT, ROLE FROM TBLUSER WHERE USERNAME = '".$username."' AND PASSWORD = '".$password."'");
            oci_execute($query);
            $r = oci_fetch_array($query);
            if ($r) {
                $_SESSION['username'] = $r['USERNAME'];
                $_SESSION['department'] = $r['DEPARTMENT'];
                $_SESSION['role'] = $r['ROLE'];
                header("Location: index.php");
            } else {
                echo "<script type='text/javascript'>alert('Username atau Password Salah');document.location='page-login.php'</script>";
            }
        }
    }
?>