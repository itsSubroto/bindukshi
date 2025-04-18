<header>
    <div class="nav-up container">
        <div class="left-nav"><a href="index.php">Bindukshi <span>Jewellers</span></a></div>
        <div class="right-nav">
            <div class="right-nav-item search-box" id="search">
                <form action="" method="get" class="search">
                    <input type="search" name="search" id="search-id" placeholder="what are you looking for">
                </form>
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </div>
            <div class="right-nav-item">

                <a href="#" class="links header-account">
                    <i class="fa-solid fa-user"></i>
                    <p>Account</p>
                </a>
                <div class="account-dropdown-box">
                    <?php
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    if ($select_profile->rowCount() > 0) {
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <div class="content">
                            <div class="account-header">
                                <p>Welcome!! <?= $fetch_profile['name']; ?></p>
                            </div>


                            <div class="account-dropdown-btn">
                                <a href="includes/logout.php" class="header-btn btn" onclick="return confirm('logout from the website?');">Log Out</a>
                                <a href="update_profile.php " class="header-btn btn">Update</a>
                            </div>

                        </div>
                    <?php
                    } else {
                    ?>

                        <div class="content">

                            <div class="account-header">
                                <p> Please Login Or Register First to proceed !</p>
                            </div>
                            <div class="account-dropdown-btn">
                                <a href="login.php" class="header-btn btn">Log In</a>
                                <a href="register.php  " class="header-btn btn">Sign Up</a>
                            </div><!--end of account dropdown buttons-->
                        </div>

                    <?php
                    }
                    ?>

                </div>


            </div>
            <div class="right-nav-item">
                <a href="wishlist.php" class="links">
                    <i class="fa-solid fa-heart"></i>
                    <p>WishList</p>
                </a>
            </div>
            <div class="right-nav-item">

                <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$user_id]);
                $total_cart_counts = $count_cart_items->rowCount();
                ?>
                <a href="cart.php" class="links cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p>Cart</p>
                    <p id="cart-count"><?= $total_cart_counts; ?></p>
                </a>
            </div>
        </div>
    </div>
    <div class="nav-down container">
        <!-- <div class="nav-down-item">
            <a href="#">All Jewellery</a>
        </div>
        <div class="nav-down-item">
            <a href="#">All Jewellery</a>
        </div>
        <div class="nav-down-item">
            <a href="#">All Jewellery</a>
        </div>
        <div class="nav-down-item">
            <a href="#">All Jewellery</a>
        </div> -->

    </div>
    <script src="js/header.js"></script>
</header>