<!-- <?php

      include 'components/connect.php';

      session_start();

      if (isset($_SESSION['user_id'])) {
         $user_id = $_SESSION['user_id'];
      } else {
         $user_id = '';
      };

      ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <div class="heading">
      <h3>about us</h3>
      <!-- <p><a href="index.php">Home</a> <span> / About</span></p> -->
   </div>

   <!-- Our Ower -->
   <section class="card">

      <img src="images/owner.jpg" class="card-img" alt="...">

      <div class="doc">
         <h3 class="title">Leader</h3>
         <br>
         <p> <b>Eang Chhenghort</b></p>
         <p> Lecturer, <br> Department of Computer Science & Engineering
            <br>
            <b>Phone: </b> 096 666 7777<br> <b> Email: </b> e2cafe.owner@gamil.com
         </p>
         <br>
         <br>
         <a href="https://www.linkedin.com/in/eang-chhenghort-84b639299/" target="_blank" class="btn">Learn More</a>
      </div>

   </section>

   <!-- Our Team -->


   <section class="team">

      <h1 class="title">Our Team</h1>

      <div class="swiper-wrapper">
         <div class="box">
            <img src="images/member-1.jpg" alt="">

            <h2>Ly Chomnan</h2>
            <h3>Assistant</h3>
         </div>

         <div class="box">
            <img src="images/member-5.jpg" alt="">
            <h2>Vuthin Samnang</h2>
            <h3>Frontend Developer</h3>
         </div>

         <div class="box">
            <img src="images/member-2.jpg" alt="">

            <h2>Chhouk Phanha</h2>
            <h3>Backend Developer</h3>
         </div>

         <div class="box">
            <img src="images/member-6.jpg" alt="">
            <h2>Un Bunchhay</h2>
            <h3>Tester</h3>
         </div>

         <div class="box">
            <img src="images/member-7.jpg" alt="">
            <h2>Yan Sovanlida</h2>
            <h3>Tester</h3>
         </div>

         <div class="box">
            <img src="images/member-3.jpg" alt="">
            <h2>Hour Darong</h2>
            <h3>Book Writer</h3>
         </div>

         <div class="box">
            <img src="images/member-4.jpg" alt="">
            <h2>Ly Leangsreng</h2>
            <h3>Slide Editor</h3>
         </div>

      </div>

   </section>

   <!-- about section starts  -->

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/about-card.jpg" alt="">
         </div>

         <div class="content">
            <h3>Our Mission</h3>
            <p>At coffee shop our mission is to spread positive energy.</p>
            <br>
            <br>
            <p> For over two decades, our family has used coffee as a catalyst for inspiring community, relationships, and adventures. We dedicate ourselves to the quality of our work and elevating coffee experiences. </p>
            <a href="menu.php" class="btn">our menu</a>
         </div>

      </div>

   </section>

   <!-- about section ends -->

   <!-- steps section starts  -->

   <section class="steps">

      <h1 class="title">simple steps</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>choose order</h3>
            <p>Start by browsing the coffee shop menu, filled with your favorite drinks, snacks, and meals. Pick what you're craving, customize it to your taste—like choosing your coffee size or adding extra toppings—and add it to your order.</p>
         </div>

         <div class="box">
            <img src="images/step-2.png" alt="">
            <h3>fast delivery</h3>
            <p>Once you've made your selection, enter your delivery details and confirm the order through the app or website. Our team gets started right away to prepare and deliver your items quickly and with care.</p>
         </div>

         <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>enjoy food</h3>
            <p>When your fresh coffee and delicious food arrive, simply sit back, relax, and enjoy every sip and bite. Great taste, delivered fast—just how you like it!</p>
         </div>

      </div>

   </section>

   <!-- steps section ends -->

   <!-- reviews section starts  -->

   <section class="reviews">

      <h1 class="title">customer's reivews</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="images/pic-1.jpg" alt="">
               <p>I've tried many coffee brands, but this one stands out. The flavor is rich, smooth, and not too bitter. It's the perfect start to my morning and keeps me energized throughout the day. Highly recommend it for true coffee lovers!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Monkey D. Luffy</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-2.jpg" alt="">
               <p>This coffee has the perfect balance of aroma and taste. It's strong without being overpowering, and the freshness is noticeable in every sip. I enjoy it both black and with a splash of milk.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Son Goku</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-3.jpg" alt="">
               <p>Every cup tastes just as good as the last. I've been buying this coffee for months now, and it never disappoints. Whether brewed in a drip machine or French press, it always delivers a satisfying experience.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Naruto Uzumaki</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-4.jpg" alt="">
               <p>For the quality you get, the price is unbeatable. It's way better than most of the premium brands I've tried. Smooth, full-bodied, and makes my kitchen smell amazing every morning.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Umaru Chan</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-5.jpg" alt="">
               <p>This has become my daily go-to coffee. It gives me that much-needed boost in the morning without the jitters. The taste is clean and comforting, like a hug in a mug.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Danny phantom</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-6.jpg" alt="">
               <p>I always serve this coffee when I have guests over, and everyone compliments it. It has a café-quality taste that impresses even the pickiest coffee drinkers. Definitely a crowd-pleaser!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Saitama</h3>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <!-- reviews section ends -->


   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->

   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         grabCursor: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            700: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>