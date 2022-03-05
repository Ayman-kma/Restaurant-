<?php
include ('php/meal.php');
include ('php/meal_db.php');

$id =$_GET['id'];
$meal1 = new Meal_db();
$meal_local = new Meal();
$meal_nut = $meal_local->getMealById($id);
$meal = $meal1->getMealById($id);

// $review = $meal['reviews'];
$nutrition = $meal_nut['nutrition'];
$facts = $nutrition['facts'];
$one = "php/cart.php?id="; 
$two = "&back=";
$three = $_SERVER["PHP_SELF"];
$four = "?id=";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src=" app.js"></script>
  <title>Detail</title>

</head>

<body>


<?php 
        require 'include/inc.header.php';
       
        ?>


  <div class="container detail-section-start">

    <div class="row">
      <picture class="col-lg-6 col-md-12"><img class="img-fluid w-100" src="images/projectImages/<?php echo $meal['image'] ?>"
          alt="meal<?php echo $id ?>"></picture>

      <div class="col-lg-6 col-md-12 ">

        <div class="meal-info">
          <h2 class="heading-style1"><?php echo $meal['title'] ?></h2>
          <p><?php echo $meal['price'] ?>  SAR</p>
          <p>⭐️<?php echo $meal_nut['rating'] ?> rating</p>
          <p><?php echo $meal['description']?>
          </p>
        </div>
        <div class="meal-buttons">
          <a class="control-btn anchor-style" onclick="decrement()">-</a>
          <a id="num-of-items" class="control-btn anchor-style">1</a>
            <script type="text/javascript">
var jvalue = document.getElementById("num-of-items").innerHTML ;

<?php $abc = "<script>document.write(jvalue)</script>";
$int = intval($abc);

?>

</script>
          <a class="control-btn anchor-style"  onclick="increment()">+</a>
          <a  class="pt-2 ms-auto" href= "<?php echo $one; ?><?php echo $id; ?><?php echo $two; ?><?php echo $three; ?><?php echo $four; ?><?php echo $id; ?>" >
                        <button class="card_cart button-style text-dark" onclick="add_cart_index(<?php echo $id; ?>)">Add to
                        Cart</button>
                    </a>
          
        </div>

      </div>
    </div>
  </div>


  <?php $dom = new DOMDocument('1.0', 'iso-8859-1'); $tagcontent = $dom->getElementById('error_msg');
  echo $tagcontent;?>
  <!-- Reviews Section-->

  <div class="container pt-3">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item no-hover" role="presentation">
        <button class="nav-link active pillz table-pill" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
          type="button" role="tab" aria-controls="pills-home" aria-selected="true">description</button>
      </li>
      <li class="nav-item no-hover" role="presentation">
        <button class="nav-link pillz review-pill" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
          type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="showReview(<?php echo $id ?>)">Reviews</button>
      </li>

    </ul>
  </div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="container" id="description-table">
        <p><?php echo $meal_nut['description'];?></p>

        <h4>nutrition facts</h4>


        <!--        table       -->
        <table>


          <!--      Table header     -->
          <thead>
            <tr>
              <td colspan="3"> <strong>Supplement Facts</strong> </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Serving Size:</strong><?php echo $nutrition['serving_size']?></td>
            </tr>
            <tr>
              <td colspan="3"> <strong>Serving Per Container:</strong> <?php echo $nutrition['serving_per_container']?></td>
            </tr>
            <tr>
              <th></th>
              <th align="left">Amount Per Serving</th>
              <th align="left">%Daily Value*</th>
            </tr>
          </thead>
          <!--      End of Table header     -->



          <!--      Table body     -->
          <tbody>
          <?php
for($i = 0; $i < count($facts); $i++) {
  echo "<tr>";
  $replace = str_replace('_', ' ', $facts[$i]['item']);
  echo "<td>".$replace."</td>";
  echo "<td>".$facts[$i]['amount_per_serving'].$facts[$i]['unit']."</td>";
  echo "<td>".$facts[$i]['daily_value']."</td>";
  echo "</tr>";

}
?>
          </tbody>
          <!--     End of Table body     -->



          <!--       Table footer       -->
          <tfoot>
            <tr>
              <td colspan="3">* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher
                or
                lower depending on your calorie needs</td>
            </tr>
          </tfoot>
          <!--     End of Table footer     -->


        </table>
      </div>

      <!--       End of table       -->
    </div>

    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <section class="container" id="Reviews_Section">
        <?php $review_array = $meal1->getMealReviews($id); ?>
        <h3 id="reviewTitle">Reviews</h3>

        <div class="testimonial-grid">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                </div>

                <div class="carousel-inner">
                </div>

            </div>
          <button onclick="add_review()" class="review-button button-style">Add Your Review</button>

          <form  class="hide-form hide" id="disappearing-form" method="POST" enctype="multipart/form-data" onsubmit="return false"
            action="" >
            
            <label>Image</label>
            <input type="file" name="fileName" id="review-img">
            <label>Rate the Food</label>
            <input type="range" min="0" max="5" list="rateList" name="rating" id="review-rating">
            <datalist id="rateList">
              <option value="1"></option>
              <option value="2"></option>
              <option value="3"></option>
              <option value="4"></option>
              <option value="5"></option>
            </datalist>
            <div class="txt-box">
              <label>Name</label>
              <input id="review-name" class="txt-area" type="text" name="name" placeholder="First and Last name" size="23">
              <label>City</label>
              <input id="review-city" class="txt-area" type="text" name="city" placeholder="City" size="23">
              <label>Review</label>
              <p id="error_msg">Please type your review</p>
              <textarea maxlength="500" id="review-txt" name="review" class="txt-area"
                placeholder="Type your review here max 500 characters" cols="28" rows="10"
                onkeyup="increase_counter()"></textarea>
              <label id="review_counter">0 / 500</label>
            </div>
            <input onclick="submitFunction(<?php echo $id ?>)" class="submit mb-3" type="submit" value="Submit">
          </form>

      </section>

    </div>
  </div>

  <?php 
        require 'include/inc.footer.php';
       
       ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>