<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="new.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">
   
   <div class="content">
      <h3>Pharmacists are the first aid of society</h3>
      <p>The pharmacy does not just sell medicines but trust too. If you want to see humanity, go to a pharmacy.</p>
      <a href="about.php" class="white-btn">Explore More</a>
   </div>

</section>

<section class="deli">

   <h1 class="title">Simple Steps</h1>

   <div class="box-container0">

      <div class="box0">
         <img src="images/delivery.jpg" alt="">
         <h3>Home Delivery</h3>
         <p>Product delievry is a customer-centric approch to defining</p>
      </div>

      <div class="box0">
         <img src="images/click&pick.png" alt="">
         <h3>Click and pick</h3>
         <p>Easy to click and pick medicine</p>
      </div>

      <div class="box0">
         <img src="images/quality1.jpeg" alt="">
         <h3>Quality Support</h3>
         <p>Best quality support available</p>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Categories</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/ctg-1.jpg" alt="">
         <p>Coated Tablets <br> Syrups <br> Powders <br>Chewing Tablets<br>etc</p>
         
         <h3>AWomen</h3>
      </div>

      <div class="box">
         <img src="images/ctg2.jpg" alt="">
         <p>Face Washes <br> Cleansers<br>Mosturizers<br> Perfumes <br> Skin Care Products<br>etc

         </p>
         
         <h3>Men</h3>
      </div>

      <div class="box">
         <img src="images/ctg3.jpg" alt="">
         <p>Lactobacillus and Bifidobacterium Blends<br>
Saccharomyces boulardii, a beneficial yeast<br>
Soil-Based Blends, usually Bacillus species <br>etc</p>
         
         <h3>Uni Sex</h3>
</div>
      <div class="box">
         <img src="images/ctg-4.jpeg" alt="">
         <p>Vitamins
Minerals <br>
Botanicals or herbs <br>
Botanical compounds <br>
Amino acids <br>etc</p>
         
         <h3>Body Mists</h3>
      </div>

      <!-- <div class="box">
         <img src="images/health.jpg" alt="">
         <p>Inhalers<br>Injections<br>Prescription drugs<br>etc</p>
         
         <h3></h3>
      </div>

      <div class="box">
         <img src="images/protection.jpg" alt="">
         <p>Masks<br>Sprays<br>gloves<br>Surgical suites<br>etc</p>
        
         <h3>Protection</h3>
      </div> -->

   </div>
 
</section>




<section class="products">

   <h1 class="title">Latest Products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">Load More</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>About Us</h3>
         <p>We are a  pharmaceutical company committed to setting new standards in health care and providing the  people access to high-quality medicine.</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>


<section class="allrounder">
   <div class="r1">
  <!-- <img class="all"src="images/f3.jpg"> -->
  <h2>Online Pharmacy</h2>
</div>
<div class="r2">
  <!-- <img class="all"src="images/f5.jpg"> -->
  <h2>Covid-19 vaccines</h2>
</div>
<div class="r3">
  <!-- <img class="all" src="images/f22.jpg"> -->
  <h2>Doctor Advice </h2>
</div>
<div class="r4">
  <!-- <img class="all"src="images/f28.jpg"> -->
  <h2>General Health </h2>
</div>
</section>

<section class="home-contact">

   <div class="content">
      <h3>Have Any Questions?</h3>
      <p>Feel free to contact our specialists to find out more about our prices and services.
We are always ready to answer your questions.</p>
      <a href="contact.php" class="white-btn">Contact Us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>