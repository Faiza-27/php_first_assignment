<?php
error_reporting(0);
include("captcha.php");
$nameError=$ageError=$emailError=$passError=$conpassError=$genderError=$fileError=$loginError=$capError="";
if(isset($_POST["submit"])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $conpass=$_POST['conpass'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $tmp=$_FILES['att']['tmp_name'];


    //name validation
    if(empty($name)){
        $nameError="*Name Required";
    }
    else{
        if(!preg_match("/^[a-zA-Z ]+$/",$name)){
            $nameError="*Only Alphabets Required";
        }
    }

    //age validation
    if(empty($age)){
        $ageError="*Age required";
    }
    else if($age<0 || $age>120){
        $ageError="*Enter valid age";
    }

    //email validation
    if(empty($email)){
        $emailError="*Required email";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailError="*Invalid email";
    }

    //password validation
    if(empty($pass)){
        $passError="*Required password";
    }
    else if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$pass)){
        $passError="*Must be a minimum of 8 characters, contain at least 1 number, contain at least one uppercase character and contain at least one lowercase character";
    }

    //confirm password
    if(empty($conpass)){
        $conpassError="*Required field";
    }
    else if($pass!=$conpass){
        $conpassError="*Password does not match";
    }

    //gender validation
    if(empty($gender)){
        $genderError="*Select gender";
    }
    //image validation
    $fn=$_FILES['att']['name'];
    $ext=pathinfo($fn,PATHINFO_EXTENSION);
    if(empty($tmp))
    {
        $fileError="*Image required";
    }
    else if($ext=="jpg" || $ext=="png" || $ext=="jpeg"){
        $fileError="";
    }
    else{
        $fileError="*Only jpg, png and jpeg supported";
    }

    //captcha empty
    if(empty($_POST['cap'])){
        $capError="*Enter Captcha";
    }
    else if($capsum==$_POST['cap']){
        $capError="wrong";
    }
    
     

    //final validation
    if($fileError=="" && $genderError=="" && $nameError=="" && $passError=="" && $conpassError=="" && $emailError=="" && $ageError=="" && $loginError=="" && $capError==""){
        
                $fname="image-".time()."-".rand().".$ext";
                if(is_dir("users/".$email)){
                    $loginError="Email is already exists";
                }
                else{
                    mkdir("users/$email");
                    if(move_uploaded_file($tmp,"users/$email/$fname"))
                        {
                            $password=substr(sha1($pass),0,10);
                            file_put_contents("users/$email/details.txt","$name\n$email\n$password\n$pass\n$gender\n$age\n$fname");
                            header("location:welcome.php?uid=$email&uname=$name");
                        }
                    else {
                        rmdir("users/$email");
                        $loginError="Uploading Error";
                    }

                }
       
    }//check empty if close
}//isset closing
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Register</title>
    <style>
        .error{
            color: red;
        }
        .error1{
            color: red;
            margin-left: 45%;
            font-size: 20px;
        }
    </style>
  </head>
  <body>
    <?php
        include('nav.php');
    ?>
    <div class="jumbotron mr-5 ml-5 text-center" style='background-color:#732C2C;color:white'>
        <h1 class="display-4">REGISTRATION</h1>
    </div>
        <span class="error1"><?php echo $loginError;?></span>
        <form class="mr-5 ml-5" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $email;?>">
            <span class="error"><?php echo $emailError;?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="pass" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" name="pass" class="form-control" id="pass">
            <span class="error"><?php echo $passError;?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="conpass" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
            <input type="password" name="conpass" class="form-control" id="conpass">
            <span class="error"><?php echo $conpassError;?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" value="<?php echo $name;?>">
            <span class="error"><?php echo $nameError;?></span>
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
            <div class="col-sm-10">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">
                    Female
                </label>
                <span class="error"><?php echo $genderError;?></span>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                <label class="form-check-label" for="male">
                    Male
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                <label class="form-check-label" for="other">
                    Other
                </label>
                </div>
            </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <label for="age" class="col-sm-2 col-form-label">Age</label>
            <div class="col-sm-10">
            <input type="number" name="age" class="form-control" id="age" value="<?php echo $age;?>">
            <span class="error"><?php echo $ageError;?></span>
            </div>
        </div>
        <form>
        <div class="form-group row">
            <label for="file" class="col-sm-2 col-form-label">Input Image</label>
            <div class="col-sm-10">
                <input type="file" name="att" id="file">
                <span class="error"><?php echo $fileError;?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="captcha" class="col-sm-2 col-form-label" >Captcha: &nbsp;<b><?php echo $pat;?></b></label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="cap" id="captcha">
            <input type="hidden" class="form-control" name="capsum" value="<?php echo $capsum;?>" >
            <span class="error"><?php echo $capError;?></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
            <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </div>
      
        </form>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>