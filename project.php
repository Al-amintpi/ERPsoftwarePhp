<?php
require_once 'config.php';

if(isset($_POST['submit'])){
  $sponsor_title = $_POST['sponsor_title'];

  $img = $_FILES['sponsor_img'];
  $img_name = $_FILES['sponsor_img']['name'];
  $tmp_name = $_FILES['sponsor_img']['tmp_name'];
  $size = $_FILES['sponsor_img']['size'];
  $extension = pathinfo($img_name, PATHINFO_EXTENSION);

  // Validation-------
  if(empty($sponsor_title)){
    $error ="Sponsor Image Title Field is required";
  }
  else if(empty($img_name)){
    $error = "Sponsor Image Field is required";
  }
  else if ($extension !='png' and $extension !='PNG' AND $extension !='JPG' AND $extension !='jpg' and $extension !='jpeg' and $extension !='jpeg' and $extension !='gif' and $extension !='GIF') {
    $error = "Please Right Sponsor Image file type";
  }
  else{
      
      
       // Image move to New folder sponsorimage-------
      $new_name = time().".".$extension;
      $move = move_uploaded_file($tmp_name, 'sponsorimage/'.$new_name);
      if($move == true){
         
      }

      // Database data Insert
      $stm = $pdo->prepare("INSERT INTO sponsor_table(sponsor_title,sponsor_img)VALUES(?,?)");
      $stm->execute(array($sponsor_title,$new_name));
      $success = "Database data Insert Success";
      }
  

}


 ?>


<!DOCTYPE html>
<html dir="rtl" lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- bootstrap css hear -->
      <link rel="stylesheet" href="sponsorProject/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="sponsorProject/assets/css/fontawesome.min.css">
      <link rel="stylesheet" href="sponsorProject/assets/css/style.css">
      <title>Sponsor Project</title>

   </head>
   <body>
      <div class="container">
        
          <!-------------------- Show The Sponsor Image -------------------------->
          <div class="row">
            <div class="col-md-12">
              <div class="show-sponsor-image">
                <?php

                  $stm = $pdo->prepare("SELECT * FROM sponsor_table");
                  $stm->execute(array());
                  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                    
                  foreach($result as $row):
                  ?>
                  <div class="sponsor-img">
                    <div class="sponsor-img-main-size">
                      <div class="sponsor-img-size">
                        <img src="<?php $photo = $row['sponsor_img'];
                        echo "sponsorimage/".$photo;
                        ?>
                      " alt="">
                      </div>
                    </div>
                  <div class="sponsor-image-delete">
                    <a href="sponsorProjectimagedelete.php?sponsor_id=<?php echo $row['sponsor_id']; ?>"><i class="fas fa-trash-alt"></i></a>
                  </div>
                    
                  
                  </div>
                <h4><?php echo $row['sponsor_title']; ?></h4>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
         
       
        <!-- Submit the Sponsor Image -->
        <div class="row">
          <div class="col-md-6">
            <form action="" method="POST" enctype="multipart/form-data">
              <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                  <?php echo $error; ?>
                </div>
              <?php endif; ?>
              <?php if(isset($success)): ?>
                <div class="alert alert-success">
                  <?php echo $success; ?>
                </div>
              <?php endif; ?>
              <div class="form-group">
                <label for="sponsor_title">Sponsor Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="sponsor_title" id="sponsor_title">
                </div>
              </div>  
               
              <div class="form-group">
                <label for="sponsor_img">Sponsor Image</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="sponsor_img" id="sponsor_img">
                  <label>Choose file</label>
                </div>
              </div>
               
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            
            </form>
          </div>
        </div>
       </div>  
   </body>
   <!-- bootstrap js hear -->
   <script src="sponsorProject/assets/js/bootstrap.min.js"></script>
    
</body>
</html>