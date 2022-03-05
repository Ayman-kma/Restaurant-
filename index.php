<?php
include ('php/meal.php');
$meal = new meal();
$Meals = $meal->getAllMeals();
$one = "php/cart.php?id="; 
$two = "&back=";
$three = $_SERVER["PHP_SELF"];
$four = "#Gallery_Section";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&family=Roboto&display=swap"
        rel="stylesheet">
    <script src=" app.js"></script>
    <title>Index</title>
</head>

<body class="container-fluid px-0 ">



    <header class="index-header">

        <?php 
        require 'include/inc.header.php';
       
       ?>

        <div class="container  header-img">




            <div class="row party-time">
                <div class="col-12 ">
                    <h1 class="display-1 text-light">Party Time</h1>
                </div>

                <div class="col-12 container ">
                    <div class="header-shape ">
                        <h3>Buy any 2 burgers and get 1.5L Pepsi Free</h3>
                    </div>
                </div>
                <div class="col-12 "><button class="button-style">Order Now</button></div>
            </div>
        </div>

        <!-- Header Content Start -->


    </header>











    <?php if (isset($_COOKIE["recent-bought"])) {?>
        
    <!--        Recent Section        -->

    <section id="recent_section">
        <h2 class="text-center heading-style1 mt-5">Your recent bought products</h2>

        <div class="container ">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4 g-0" id="gallery-row">
    <?php
    $recent_section = "#recent_section";
    $mealOB = new meal();
    $id_array = array_values(array_unique(explode(",", $_COOKIE["recent-bought"])));
    for ($i = 0; $i < count($id_array) - 1; $i++) :
        $allmealOB = $mealOB->getMealById($id_array[$i]);
    ?>


<div class="col">
<div class="card">
<a class="text-dark" href=<?php echo "detail.php?id={$allmealOB['id']}";?>>
<img src="images/projectImages/<?php echo $allmealOB['image']; ?>" alt="burger">
<div class="card-body">
<p class="fontw200">⭐️<?php echo $allmealOB['rating']; ?></p>
<p><strong><?php echo $allmealOB['title']; ?></strong></p>
<p class="fontw200">Some description</p>

                        <a href= "<?php echo $one; ?><?php echo $allmealOB['id']; ?><?php echo $two; ?><?php echo $three; ?><?php echo $recent_section; ?>" >
                        <button class="card_cart button-style" onclick="add_cart_index(<?php echo $allmealOB['id']; ?>)">buy again</button>
                    </a>
                    <p class="d-inline"><?php echo $allmealOB['price']; ?></p>

                    </div>


                </div>
                </div>

    <?php endfor; }?>

    </div>
    </div>

    </section>
    <!--    div End of Recent Section        -->

    <!--        Menu Section       -->
    <section id="Menu_Section">
        <div class="container">
            <h2 class="text-center heading-style1">Want To Eat</h2>
            <p class="text-center fw-light">Try our most delicious food and usually take minutes to deliver</p>

            <div class="row text-center text-nowrap">
                <a class="col-2 nav-link text-dark fw-light" href="">pizza</a>
                <a class="col-2 nav-link text-dark fw-light" href="">fast food</a>
                <a class="col-2 nav-link text-dark fw-light" href="">cupcake</a>
                <a class="col-2 nav-link text-dark fw-light" href="">sandwich</a>
                <a class="col-2 nav-link text-dark fw-light" href="">spaghetti</a>
                <a class="col-2 nav-link text-dark fw-light" href="">burger</a>
            </div>
        </div>

        <div class="container-fluid px-0" id="menu-container">
            <div class="container">
                <div class="row">

                    <img class="col-lg-6 col-md-12" src="images/projectImages/delivery.png" alt="delivery_man">


                    <div class="align-self-center col-lg-6 col-md-12">
                        <div class="container-fluid">
                            <div class="row" id="triangle-shape">
                                <div class="align-self-center text-light">
                                    <h2>We guarantee 30 minutes delivery</h2>
                                </div>
                            </div>
                            <p class="text-light w-75">If your are having a meeting, working late at night and need an
                                extra
                                push</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--    div End of Menu Section        -->

    <!--        Gallery Section        -->

    <section id="Gallery_Section">
        <h2 class="text-center heading-style1">Our Most Popular Recipes</h2>
        <p class="text-center fw-light">Try our most delicious food and usually take minutes to deliver</p>



    </section>
    <div class="container ">

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4 g-0" id="gallery-row">


        <?php 


foreach($Meals as $tmp) {

    $rating =  $tmp['rating'];  
    $name = $tmp['title']; 
    $price = $tmp['price']; 
    $img = $tmp['image']; 
    $id = $tmp['id'];

    ?>


        <div class="col">
                <div class="card">
                    <a class="text-dark" href=<?php echo "detail.php?id={$id}";?>>
                        <img src="images/projectImages/<?php echo $img; ?>" alt="burger">
                        <div class="card-body">
                            <p class="fontw200">⭐️<?php echo $rating; ?></p>
                            <p><strong><?php echo $name; ?></strong></p>
                            <p class="fontw200">Some description</p>
                            
                    </a>
                        <a href= "<?php echo $one; ?><?php echo $id; ?><?php echo $two; ?><?php echo $three; ?><?php echo $four; ?>" >
                        <button class="card_cart button-style" onclick="add_cart_index(<?php echo $id; ?>)">Add to
                        Cart</button>
                    </a>
                    
                    <p class="d-inline"><?php echo $price; ?></p>

                </div>
            </div>
        </div>

    <?php 
        }
?>

    </div>
    </div>

    <!--        End of Gallery Section      -->
    <br>












    <!--        Testimonials Section        -->

    <section id="Testimonials_Section">
        <h2 class="heading-style1 text-center ">Clients Testimonials</h2>

        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial-grid d-block w-100">
                            <div class="row ">
                                <img src="images/projectImages/man-eating-burger.png" alt="man-eating-burger"
                                    class="col-md-12 col-sm-12 col-lg-6">
                                <div class="align-self-center review2 col-lg-6 col-md-12 col-s-12">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, earum
                                        molestias? Corrupti modi
                                        eaque eum unde aliquam, delectus, sapiente, odit distinctio doloremque eos
                                        aliquid dolorum nemo
                                        explicabo molestiae impedit numquam.</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="testimonial-grid d-block w-100">
                            <div class="row ">
                                <img src="images/projectImages/man-eating-burger.png" alt="man-eating-burger"
                                    class="col-md-12 col-sm-12 col-lg-6">
                                <div class="align-self-center review2 col-lg-6 col-md-12 col-s-12">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, earum
                                        molestias? Corrupti modi
                                        eaque eum unde aliquam, delectus, sapiente, odit distinctio doloremque eos
                                        aliquid dolorum nemo
                                        explicabo molestiae impedit numquam.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial-grid d-block w-100">
                            <div class="row ">
                                <img src="images/projectImages/man-eating-burger.png" alt="man-eating-burger"
                                    class="col-md-12 col-sm-12 col-lg-6">
                                <div class="align-self-center review2 col-lg-6 col-md-12 col-s-12">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, earum
                                        molestias? Corrupti modi
                                        eaque eum unde aliquam, delectus, sapiente, odit distinctio doloremque eos
                                        aliquid dolorum nemo
                                        explicabo molestiae impedit numquam.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>




    </section>


    <!--        End of Testimonials Section     -->




    <br>
    <?php 
        require 'include/inc.footer.php';
       
       ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>