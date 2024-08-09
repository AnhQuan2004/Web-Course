<?php
include '../components/connect.php';
if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){
   $delete_id = $_POST['news_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);


   $verify_news = $conn->prepare("SELECT * FROM `news` WHERE id = ? AND tutor_id = ? LIMIT 1");
   $verify_news->execute([$delete_id, $tutor_id]);


   if($verify_news->rowCount() > 0){

   $delete_news_thumb = $conn->prepare("SELECT * FROM `news` WHERE id = ? LIMIT 1");
   $delete_news_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_news_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);   
   $delete_news = $conn->prepare("DELETE FROM `news` WHERE id = ?");
   $delete_news->execute([$delete_id]);
   $message[] = 'news deleted!';
   }else{
      $message[] = 'news already deleted!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>news</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="playlists">
   <h1 class="heading">Added news</h1>

   <div class="box-container">
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Create news news</h3>
         <a href="add_news.php" class="btn">Add news</a>
      </div>


      <?php
         $select_news = $conn->prepare("SELECT * FROM `news` WHERE tutor_id = ? ORDER BY date DESC");
         $select_news->execute([$tutor_id]);
         if($select_news->rowCount() > 0){
         while($fetch_news = $select_news->fetch(PDO::FETCH_ASSOC)){
            $news_id = $fetch_news['id'];
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE news_id = ?");
            $count_videos->execute([$news_id]);
            $total_videos = $count_videos->rowCount();
      ?>


      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($fetch_news['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_news['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_news['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_news['date']; ?></span></div>
         </div>


         <div class="thumb">
            <span><?= $total_videos; ?></span>
            <img src="../uploaded_files/<?= $fetch_news['thumb']; ?>" alt="">
         </div>


         <h3 class="title"><?= $fetch_news['title']; ?></h3>
         <p class="description"><?= $fetch_news['content']; ?></p>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="news_id" value="<?= $news_id; ?>">
            <a href="update_news.php?get_id=<?= $news_id; ?>" class="option-btn">Update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Delete this news?');" name="delete">
         </form>


         <a href="view_news.php?get_id=<?= $news_id; ?>" class="btn">View news</a>
      </div>

      <?php
         } 
      }else{
         echo '<p class="empty">No news added yet!</p>';
      }
      ?>

   </div>
</section>
<script src="../js/admin_script.js"></script>
<script>
   document.querySelectorAll('.news .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>
</body>
</html>