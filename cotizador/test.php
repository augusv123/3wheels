<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('app/recaptchalib.php'); 
$publickey = "6LdFbxcfAAAAAKL57cv7dQ5o413LGOq5HXp9ARnj";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $email;$comment;$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }
        if(isset($_POST['comment'])){
          $comment=$_POST['comment'];
        }
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '
Please check the the captcha form.
';
          exit;
        }
        $secretKey = "6LeIVhsfAAAAAPHxN8agigPxbpIXtloB4eDiAlir";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
       
        if($responseKeys["success"]) {
            header("Location: cotizar2.html");
        die();
        } else {
                header("Location: index2.html");
        die();
        }
}
   
?>

<html>
  <head>
    <title>Google recapcha demo - Codeforgeek</title>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-802895878"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-802895878'); </script> </head>
  <body>
    <h1>Google reCAPTHA Demo</h1>
    <form id="comment_form" action="test.php" method="post">
      <input type="email" placeholder="Type your email" size="40"><br><br>
      <textarea name="comment" rows="8" cols="39"></textarea><br><br>
      <input type="button" name="submit" onclick="javascript:enviar()" value="Post comment"><br><br>
      <div class="g-recaptcha" data-sitekey="6LeIVhsfAAAAAGBZ70fr18qZBFySZ0PCMlf4J8zh"></div>
    </form>
    
    <script>
        function enviar(){
         if (document.getElementById('g-recaptcha-response').value.trim() != '') {

                document.forms[0].submit();
            } else {

                alert('Verifique que no es un robot');
            }
        }
    </script>
  </body>
</html>