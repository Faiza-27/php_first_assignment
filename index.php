<?php
  error_reporting(0);
  $error="";
  if(isset($_POST["submit"])){
      $email=$_POST['email'];
      $pass=$_POST['pass'];
      $pass1=$_POST['pass'];
      if(empty($email) || empty($pass)){
        $error="*Required email and password";
      }
      else{
        if(is_dir("users/$email")){
          $fo=fopen("users/$email/details.txt","r");
          $lenn=1;
            while($lenn!=4){
              $ans= fgets($fo);
              $lenn++;
            }
            echo $ans;
          $password=substr(sha1(input_field($pass)),0,10);
          if(input_field($ans)==input_field($password)){
            session_start();
            $_SESSION['sid']=$email;
            $_SESSION['spass']=$pass;
            if(!empty($_POST['remember'])){
              setcookie("email",$email,time()+3600*24);
              setcookie("pass",$pass1,time()+3600*24);
            }
            header("location:dashboard.php");
          }
          else {
            $error="Enter correct email or password";
          }
      }
      else{
        $error="Not registered with this email";
      }
      }
  }//isset close

  function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Admin Panel</title>
    <style>
         .error1{
            color: red;
            margin-left: 46%;
            font-size: 20px;
        }
    </style>
  </head>
  <body>

    <div class="jumbotron mr-5 ml-5 text-center" style='background-color:#732C2C;color:white'>
        <h1 class="display-4">ADMIN PANEL</h1>
    </div>

 
    <form class="mr-5 ml-5" method="POST">
          <span class="text-success"> <?php echo $_GET['error'];?></span>
          <span class="error1"><?php 
            echo $error;
            ?>
            </span>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" onchange="autopass()" id="email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="pass">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check" name="remember">
            <label class="form-check-label" for="check">Check me out</label>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-warning">Reset</button>
          <a class="btn btn-info" href="register.php">New user? Register here</a>
          
  </form>
   
    <script>
      function autopass(){
        if("<?php echo $_COOKIE['email'];?>"!=undefined){
            if(document.getElementById("email").value=="<?php echo $_COOKIE['email'];?>"){
              document.getElementById('pass').value="<?php echo $_COOKIE['pass'];?>";
            }
            else{
              document.getElementById("pass").value="";
            }
          }
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>