<?php
include 'components/connect.php';
if(isset($_COOKIE['user_id']))
{
   $user_id = $_COOKIE['user_id'];
}
else
{
   $user_id = '';
}
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}
else
{
   $get_id = '';
   header('location:home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
      Job
   </title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="playlist">
   <h1 class="heading">
      Job details
   </h1>
   <div class="row">
      <?php
         $select_job = $conn->prepare("SELECT * FROM `jobs` WHERE id = ? and status = ? LIMIT 1");
         $select_job->execute([$get_id, 'active']);
         if($select_job->rowCount() > 0){
            $fetch_job = $select_job->fetch(PDO::FETCH_ASSOC);
            $job_id = $fetch_job['id'];
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE jobs_id = ?");
            $count_videos->execute([$job_id]);
            $total_videos = $count_videos->rowCount();
            $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ? LIMIT 1");
            $select_tutor->execute([$fetch_job['tutor_id']]);
            $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="col">
         <div class="thumb">
            <img src="uploaded_files/<?= $fetch_job['thumb']; ?>" alt="">
         </div>
      </div>
      <div class="col">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_tutor['profession']; ?></span>
            </div>
         </div>
         <div class="details">
            <h3><?= $fetch_job['title']; ?></h3>
            <p><?= $fetch_job['content']; ?></p>
            <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_job['date']; ?></span></div>
         </div>
      </div>
      <?php
         }
         else
         {
            echo '<p class="empty">This job was not found!</p>';
         }  
      ?>
   </div>
</section>

<script src="js/script.js"></script>
</body>
</html>