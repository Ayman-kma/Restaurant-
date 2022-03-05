

            <!-- Nav Bar Start -->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                <div class="container ">
                    <a href="#" class="navbar-brand"><img src="images/projectImages/logo-White.svg"
                            alt="logo-white"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#toggleMobileMenu" aria-controls="toggleMobileMenu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="toggleMobileMenu">
                        <ul class="navbar-nav ms-auto ">
                            <li class="nav-item px-3"><a href="index.php" class="nav-link">Home</a></li>
                            <li class="nav-item px-3"><a href="index.php#Menu_Section" class="nav-link">Menu</a></li>
                            <li class="nav-item px-3"><a href="index.php#Gallery_Section" class="nav-link">Gallery</a></li>
                            <li class="nav-item px-3"><a href="index.php#Testimonials_Section" class="nav-link">Testimonials</a>
                            </li>
                            <li class="nav-item px-3"><a href="#Contact_Section" class="nav-link text-nowrap">Contact
                                    Us</a>
                            </li>
                            <li class="nav-item px-3 right-navbar-items"><a href=""
                                    class="nav-link text-nowrap">Search</a>
                            </li>
                            <li class="nav-item px-3 right-navbar-items"><a href=""
                                    class="nav-link text-nowrap">Profile</a>
                            </li>
                            <li class="nav-item right-navbar-items text-nowrap"><button id="cart-btn" type="button" class=""
                                    data-bs-toggle="modal" data-bs-target="#reg-modal">
                                    <a class="right-navbar-items nav-link">Cart<p class="cart-p"> <mark
                                                id="cart-counter"><?php echo (isset($_COOKIE["cart"]))?  strlen($_COOKIE["cart"]) / 2: 0  ?></mark> </p></a>
                                </button>
                    </div>


                </div>
            </nav>

            <!-- Nav Bar End -->







            <!--        popup       -->

            <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Cart content</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="modal-body" class="modal-body" style="display: flex; flex-direction: column;">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 ">
                                    Item
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 ">
                                    Price
                                </div>
                            </div>


                            <?php
                    include_once 'php/meal.php';
                    $mealo = new Meal();

                   if (isset($_COOKIE["cart"])) {

                    $total=0;
                    $array = array_values(explode(",", $_COOKIE["cart"]));
                    for ($i = 0; $i < count($array)-1; $i++) :
                    $total = $total +  ((float) $mealo->getMealById($array[$i])["price"]);
                    ?>


                        <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 ">
                                <?php echo $mealo->getMealById($array[$i])["title"]; ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 ">
                                <?php echo $mealo->getMealById($array[$i])["price"]; ?>
                                </div>
                            </div>

                    <?php endfor; ?>


                    <div id="cart-total" class="row">
                                <div class="col-md-6 col-sm-6 col-6 ">
                                    Total
                                </div>
                                <div id="modal-price" class="col-md-6 col-sm-6 col-6 ">
                                <?php echo $total ?>
                                </div>
                            </div>

                    <?php } ?>





                        </div>

                        <div class="modal-footer">

                        <form action="php/order.php" method="POST">

            <button type="button" class="btn-secondary bot1 rounded-pill bg-danger text-dark" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class=" btn-primary bot2 rounded-pill text-dark bg-warning">order now</button>
                        </form>
                        
                        </div>
                    </div>
                </div>
            </div>

            <!--       end of popup       -->

