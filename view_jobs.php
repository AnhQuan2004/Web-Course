<?php
include '../components/connect.php';
if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:jobs.php');
}
if(isset($_POST['delete_jobs'])){
   $delete_id = $_POST['jobs_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_jobs_thumb = $conn->prepare("SELECT * FROM `jobs` WHERE id = ? LIMIT 1");
   $delete_jobs_thumb->execute([$delete_id]);

   $fetch_thumb = $delete_jobs_thumb->fetch(PDO::FETCH_ASSOC);

   unlink('../uploaded_files/'.$fetch_thumb['thumb']);
   $delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE jobs_id = ?");

   $delete_bookmark->execute([$delete_id]);
   $delete_jobs = $conn->prepare("DELETE FROM `jobs` WHERE id = ?");
   $delete_jobs->execute([$delete_id]);


   header('locatin:jobs.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>jobs Details</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="playlist-details">
   <h1 class="heading">Job details</h1>


   <?php
      $select_jobs = $conn->prepare("SELECT * FROM `jobs` WHERE id = ? AND tutor_id = ?");
      $select_jobs->execute([$get_id, $tutor_id]);
      if($select_jobs->rowCount() > 0){
         while($fetch_jobs = $select_jobs->fetch(PDO::FETCH_ASSOC)){
            $jobs_id = $fetch_jobs['id'];
   ?>


   <div class="row">
      <div class="thumb">
         <img src="../uploaded_files/<?= $fetch_jobs['thumb']; ?>" alt="">
      </div>

      <div class="details">
         <h3 class="title"><?= $fetch_jobs['title']; ?></h3>
         <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_jobs['date']; ?></span></div>
         <div class="description"><?= $fetch_jobs['content']; ?></div>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="jobs_id" value="<?= $jobs_id; ?>">
            <a href="update_jobs.php?get_id=<?= $jobs_id; ?>" class="option-btn">Update job notification</a>
            <input type="submit" value="delete jobs" class="delete-btn" onclick="return confirm('delete this job notification?');" name="delete">
         </form>

      </div>
   </div>

   <?php
         }
      }
   ?>
<script src="../js/admin_script.js"></script>
</body>
</html>