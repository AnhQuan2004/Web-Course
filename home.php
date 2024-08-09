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
$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();
$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();
$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
    <link rel="icon" href="images/logo.png" type="image/icon type">
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
</head>
<body>
<?php include 'components/user_header.php'; ?>
  <!-- ================ start banner Area ================= -->
<section class="home-banner-area">
  <div class="container">
    <div class="row justify-content-center fullscreen align-items-center">
      <div class="col-lg-5 col-md-8 home-banner-left">
        <h1 class="text-white">
          Take the first step <br />
          to learn with us
        </h1>
        <p class="mx-auto text-white mt-20 mb-40">
          In the history of modern astronomy, there is probably no one
          greater leap forward than the building and launch of the space
          telescope known as the Hubble.
        </p>
      </div>
      <div class="offset-lg-2 col-lg-5 col-md-12 home-banner-right">
        <img class="img-fluid" src="img/header-img.png" alt="" />
      </div>
    </div>
  </div>
</section>

  <!-- ================ End banner Area ================= -->

  <!-- ================ Start Feature Area ================= -->
<section class="feature-area">
    <div class="container-fluid">
      <div class="feature-inner row">
        <div class="col-lg-2 col-md-6">
          <div class="feature-item d-flex">
            <i class="ti-book"></i>
            <div class="ml-20">
              <h4>New Classes</h4>
              <p>
                In the history of modern astronomy, there is probably no one greater leap forward.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="feature-item d-flex">
            <i class="ti-cup"></i>
            <div class="ml-20">
              <h4>Top Courses</h4>
              <p>
                We have top of course in the world.In this course, students get more knowleadgeable.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="feature-item d-flex border-right-0">
            <i class="ti-desktop"></i>
            <div class="ml-20">
              <h4>Full E-Books</h4>
              <p>
                In the history of modern astronomy, we have many e-books.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ End Feature Area ================= -->

  <section class="carsounel">
    <video autoplay loop muted>
      <source src="video/Online Education in 2021_ _ by Studyportals.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
</section>

  <!-- ================ Start Popular Course Area ================= -->
  <section class="popular-course-area">
  <div class="container-fluid">
    <div class="row justify-content-center section-title">
      <div class="col-lg-12">
        <h2>
          Popular Courses <br />
          Available Right Now
        </h2>
        <div class="row">
          <?php
            $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
            $select_courses->execute(['active']);
            if($select_courses->rowCount() > 0){
                while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
                  $course_id = $fetch_course['id'];

                  $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                  $select_tutor->execute([$fetch_course['tutor_id']]);
                  $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="box">
              <div class="tutor">
                  <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" class="tutor-img" alt="">
                  <div>
                    <h3><?= $fetch_tutor['name']; ?></h3>
                    <span><?= $fetch_course['date']; ?></span>
                  </div>
              </div>
              <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
              <h3 class="title"><?= $fetch_course['title']; ?></h3>
              <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn btn btn-primary">
                View Playlist
              </a>
            </div>
          </div>
          <?php
            }
          }
          else
          {
            echo '<p class="empty">No courses added yet!</p>';
          }
          ?>
        </div>
        <div class="more-btn text-center">
          <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">
         view playlist</a>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- ================ End Popular Course Area ================= -->

<section class="present-advise">
  <div class="container py-5 strategic-advisors-banner rounded ">
      <h1 class="text-center mb-5 text-white">Strategic advisors</h1>
      <p class="text-center mb-5 text-white">Meet the experts and industry thought-leaders helping shape the future of SqlDBM</p>

      <div class="advisor-card">
        <img src="images/IMG_9076 (1).jpg" class="advisor-img" alt="Quan Nguyen">
        <div class="advisor-details text-white">
          <h3>Quan Nguyen</h3>
          <p>The Data Warrior, Strategic Advisor, Data Vault Master, Author, Speaker, and Tae Kwon Do Grandmaster</p>
          <a href="tutor_profile.php" class="btn btn-primary">See details</a>
        </div>
      </div>

      <div class="advisor-card text-white">
        <img src="https://via.placeholder.com/150" class="advisor-img" alt="Son Le">
        <div class="advisor-details">
          <h3>Gordon Wong</h3>
          <p>Leading organizations through analytics transformations, preference for social missions, healthcare, energy, education, and civic engagement</p>
          <a href="tutor_profile.php" class="btn btn-primary">See details</a>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</section>

  <!-- ================ Start Feature Area ================= -->
  <section class="other-feature-area">
    <div class="container">
      <div class="feature-inner row">
        <div class="col-lg-12">
          <div class="section-title text-left">
            <h2>
              Features That <br />
              Can Avail By Everyone
            </h2>
            <p>
              If you are looking at blank cassettes on the web, you may be
              very confused at the difference in price. You may see some for
              as low as $.17 each.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="other-feature-item">
            <i class="ti-key"></i>
            <h4>Lifetime Access</h4>
            <div>
              <p>
              With our Lifetime Access feature, you'll never have to worry about course expiration dates or recurring fees. Once enrolled, you'll have permanent access to the course materials, allowing you to revisit the content whenever you need a refresher or want to deepen your understanding.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt--160">
          <div class="other-feature-item">
            <i class="ti-files"></i>
            <h4>Source File Included</h4>
            <div>
              <p>
              To enhance your learning journey, we provide you with comprehensive source files for each course. These files include code samples, project files, templates, and other valuable resources that enable you to follow along, practice, and reinforce your newly acquired skills.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt--260">
          <div class="other-feature-item">
            <i class="ti-medall-alt"></i>
            <h4>Student Membership</h4>
            <div>
              <p>
              As a valued student member, you'll enjoy a range of exclusive benefits and discounts. From early access to new course releases to special pricing on additional learning resources, our membership program is designed to support your continuous growth and development.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="other-feature-item">
            <i class="ti-briefcase"></i>
            <h4>35000+ Courses</h4>
            <div>
              <p>
              Our extensive library features over 35,000 courses spanning diverse disciplines, including technology, business, creative arts, personal development, and more. Whether you're seeking to advance your career, acquire new skills, or pursue a passion, our comprehensive course catalog has something for everyone.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt--160">
          <div class="other-feature-item">
            <i class="ti-crown"></i>
            <h4>Expert Mentors</h4>
            <div>
              <p>
              Our courses are crafted and delivered by renowned experts in their respective fields, ensuring you receive authentic, up-to-date, and practical knowledge. With their years of experience and proven expertise, our mentors will guide you through complex concepts and provide invaluable insights for your professional and personal growth.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt--260">
          <div class="other-feature-item">
            <i class="ti-headphone-alt"></i>
            <h4>Live Supports</h4>
            <div>
              <p>
              We understand that learning can present challenges, which is why we offer dedicated live support to address your queries and concerns. Unlock the power of Lifetime Access, source files, and our extensive course library today. Our knowledgeable support team is available to assist you, ensuring a seamless and enjoyable learning experience from start to finish.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
  <!-- ================ End Feature Area ================= -->
  <!-- ================ start footer Area ================= -->
  <?php include 'components/footer.php'; ?>

  <script src="js/vendor/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/hexagons.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/script.js"></script>
</body>
