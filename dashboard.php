<?php 
 session_start();
 $sid=$_SESSION['sid'];
 if(empty($sid)){
   header("location:index.php");
 }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Dashboard Page</title>
  </head>
  <body>
    <main>
        <header>
            <?php include("nav.php");?>
        </header>
        <section class="row container-fluid">
          <aside class="col-3 p-0" > <?php include("sidebar.php");?></aside>
          <aside class="col-9"  style="background-color:#ABA361;height:700px">
          <div class="jumbotron text-center" style='background-color:#732C2C' >
            <h1 class="display-4" style="color: white;"><?php 
            if(empty(@$_GET['con'])){echo "Name";}
            else{
              echo @$_GET['con'];
            }
            ?></h1>
        </div>
             <?php 
              if(empty(@$_GET['con'])){
              include("name.php");
              }
              switch(@$_GET['con']){
                case 'Gender' : include("gender.php");
                  break;
                case 'Image' : include("image.php");
                break;
                case 'Change Image': include("changeimage.php");
                break;
                case 'Name' : include("name.php");
                break;
                case 'Change Password' : include("changepass.php");
                break;
                case 'Age' : include("age.php");
                break;
                case 'About Us' : include("aboutus.php");
                break;
              }
             ?>
          </aside>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>