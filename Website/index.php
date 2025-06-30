
<?php
session_start();          
include 'database.php';   

if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $exists = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['quantity'] += 1;
            $exists = true;
            break;
        }
    }
    if (!$exists) {
        $_SESSION['cart'][] = $item;
    }

    $_SESSION['flash'] = "✅ Item added to cart!";
    // No redirect
}
?>


<!DOCTYPE html>
    <html lang="en">
        <head>
        <title>Home</title>
        <link rel="stylesheet" href="index.css"> 
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    </head>


    <body>
        <div class="main">
            <div class="top-navbar">
                <img src="images/logo.png" alt="Taraji Furniture logo" class="logo">
                <div class="navbar">
                <div class="heading">
                    <h1>Taraji Furnitures</h1>
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#about">About</a></li>
                        <li><a href="products.php">Products</a></li>
                        
                        <li class="dropdown">
                            <a href="#">Shop by Products</a>
                            <div class="dropdown_menu">
                                <ul>
                                    <li><a href="table.php">Tables&Chairs</a></li>
                                    <li><a href="tvStand.php">Tv Stands</a></li>
                                    <li><a href="couches.php">Couches</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#">Shop by room</a>
                            <div class="dropdown_menu">
                                <ul>
                                    <li><a href="livingroom.php">Living Room</a></li>
                                    <li><a href="bed.php">Bedroom</a></li>
                                    <li><a href="outdoor.php">Outdoor/Patio</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="review.html">Review</a></li>
                    </ul>
                </div>

                <div class="search">
                    <input class="srch" type="search" placeholder="Type to search">
                    <button class="search-btn">Search</button>
                </div>

                <div class="header-icon">
                    <a href="login.php"><i class='bx bxs-user'></i></a>

                    <a href="javascript:void(0);" class="like-toggle">
                        <i class='bx bxs-heart'></i>
                    </a>



                    <a href="cart.php"><i class='bx bxs-cart'></i>
                     
                        <?php
                        if (isset($_SESSION['cart'])) {
                        echo "<span style='color: red; font-weight: bold;'>(".count($_SESSION['cart']).")</span>";
                        }
                        ?>
                    </a>
                    
                </div>
            </div>

            <?php if (isset($_SESSION['flash'])): ?>
        <p style="background:#d4edda; color:#155724; padding:10px; text-align:center; font-weight:bold; border-radius:5px;">
        <?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?>
        </p>
         <?php endif; ?>
        </div>
        
        <div Class="content">
           <h1>Quality Furniture</h1>
           <h3>At An</h3>
           <h2>Afforable Price!</h2><br>
           <a href="products.php" type="submit" class="content-btn">Shop Now</a> <br><br>
          </div>
           
       </div>

        <section id="about">
            <br><br>
            <h2>About Us</h2>
            <br><br>

            <div class="about-content">
                <img src="images/about.png" alt="About Us image" class="about-img">
                <div class="about-text">
                    <h3 class="about-heading">Why Shop With Us?</h3>
                    <br>
                    <p class="about-paragraph">We take pride in serving our customers by providing a trusted platform where you can buy or sell beautifully crafted furniture.<br>
                    From stylish bedroom décor to elegant living room pieces.<br>we offer high-end furniture that transforms your house into a home, all at affordable prices.<br>
                    Discover the latest furniture trends that blend comfort, style, and quality!</p> 
                    <br> 
                    <a href="explore.php" type="submit" class="explore-btn">Explore Products</a> 
                </div>
                
                </div>
            </div>
        </section>

        
        <!--The products start here-->
       <div class="product-section">
            <h2> Most Bought Items</h2><br><br>

            <div class="product-grid">
            <?php

             $sql = "SELECT * FROM productdetails WHERE id IN (22, 52, 37, 60, 1, 58)";
    
                $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                ?>
                <div class="product-card">
                <div class="image-hover-container">
                    <a href="product-details.php?id=<?php echo $product['id']; ?>"title="View Details">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </a>
                </div>

            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <div class="product-rating">★★★★★</div>
            <p>R<?php echo number_format($product['price'], 2); ?></p>

           <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                <input type="hidden" name="image" value="<?php echo $product['image']; ?>">

                <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
            </form>
  
        </div>
        <?php
        }
        } else {
        echo "<p>No products found.</p>";
        }
        ?>
     </div>
        </div>

        <!--The Footer-->
       <footer class="my-footer mt-5 py-5">
            <div class="footer-main-content">
            <div class="footer-column footer-about">

                <div class="logo-text-container mb-3">
                    <img src="images/logo.png" alt="logo" class="footer-logo mb-2">
                    <h5 class="footer-title">Taraji Furnitures</h5>
                </div>

            <p>Where fashion, comfort, and style meet furniture.</p>
            <p>Our pieces are crafted to transform your space into a reflection of elegance and warmth.</p>
    
            </div>

            <div class="footer-column footer-links">
                <h6>QUICK LINKS</h6>
                <ul>
                    <li><a href="table.php">Tables & Chairs</a></li>
                    <li><a href="tvstand.php">TV Stands</a></li>
                    <li><a href="chouces.php">Couches</a></li>
                    <li><a href="livingroom.php">Living Room</a></li>
                    <li><a href="bed.php">Bedroom</a></li>
                <li><a href="outdoor.php">Outdoor/Patio</a></li>
                </ul>
            
            
             </div>

                <div class="footer-column footer-contact">
                <h5>Contact Us</h5>
                <div><br> 
                <div>
                <h6>PHONE</h6>
                <p>(012) 456 -7890</p>
                </div>

                <div>
                <h6>EMAIL</h6>
                <p>TarajiFurniture@gmail.com</p>
                    </div>
                 </div>

        
                </div>

                <div class="footer-bottom">
                <img src="images/BL1.jpeg" alt="logo" class="">
                </div><br>

                <div class="footer">
                <p>Taraji Furnitures &copy; 2025. All rights reserved.</p> 
            </div> 
        </footer>  
    </body>
</html>
