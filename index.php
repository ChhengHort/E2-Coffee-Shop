<!--<?php

      include 'components/connect.php';

      session_start();

      if (isset($_SESSION['user_id'])) {
         $user_id = $_SESSION['user_id'];
      } else {
         $user_id = '';
      };

      include 'components/add_cart.php';

      ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>E2 Coffee Shop</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- Swiper CSS -->
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />


</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <!-- showcase area -->
   <section class="hero">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <div class="content">
                  <span>Order Now</span>
                  <h3>Turmeric Spiced Coffee</h3>
                  <a href="menu.php" class="btn">see menus</a>
               </div>
               <div class="image">
                  <img src="images/home-img-1.1.png" alt="">
               </div>
            </div>

            <div class="swiper-slide slide">
               <div class="content">
                  <span>Order Now</span>
                  <h3>delicious pizza</h3>
                  <a href="menu.php" class="btn">see menus</a>
               </div>
               <div class="image">
                  <img src="images/home-img-1.png" alt="">
               </div>
            </div>

            <div class="swiper-slide slide">
               <div class="content">
                  <span>Order Now</span>
                  <h3>chezzy hamburger</h3>
                  <a href="menu.php" class="btn">see menus</a>
               </div>
               <div class="image">
                  <img src="images/home-img-2.png" alt="">
               </div>
            </div>

            <div class="swiper-slide slide">
               <div class="content">
                  <span>Order Now</span>
                  <h3>rosted chicken</h3>
                  <a href="menu.php" class="btn">see menus</a>
               </div>
               <div class="image">
                  <img src="images/home-img-3.png" alt="">
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <!-- booking Area -->
   <section class="booking">
      <h1 class="title">COFFEE BUILD YOUR BASE</h1>

      <form action="booking.php" method="POST" class="bookinput">
      <input type="text" name="person" value="1 person" required>
      <label><h3>FOR</h3></label>

      <input type="date" name="date" required>
      <label><h3 class="p-2">AT</h3></label>

      <input type="time" name="time" value="19:00" required>
      <input type="submit" class="btn" value="BOOK A TABLE">
      </form>
   </section>

   <!-- <section class="booking">
      <h1 class="title"> COFFEE BUILD YOUR BASE</h1>

      <div class="bookinput">
         <input type="text" value=" 1 person">
         <label for="for">
            <h3>FOR</h3>
         </label>
         <input type="date">
         <label for="at">
            <h3 class="p-2">AT</h3>
         </label>
         <input type="time" value="7.00pm">
         <input type="submit" class="btn" value="BOOK A TABLE">
      </div>
   </section> -->


   <!-- category Area -->

   <section class="category">

      <h1 class="title">food category</h1>

      <div class="box-container">

         <a href="category.php?category=Coffee" class="box">
            <img src="images/cat-1.png" alt="">
            <h3>Coffee</h3>
         </a>

         <a href="category.php?category=main dish" class="box">
            <img src="images/cat-2.png" alt="">
            <h3>Special dishes</h3>
         </a>

         <a href="category.php?category=drinks" class="box">
            <img src="images/cat-3.png" alt="">
            <h3>drinks</h3>
         </a>

         <a href="category.php?category=desserts" class="box">
            <img src="images/cat-4.png" alt="">
            <h3>desserts</h3>
         </a>

      </div>

   </section>
   <!-- give way -->

   <!-- products -->

   <section class="products">

      <h1 class="title">latest dishes</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 8");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="menu.html" class="btn">veiw all</a>
      </div>

   </section>


   <section class="products">

      <h1 class="title">Most Customer Choise May You Like</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY popularity DESC LIMIT 4");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="product.php" class="btn">veiw all</a>
      </div>

   </section>

   <section class="products">

      <h1 class="title">New Arrive</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY popularity DESC LIMIT 4");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="product.php" class="btn">veiw all</a>
      </div>

   </section>

   <section class="products">

      <h1 class="title">Explore our shop</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 12");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="product.php" class="btn">veiw all</a>
      </div>

   </section>

   <!-- about section starts  -->

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/whychoose.jpg" alt="">
         </div>

         <div class="content">
            <h3>why choose us?</h3>
            <p>
            At our coffee shop, we're more than just a place to grab a cup of coffee — we're a community hub where quality, comfort, and connection come together. We carefully source premium beans, roast them to perfection, and craft every drink with care and consistency. Our cozy atmosphere, friendly staff, and attention to detail create an experience that keeps customers coming back. Whether you're looking for your daily caffeine fix, a quiet spot to work, or a place to catch up with friends, we're here to serve you with warmth and flavor in every cup.
            </p>
            <a href="menu.html" class="btn">our menu</a>
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
   <!-- For News Letter -->
   <section class="subscribe">
      <h1 class="title">For News Letter</h1>
      <p>Subscribe For Latest Updates</p>
      <input type="email" placeholder="Enter Your Email" class="email">
      <input type="submit" value="subscribe" class="btn">
   </section>

   <!-- Map  -->
   <section class="contact">

      <div class="row">

         <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4025.83366884334!2d104.8900443214471!3d11.568050590575321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109519fe4077d69%3A0x20138e822e434660!2sRoyal%20University%20of%20Phnom%20Penh!5e1!3m2!1sen!2skh!4v1746899313922!5m2!1sen!2skh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>   
         </div>

         <form action="" method="post">
            <h3>Contact Us !</h3>
            <input type="text" name="name" maxlength="50" class="box" placeholder="Enter Your Name" required>
            <input type="email" name="email" maxlength="50" class="box" placeholder="Enter Your Email" required>
            <textarea name="msg" class="box" required placeholder="Enter Your Message" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="send" name="send" class="btn">
         </form>

      </div>

   </section>


   <!-- steps section ends -->


   <?php include 'components/footer.php'; ?>


   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <!-- script for p'vel banner -->
   <!-- <script>
      var swiper = new Swiper(".hero-slider", {
         loop: true,
         grabCursor: true,
         effect: "flip",
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });
   </script> -->


   <!-- Swiper JS -->
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

   <!-- Initialize Swiper -->
   <script>
   var swiper = new Swiper(".hero-slider", {
      loop: true,
      grabCursor: true,
      spaceBetween: 20,
      centeredSlides: true,
      autoplay: {
         delay: 5000,
         disableOnInteraction: false,
      },
      pagination: {
         el: ".swiper-pagination",
         clickable: true,
      },
   });
   </script>


</body>

</html>