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
if(isset($_POST['submit'])){
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);


   $update_news = $conn->prepare("UPDATE `news` SET title = ?, content = ?, status = ? WHERE id = ?");
   $update_news->execute([$title, $content, $status, $get_id]);


   $old_image = $_POST['old_image'];
   $old_image = filter_var($old_image, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);

   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `news` SET thumb = ? WHERE id = ?");

         $update_image->execute([$rename, $get_id]);
         move_uploaded_file($image_tmp_name, $image_folder);

         if($old_image != '' AND $old_image != $rename){
            unlink('../uploaded_files/'.$old_image);
         }
      }
   } 
   $message[] = 'News updated!';  
}
if(isset($_POST['delete'])){
   $delete_id = $_POST['news_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_news_thumb = $conn->prepare("SELECT * FROM `news` WHERE id = ? LIMIT 1");
   $delete_news_thumb->execute([$delete_id]);

   $fetch_thumb = $delete_news_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_news = $conn->prepare("DELETE FROM `news` WHERE id = ?");
   $delete_news->execute([$delete_id]);

   header('location:news.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update News</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="playlist-form">
   <h1 class="heading">Update news</h1>
   <?php
         $select_news = $conn->prepare("SELECT * FROM `news` WHERE id = ?");
         $select_news->execute([$get_id]);

         if($select_news->rowCount() > 0){
         while($fetch_news = $select_news->fetch(PDO::FETCH_ASSOC)){
            $news_id = $fetch_news['id'];
      ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_news['thumb']; ?>">
      <p>News status <span>*</span></p>

      <select name="status" class="box" required>
         <option value="<?= $fetch_news['status']; ?>" selected><?= $fetch_news['status']; ?></option>
         <option value="active">Active</option>
         <option value="deactive">Deactive</option>
      </select>

      <p>News title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Enter news title" value="<?= $fetch_news['title']; ?>" class="box">
      <p>News content <span>*</span></p>
      <textarea name="content" class="box" required placeholder="Write content" maxlength="1000" cols="30" rows="10"><?= $fetch_news['content']; ?></textarea>
      <p>News thumbnail <span>*</span></p>

      <div class="thumb">
         <img src="../uploaded_files/<?= $fetch_news['thumb']; ?>" alt="">
      </div>

      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" value="Update news" name="submit" class="btn">

      <div class="flex-btn">
         <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Delete this news?');" name="delete">
         <a href="view_news.php?get_id=<?= $news_id; ?>" class="option-btn">View news</a>
      </div>
   </form>
   <?php
      } 
   }else{
      echo '<p class="empty">No news added yet!</p>';
   }
   ?>

</section>
<script src="../js/admin_script.js"></script>
</body>
</html>