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
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Courses</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/user_header.php'; ?>

<section class="courses">
   <h1 class="heading">
      All news
   </h1>
   <div class="box-container">
      <?php
         $select_news = $conn->prepare("SELECT * FROM `news` WHERE status = ? ORDER BY date DESC");
         $select_news->execute(['active']);
         if($select_news->rowCount() > 0){
            while($fetch_new = $select_news->fetch(PDO::FETCH_ASSOC)){
               $new_id = $fetch_new['id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutor->execute([$fetch_new['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_new['date']; ?></span>
            </div>
         </div>
         <img src="uploaded_files/<?= $fetch_new['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fetch_new['title']; ?></h3>
         <a href="news.php?get_id=<?= $new_id; ?>" class="inline-btn">View New</a>
      </div>
      <?php
         }
      }else
      {
         echo '<p class="empty">No news added yet!</p>';
      }
      ?>
   </div>
</section>

<section class="courses">
   <h1 class="heading">
      All jobs
   </h1>
   <div class="box-container">
      <?php
         $select_jobs = $conn->prepare("SELECT * FROM `jobs` WHERE status = ? ORDER BY date DESC");
         $select_jobs->execute(['active']);
         if($select_jobs->rowCount() > 0){
            while($fetch_job = $select_jobs->fetch(PDO::FETCH_ASSOC)){
               $job_id = $fetch_job['id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutor->execute([$fetch_job['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_job['date']; ?></span>
            </div>
         </div>
         <img src="uploaded_files/<?= $fetch_job['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fetch_job['title']; ?></h3>
         <a href="jobs.php?get_id=<?= $job_id; ?>" class="inline-btn">View Job</a>
      </div>
      <?php
         }
      }else
      {
         echo '<p class="empty">No jobs added yet!</p>';
      }
      ?>
   </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>