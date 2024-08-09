<?php
include 'components/connect.php';
if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>
   <link rel="icon" href="images/logo.png" type="image/icon type">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/linearicons.css" />
   <link rel="stylesheet" href="css/font-awesome.min.css" />
   <link rel="stylesheet" href="css/bootstrap.css" />
   <link rel="stylesheet" href="css/magnific-popup.css" />
   <link rel="stylesheet" href="css/owl.carousel.css" />
   <link rel="stylesheet" href="css/nice-select.css">
   <link rel="stylesheet" href="css/hexagons.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" />
   <link rel="stylesheet" href="css/main.css" />
   <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" />
   <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/abouts/about-2/assets/css/about-2.css">
</head>
<body>
<?php include 'components/user_header.php'; ?>
<section class="py-3 py-md-5">
  <div class="container">
    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
      <div class="col-12 col-lg-6">
        <img class="img-fluid rounded" loading="lazy" src="https://staffskillstraining.co.uk/wp-content/uploads/2017/03/teams.jpg" alt="About 2">
      </div>
      <div class="col-12 col-lg-6">
        <div class="row justify-content-xl-center">
          <div class="col-12 col-xl-10">
            <h2 class="mb-3">Why Choose Us?</h2>
            <p class="lead fs-4 mb-3 mb-xl-5">With years of experience and deep industry knowledge, we have a proven track record of success and are constantly pushing ourselves to stay ahead of the curve.</p>
            <div class="d-flex align-items-center mb-3">
              <div class="me-3 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
              </div>
              <div>
                <p class="fs-5 m-0">Our evolution procedure is super intelligent.</p>
              </div>
            </div>
            <div class="d-flex align-items-center mb-3">
              <div class="me-3 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
              </div>
              <div>
                <p class="fs-5 m-0">We deliver services beyond expectations.</p>
              </div>
            </div>
            <div class="d-flex align-items-center mb-4 mb-xl-5">
              <div class="me-3 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
              </div>
              <div>
                <p class="fs-5 m-0">Let's hire us to reach your objectives.</p>
              </div>
            </div>
            <a href="courses.php" class="inline-btn">Course now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="about">
   <div class="box-container">
      <div class="box">
         <i class="fas fa-graduation-cap"></i>
         <div>
            <h3>+10k</h3>
            <span>Online courses</span>
         </div>
      </div>
      <div class="box">
         <i class="fas fa-user-graduate"></i>
         <div>
            <h3>+100k</h3>
            <span>Satisfied Students</span>
         </div>
      </div>
      <div class="box">
         <i class="fas fa-chalkboard-user"></i>
         <div>
            <h3>+10k</h3>
            <span>Expert Tutors</span>
         </div>
      </div>
      <div class="box">
         <i class="fas fa-briefcase"></i>
         <div>
            <h3>100%</h3>
            <span>Job Placement</span>
         </div>
      </div>

   </div>
</section>

<section class="reviews">
   <h1 class="heading">student's reviews</h1>
   <div class="box-container">
      <div class="box">
         <p>"I can't thank AlgorithmCoding enough for the amazing learning experience it has provided. The courses are well-structured.Its Highly recommended!"</p>
         <div class="user">
            <img src="images/pic-2.jpg" alt="">
            <div>
               <h3>Jason</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>
      <div class="box">
         <p>"As a working professional, The flexibility to learn at my own pace and access courses anytime, anywhere has made all the difference."</p>
         <div class="user">
            <img src="images/pic-3.jpg" alt="">
            <div>
               <h3>Bob</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>
      <div class="box">
         <p>"The diverse course selection allowed me to explore new subjects, and I found the instructors to be knowledgeable and easily approachable."</p>
         <div class="user">
            <img src="images/pic-4.jpg" alt="">
            <div>
               <h3>Liana</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>
      <div class="box">
         <p>"Being a homeschooler, finding the right educational resources can be challenging.The collaborative opportunities have made it more enjoyable."</p>
         <div class="user">
            <img src="images/pic-5.jpg" alt="">
            <div>
               <h3>Fox</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>

      <div class="box">
         <p>"I stumbled upon AlgorithmCoding while searching for resources to improve my coding skills. I was blown away by resources they offered with such quality.</p>
         <div class="user">
            <img src="images/pic-6.jpg" alt="">
            <div>
               <h3>Billy</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>
      <div class="box">
         <p>"Choosing AlgorithmCoding was a no-brainer for me. The platform's user-friendly interface have been a lifesaver, allowing me to learn on the go."</p>
         <div class="user">
            <img src="images/pic-7.jpg" alt="">
            <div>
               <h3>Anta</h3>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script src="js/script.js"></script>
<?php include 'components/footer.php'; ?>
</body>
</html>