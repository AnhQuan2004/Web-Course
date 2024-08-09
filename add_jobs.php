<?php
include '../components/connect.php';
if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['submit'])){
   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   $add_jobs = $conn->prepare("INSERT INTO `jobs`(id, tutor_id, title, content, thumb, status) VALUES(?,?,?,?,?,?)");
   $add_jobs->execute([$id, $tutor_id, $title, $content, $rename, $status]);
   move_uploaded_file($image_tmp_name, $image_folder);
   $message[] = 'Job notification created!';  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add job notification</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="playlist-form">
   <h1 class="heading">Create job notification</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <p>jobs status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- select status</option><option value="active">Active</option><option value="deactive">Deactive</option>
      </select>
      <p>jobs title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Enter jobs title" class="box">
      <p>jobs content <span>*</span></p>
      <textarea name="content" class="box" required placeholder="Write content" maxlength="" cols="30" rows="10"></textarea>
      <p>jobs thumbnail <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <input type="submit" value="create job notification" name="submit" class="btn">
   </form>
</section>
<script src="../js/admin_script.js"></script>
</body>
</html>