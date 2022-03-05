<?php
include_once 'meal_db.php';
$meal_db_object = new Meal_db();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $post = file_get_contents('php://input');
  $meal_db_object->addMealReview();
  echo json_encode($post);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $data = $meal_db_object->getMealReviews($_GET['id']);
  echo json_encode($data);
}

?>