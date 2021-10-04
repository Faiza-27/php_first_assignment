<?php
  error_reporting(0);
  $fileError=$success="";
  $email=$_SESSION['sid'];
  if(isset($_POST["submit"])){
      $tmp=$_FILES['image']['tmp_name'];
      $fn=$_FILES['image']['name'];
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
      if(empty($fileError)){
        $fname="image-".time()."-".rand().".$ext";
        $fo=fopen("./users/$email/details.txt","r+");
        $fn2=fopen("./users/$email/details1.txt","a+");
        
        $i=1;
        while($i!=7){
            
            fwrite($fn2,fgets($fo));
            $i++;
        }
        $old_img=input_field(fgets($fo));
        if(move_uploaded_file($tmp,"./users/$email/$fname")){
            fwrite($fn2,$fname."\n");
        }
        else{
          $fileError="File upload error";
        }
        
        fclose($fo);
        fclose($fn2);
        unlink("users/$email/$old_img");
        unlink("users/$email/details.txt");
        rename("users/$email/details1.txt","users/$email/details.txt");
        $success="Image Changed Successfully!";
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
    <form class="mr-5 ml-5" method="POST"  enctype="multipart/form-data">
          <h1>Change Image</h1>
          <span class="error1"><?php echo $fileError;?></span>
          <span class="text-success"><?php echo "<h2 class='text-center'>".$success."</h2>";?></span>
          <div class="form-group">
            <label for="image">Input image: </label>
            <input type="file"  id="image" name="image">
          </div>
          <button type="submit" name="submit" class="btn btn-primary mb-5">Change Image</button>
          <button type="reset" class="btn btn-warning mb-5">Reset</button>
  </form>
  
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>