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
   header('location:news.php');
}
if(isset($_POST['delete_news'])){
   $delete_id = $_POST['news_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_news_thumb = $conn->prepare("SELECT * FROM `news` WHERE id = ? LIMIT 1");
   $delete_news_thumb->execute([$delete_id]);

   $fetch_thumb = $delete_news_thumb->fetch(PDO::FETCH_ASSOC);

   unlink('../uploaded_files/'.$fetch_thumb['thumb']);
   $delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE news_id = ?");

   $delete_bookmark->execute([$delete_id]);
   $delete_news = $conn->prepare("DELETE FROM `news` WHERE id = ?");
   $delete_news->execute([$delete_id]);


   header('locatin:news.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>News Details</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="playlist-details">
   <h1 class="heading">News details</h1>


   <?php
      $select_news = $conn->prepare("SELECT * FROM `news` WHERE id = ? AND tutor_id = ?");
      $select_news->execute([$get_id, $tutor_id]);
      if($select_news->rowCount() > 0){
         while($fetch_news = $select_news->fetch(PDO::FETCH_ASSOC)){
            $news_id = $fetch_news['id'];
   ?>


   <div class="row">
      <div class="thumb">
         <img src="../uploaded_files/<?= $fetch_news['thumb']; ?>" alt="">
      </div>

      <div class="details">
         <h3 class="title"><?= $fetch_news['title']; ?></h3>
         <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_news['date']; ?></span></div>
         <div class="description"><?= $fetch_news['content']; ?></div>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="news_id" value="<?= $news_id; ?>">
            <a href="update_news.php?get_id=<?= $news_id; ?>" class="option-btn">Update news</a>
            <input type="submit" value="delete news" class="delete-btn" onclick="return confirm('Delete this news?');" name="delete">
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