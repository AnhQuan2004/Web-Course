<?php
include '../components/connect.php';
if(isset($_COOKIE['id'])){
   $tutor_id = $_COOKIE['id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){
   $delete_id = $_POST['users_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);


   $verify_users = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $verify_users->execute([$delete_id]);


   if($verify_users->rowCount() > 0){

   $delete_users_thumb = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $delete_users_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_users_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['image']);   
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   $message[] = 'users deleted!';
   }else{
      $message[] = 'users already deleted!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Students list</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      table {
         border-collapse: collapse;
         border-spacing: 0;
         width: 100%;
         border: 1px solid #ddd;
         border-radius: 5rem;
         }

         th, td {
         text-align: center;
         padding: 12px; /* Tăng khoảng cách giữa các ô để có đường kẻ rõ ràng hơn */
         color: white;
         background-color: black;
         border: 1px solid #ddd; /* Thêm đường kẻ giữa các ô */
         font-size: 16px; /* Tăng kích thước chữ */
         }

         .user-image {
         max-width: 60px; /* Giới hạn kích thước ảnh tối đa là 60px */
         max-height: 60px;
         border: 1px solid #ddd;
         border-radius: 50%; /* Làm tròn hình ảnh */
      }
   </style>
</head>
<body>
<?php include '../components/admin_header.php'; ?>
<script src="../js/admin_script.js"></script>

<section class="playlists">
   <h1 class="heading">Students List</h1>
   <?php

      $select_users = $conn->prepare("SELECT * FROM `users`");
      $select_users->execute();
      $fetch_users = $select_users->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <div style="overflow-x:auto;">
      <table>
         <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
         </tr>
         <?php foreach($fetch_users as $user): ?>
         <tr>
            <td>
               <img src="../uploaded_files/<?= $user['image']; ?>" alt="<?= $user['name']; ?>" class="user-image">
            </td>
            <td><?= $user['name']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['password']; ?></td>
            <!-- Hiển thị dữ liệu từ các cột khác nếu cần -->
            <td>
               <div class="flex-btn">
                  <form action="" method="post">
                     <input type="hidden" name="users_id" value="<?= $user['id']; ?>">
                     <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Delete this user?');">Delete</button>
                  </form>
               </div>
            </td>
         </tr>
         <?php endforeach; ?>
      </table>
      </div>
   <?php ?>
   </section>

<script>
   document.querySelectorAll('.users .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>
</body>
</html>