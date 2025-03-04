<?php
 session_start();
 session_unset();
 function cleanText($texto){return preg_replace('([^A-Za-z0-9@áéíóúÁÉÍÓÚ! ])', '', $texto);};

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user =cleanText($_POST['user']);
    $pass =cleanText($_POST['pass']);
    if($user=="admin" && $pass=="horacio22!"){
        $_SESSION["usuario"]="admin";
        // header("Location: https://3wheels.com.ar/cotizador/admin/reservas.php");
        header("Location: http://localhost/3wheels/cotizador/admin/reservas.php");
        die();
    };
  };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - 3wheels</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <style>
        #auth-left{
        height: 100% !important;
        display: flex;
        flex-direction: column;
        justify-content: center;
        }
        @keyframes backInDown {
        from {transform: scale3d(1, 1, 1);}
        50% {transform: scale3d(1.05, 1.05, 1.05);}
        to {transform: scale3d(1, 1, 1);}
        }
        .backInDown {
        animation: backInDown 1s linear;
        }
    </style>
<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-802895878"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-802895878'); </script> </head>
<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-7 d-none d-lg-block">        
            <div id="auth-right" style="display: flex;justify-content:center;align-items:center;background-color:#5aa5e6;"  >
                <img src="https://3wheels.com.ar/img/logo-pie.png" style="height:4rem" class="backInDown">
            </div>
        </div>
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">Log in.   </h1>
                <form action="login.php" method="POST">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" required placeholder="usuario" name="user">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" required placeholder="password" name="pass">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in.   </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>


