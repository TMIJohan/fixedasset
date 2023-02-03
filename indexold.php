<?php
    session_start();
    include 'conn.php';
    if(!isset($_SESSION['username'])) {
        header('Location: page-login.php');
    }
    $role  = $_SESSION['role'];
    $department = $_SESSION['department'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/tmi/minilogo.png">
    <!---->
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
           /*  min-height: 100vh; */
            display: flex | inline-block;
            justify-content: center;
            align-items: center;
            background: #2e2e44;
            overflow: hidden;
        }
        .digital-clock{
            position: relative;
            top : 150px;
            left: 330px;
            color: #fff;
            background: #2d2f41;
            width: 425px;
            padding: 20px 45px;
            box-shadow: 0 5px 25px rgba(14, 21, 37, 0.8);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .digital-clock:before{
            content: '';
            position: absolute;
            background: linear-gradient(45deg, #24ff6d, #2f93f1, #ff5e9a);
            background-size: 200% 200%;
            top: -5px;
            left: -5px;
            bottom: -5px;
            right: -5px;
            z-index: -1;
            filter: blur(40px);
            animation: glowing 10s ease infinite;
        }
        @keyframes glowing{
            0%{
                background-position: 0 50%;
            }
            50%{
                background-position: 100 50%;
            }
            100%{
                background-position: 0 50%;
            }
        }
        .time{
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hours, .dots, .minutes, .welcometext{
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            padding: 0 10px;
            line-height: 125px;
        }
        .hours, .minutes{
            font-size: 6.5em;
            width: 125px;
        }
        .dots{
            font-size: 5em;
            color: #929292;
        }
        .hours{
            background: -webkit-linear-gradient(90deg, #634dff, #5fd4ff);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
        .minutes{
            background: -webkit-linear-gradient(90deg, #ff5e9a, #ffb960);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
        .right-side{
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-left: 10px;
        }
        .period, .seconds{
            font-size: 1.2em;
            font-weight: 500;
        }
        .period{
            transform: translateY(-20px);
            background: -webkit-linear-gradient(90deg, #f7b63f, #faf879);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
        .seconds{
            transform: translateY(16px);
            background: -webkit-linear-gradient(90deg, #24ff6d, #2f93f1);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
        .calendar{
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.3em;
            font-weight: 500;
            margin-bottom: 5px;
            background: -webkit-linear-gradient(90deg, #ae4af6, #ff98d1);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }
        .day-name, .day-number, .year{
            margin-left: 8px;
        }
        /*.headernav{
            color: white;
            size: 10px;
        }*/
  </style>
</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <a href="index.php"><h3>Team Metal PT</span></h3></a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="index.php" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-app-store"></i><span class="nav-text">Transaction</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="page/asset/page-asset.php">Fixed Asset</a></li>
                        </ul>
                    </li>
                <?php 
                    if ($role == "admin") {
                ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/Supplier/page-supplier.php">Supplier</a></li>
                                <li><a href="page/Department/page-department.php">Department</a></li>
                                <li><a href="page/currency/page-currency.php">Currency</a></li>
                                <li><a href="page/cat-asset/page-cat-asset.php">Category Asset</a></li>
                                <li><a href="page/unit/page-unit.php">Unit</a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-layout-25"></i><span class="nav-text">Report</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/report/asset.php">Fixed Asset</a></li>
                            </ul>
                        </li> -->
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                            </a>
                            <ul aria-expanded="false">
                                <!-- <li><a href="page/register/register.php">Register</a></li> -->
                                <li><a href="page/setting/user.php">User</a></li>
                            </ul>
                        </li>
                <?php    
                    } elseif ($department == "AC"){
                ?>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-chart-bar-33"></i><span class="nav-text">Static Data</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/Supplier/page-supplier.php">Supplier</a></li>
                                <li><a href="page/Department/page-department.php">Department</a></li>
                                <li><a href="page/currency/page-currency.php">Currency</a></li>
                                <li><a href="page/cat-asset/page-cat-asset.php">Category Asset</a></li>
                                <li><a href="page/unit/page-unit.php">Unit</a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-layout-25"></i><span class="nav-text">Report</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="page/report/asset.php">Fixed Asset</a></li>
                            </ul>
                        </li> -->
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon icon-world-2"></i><span class="nav-text">Setting</span>
                            </a>
                            <ul aria-expanded="false">
                                <!-- <li><a href="page/register/register.php">Register</a></li> -->
                                <li><a href="page/setting/user.php">user</a></li>
                            </ul>
                        </li>
                <?php
                    }
                ?>
                    <li><a href="./page/qr/qr-generator.php">
                        <i class="fa fa-qrcode" aria-hidden="true"></i><span class="nav-text">Barcode</span>
                        </a>
                    </li>
                    <li><a href="page-logout.php">
                        <i class="fa fa-sign-out" aria-hidden="true"></i><span class="nav-text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-body">
            <!-- row -->
            <div class="container">
                <div class="digital-clock">
                    <div class="calendar">
                        <h4>Welcome Back <span><?php echo $_SESSION['username']?></span></h4>    
                    </div>                    
                    <div class="time">
                        <span class="hours">00</span>
                        <span class="dots">:</span>
                        <span class="minutes">00</span>
                        <div class="right-side">
                            <span class="period">AM/PM</span>
                            <span class="seconds">00</span>
                        </div>
                    </div>
                    <div class="calendar">
                        <span class="day-name">Day</span>,
                        <span class="day-number">00</span> &nbsp;
                        <span class="month-name">Month</span>
                        <span class="year">0000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; <?php echo date("Y"); ?><a href="#" target="_blank"></a> - TMI</p>
            </div>
        </div>
    </div>
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>
    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>
    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>
    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="./js/dashboard/dashboard-1.js"></script>
    <script>
        function clock(){
            var today = new Date();
            var hours = today.getHours();
            var minutes = today.getMinutes();
            var seconds = today.getSeconds();
            let period = "AM";

            //set the time period(AM/PM)
            if(hours >=12){
                period = "PM"
            }
            //set the 12 hour clock format
            hours = hours > 12 ? hours % 12 : hours;

            //add the 0 for the values lower than 10
            if(hours < 10){
                hours = "0" + hours;
            }

            if(minutes < 10){
                minutes = "0" + minutes;
            }

            if(seconds < 10){
                seconds = "0" + seconds;
            }

            document.querySelector(".hours").innerHTML = hours;
            document.querySelector(".minutes").innerHTML = minutes;
            document.querySelector(".seconds").innerHTML = seconds;
            document.querySelector(".period").innerHTML = period;
        }

        var updateClock = setInterval(clock, 1000);

        //Get the date in js

        var today = new Date();
        const daynumber = today.getDate();
        const year = today.getFullYear();
        const dayName = today.toLocaleString("default", {weekday: "long"});
        const monthname = today.toLocaleString("default", {month: "long"});

        document.querySelector(".day-name").innerHTML = dayName;
        document.querySelector(".day-number").innerHTML = daynumber;
        document.querySelector(".month-name").innerHTML = monthname;
        document.querySelector(".year").innerHTML = year;
    </script>
</body>
</html>