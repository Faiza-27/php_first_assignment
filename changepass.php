<?php
  error_reporting(0);
  $password= $_SESSION['spass'];
  $email= $_SESSION['sid'];
  $error=$conpassError=$opassError=$passError="";
  if(isset($_POST["submit"])){
      $opass=input_field($_POST['opass']);
      $pass=input_field($_POST['pass']);
      $conpass=input_field($_POST['conpass']);
      if(empty($opass)){
        $opassError="*Old password required";
      }
      if(empty($pass)){
        $passError="*New password required";
      }
      if(empty($conpass)){
        $conpassError="*Confirmed password required";
      } 
      else{
          if($opass!=$password){
            $error="*Old password does not match";
          }
          else if($pass==$opass){
                $error="*New Password is same as old";
          }
          else if($pass!=$conpass){
                    $error="*Enter same password in confirmation box";
          }
          else{
            if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$pass)){
              $error="*Must be a minimum of 8 characters, contain at least 1 number, contain at least one uppercase character and contain at least one lowercase character";
            }
          }
      }
      if(empty($passError) && empty($conpassError) && empty($opassError) && empty($error)){    
              $fo=fopen("users/$email/details.txt","r+");
              $fn=fopen("users/$email/details1.txt","a+");
              $i=1;
              while($i!=3){
                  fwrite($fn,fgets($fo));
                  $i++;
              }
              $newpass=substr(sha1($pass),0,10);
              fwrite($fn,$newpass."\n");
              fwrite($fn,$pass."\n");
              fgets($fo);
              fgets($fo);
              while(!feof($fo)){
                fwrite($fn,fgets($fo)); 
              }
              fclose($fo);
              fclose($fn);
              unlink("users/$email/details.txt");
              rename("users/$email/details1.txt","users/$email/details.txt");
              session_destroy();
              header("location:index.php?error='Password changed successfully! Login to continue'");
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
        .error{
            color: red;
           
        }
    </style>
  </head>
  <body>
    <form class="mr-5 ml-5 mt-5" method="POST">
          <h1>Change Password</h1>
          <span class="error1"><?php echo $error;?></span>
          <div class="form-group">
            <label for="opass">Old Password</label>
            <input type="password" class="form-control" id="opass" name="opass">
            <span class="error"><?php echo $opassError;?></span>
          </div>
          <div class="form-group">
            <label for="pass">New Password</label>
            <input type="password" class="form-control" id="pass"  name="pass">
            <span class="error"><?php echo $passError;?></span>
          </div>
          <div class="form-group">
            <label for="conpass">Confirm Password</label>
            <input type="password" name="conpass" class="form-control" id="conpass">
            <span class="error"><?php echo $conpassError;?></span>
          
          </div>
          <button type="submit" name="submit" class="btn btn-primary mb-5">Change Password</button>
          <button type="reset" class="btn btn-warning mb-5">Reset</button>
  </form>
   
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>