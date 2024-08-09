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
      News
   </title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="playlist">
   <h1 class="heading">
      News details
   </h1>
   <div class="row">
      <?php
         $select_new = $conn->prepare("SELECT * FROM `news` WHERE id = ? and status = ? LIMIT 1");
         $select_new->execute([$get_id, 'active']);
         if($select_new->rowCount() > 0){
            $fetch_new = $select_new->fetch(PDO::FETCH_ASSOC);
            $new_id = $fetch_new['id'];
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE news_id = ?");
            $count_videos->execute([$new_id]);
            $total_videos = $count_videos->rowCount();
            $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ? LIMIT 1");
            $select_tutor->execute([$fetch_new['tutor_id']]);
            $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="col">
         <form action="" method="post" class="save-list">
            <input type="hidden" name="list_id" value="<?= $new_id; ?>">
         </form>
         <div class="thumb">
            <img src="uploaded_files/<?= $fetch_new['thumb']; ?>" alt="">
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
            <h3><?= $fetch_new['title']; ?></h3>
            <p><?= $fetch_new['content']; ?></p>
            <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_new['date']; ?></span></div>
         </div>
      </div>
      <?php
         }
         else
         {
            echo '<p class="empty">This news was not found!</p>';
         }  
      ?>
   </div>
</section>

<script src="js/script.js"></script>
</body>
</html>