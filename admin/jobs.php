<?php
include '../components/connect.php';
if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){
   $delete_id = $_POST['jobs_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);


   $verify_jobs = $conn->prepare("SELECT * FROM `jobs` WHERE id = ? AND tutor_id = ? LIMIT 1");
   $verify_jobs->execute([$delete_id, $tutor_id]);


   if($verify_jobs->rowCount() > 0){

   $delete_jobs_thumb = $conn->prepare("SELECT * FROM `jobs` WHERE id = ? LIMIT 1");
   $delete_jobs_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_jobs_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);
   $delete_jobs = $conn->prepare("DELETE FROM `jobs` WHERE id = ?");
   $delete_jobs->execute([$delete_id]);
   $message[] = 'Jobs deleted!';
   }else{
      $message[] = 'Jobs already deleted!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Jobs</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="playlists">
   <h1 class="heading">Added Job Notifications</h1>

   <div class="box-container">
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">Create new job notification</h3>
         <a href="add_jobs.php" class="btn">Add job notification</a>
      </div>


      <?php
         $select_jobs = $conn->prepare("SELECT * FROM `jobs` WHERE tutor_id = ? ORDER BY date DESC");
         $select_jobs->execute([$tutor_id]);
         if($select_jobs->rowCount() > 0){
         while($fetch_jobs = $select_jobs->fetch(PDO::FETCH_ASSOC)){
            $jobs_id = $fetch_jobs['id'];
      ?>


      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($fetch_jobs['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_jobs['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_jobs['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_jobs['date']; ?></span></div>
         </div>


         <div class="thumb">
            <img src="../uploaded_files/<?= $fetch_jobs['thumb']; ?>" alt="">
         </div>


         <h3 class="title"><?= $fetch_jobs['title']; ?></h3>
         <p class="description"><?= $fetch_jobs['content']; ?></p>


         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="jobs_id" value="<?= $jobs_id; ?>">
            <a href="update_jobs.php?get_id=<?= $jobs_id; ?>" class="option-btn">Update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Delete this job notification?');" name="delete">
         </form>


         <a href="view_jobs.php?get_id=<?= $jobs_id; ?>" class="btn">View job notification</a>
      </div>

      <?php
         } 
      }else{
         echo '<p class="empty">No job notification added yet!</p>';
      }
      ?>

   </div>
</section>
<script src="../js/admin_script.js"></script>
<script>
   document.querySelectorAll('.jobs .box-container .box .content').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>
</body>
</html>