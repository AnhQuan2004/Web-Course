<?php
include '../components/connect.php';

if(isset($_GET['id'])){
   $id = $_GET['id'];
   $id = filter_var($id, FILTER_SANITIZE_STRING);
}else{
   $id = '';
   header('location: students_management.php');
}

if(isset($_POST['update'])){
   $update_id = $_POST['user_id'];
   $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);

   $update_name = $_POST['name'];
   $update_name = filter_var($update_name, FILTER_SANITIZE_STRING);

   $update_email = $_POST['email'];
   $update_email = filter_var($update_email, FILTER_SANITIZE_STRING);

   $update_password = sha1($_POST['password']);
   $update_password = filter_var($update_password, FILTER_SANITIZE_STRING);

   $update_image = $_FILES['image']['name'];
   $update_image = filter_var($update_image, FILTER_SANITIZE_STRING);
   $old_image = $_POST['old_image'];
   $old_image = filter_var($old_image, FILTER_SANITIZE_STRING);

   if(!empty($update_image)){
      $image_path = '../uploaded_files/'.$update_image;
      $tmp_name = $_FILES['image']['tmp_name'];
      move_uploaded_file($tmp_name, $image_path);
      $update_query = $conn->prepare("UPDATE `users` SET name = ?, email = ?, password = ?, image = ? WHERE id = ?");
      $update_query->execute([$update_name, $update_email, $update_password, $update_image, $update_id]);
   }else{
      $update_query = $conn->prepare("UPDATE `users` SET name = ?, email = ?, password = ? WHERE id = ?");
      $update_query->execute([$update_name, $update_email, $update_password, $update_id]);
   }

   $message[] = 'User updated successfully!';
   header('location: students_management.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update User</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
        color: #333;
        margin: 0;
        padding: 0;
        }

        .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        }

        h1 {
        text-align: center;
        color: #0077b6;
        margin-bottom: 30px;
        }

        .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        }

        .search-bar {
        flex-grow: 1;
        margin-right: 10px;
        }

        .search-bar input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        .menu {
        display: flex;
        align-items: center;
        }

        .menu a {
        color: #0077b6;
        margin-left: 10px;
        text-decoration: none;
        }

        .menu a:hover {
        color: #005580;
        }

        .form-group {
        margin-bottom: 20px;
        }

        .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        }

        .form-group input,
        .form-group .file-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        .file-input {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f5f5f5;
        cursor: pointer;
        }

        .file-input span {
        flex-grow: 1;
        padding-left: 10px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        }

        .file-input input[type="file"] {
        display: none;
        }

        .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #0077b6;
        color: #fff;
        border: none;
        border-radius: 3px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        .btn:hover {
        background-color: #005580;
        }
    </style>
   
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">Update User</h1>

   <?php
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_user->execute([$id]);
      $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="user_id" value="<?= $fetch_user['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_user['image']; ?>">
      <div class="flex">
         <div class="inputData">
            <span>Name :</span>
            <input type="text" name="name" required class="box" maxlength="50" value="<?= $fetch_user['name']; ?>">
         </div>
         <div class="inputData">
            <span>Email :</span>
            <input type="email" name="email" required class="box" maxlength="50" value="<?= $fetch_user['email']; ?>">
         </div>
         <div class="inputData">
            <span>Password :</span>
            <input type="password" name="password" required class="box" maxlength="50">
         </div>
         <div class="inputData">
            <span>Update Image :</span>
            <input type="file" name="image" class="box" accept="image/*">
         </div>
      </div>
      <input type="submit" value="Update User" name="update" class="btn">
   </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>