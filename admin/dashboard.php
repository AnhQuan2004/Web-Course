<?php
include '../components/connect.php';
if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
$select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$select_playlists->execute([$tutor_id]);
$total_playlists = $select_playlists->rowCount();

$select_news = $conn->prepare("SELECT * FROM `news` WHERE tutor_id = ?");
$select_news->execute([$tutor_id]);
$total_news = $select_news->rowCount();

$select_jobs = $conn->prepare("SELECT * FROM `jobs` WHERE tutor_id = ?");
$select_jobs->execute([$tutor_id]);
$total_jobs = $select_jobs->rowCount();

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="dashboard">
   <h1 class="heading">Dashboard</h1>
   <div class="box-container">
      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="profile.php" class="btn">View profile</a>
      </div>


      <div class="box">
         <h3><?= $total_contents; ?></h3>
         <p>Total contents</p>
         <a href="add_content.php" class="btn">Add new content</a>
      </div>


      <div class="box">
         <h3><?= $total_playlists; ?></h3>
         <p>Total playlists</p>
         <a href="add_playlist.php" class="btn">Add new playlist</a>
      </div>

      <div class="box">
         <h3><?= $total_news; ?></h3>
         <p>Total news</p>
         <a href="add_news.php" class="btn">Add new news</a>
      </div>

      <div class="box">
         <h3><?= $total_jobs; ?></h3>
         <p>Total jobs</p>
         <a href="add_jobs.php" class="btn">Add new job</a>
      </div>


      <div class="box">
         <h3><?= $total_likes; ?></h3>
         <p>Total likes</p>
         <a href="contents.php" class="btn">View contents</a>
      </div>


      <div class="box">
         <h3><?= $total_comments; ?></h3>
         <p>Total comments</p>
         <a href="comments.php" class="btn">View comments</a>
      </div>


      <div class="box">
         <h3>Quick select</h3>
         <p>Login or Register</p>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">Login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div>
      </div>
   </div>
</section>
<script src="../js/admin_script.js"></script>
</body>
</html>