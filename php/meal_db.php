<?php

class Meal_db {
    public $db_connection;
    function __construct(){
        $this-> db_connection = mysqli_connect('127.0.0.1:3306', 'root', '', 'meals');
    }

    function getRating($id){
        $array = $this->getMealReviews($id);
        if(!$array){
            return 0;
        }
        $rating =0;
        for ($i = 0; $i < count($array); $i++) {
            $rating += $array[$i]['rating'];
    }

    return $rating/count($array);
}

    function uploadFile($file): bool{

        $target_file = "reviewImages/".imgName($file["name"]);   
        return move_uploaded_file($file['tmp_name'], $target_file);
        }

    function getAllMeals(){   
        $sql = "SELECT * FROM meal";
        $result = mysqli_query($this->db_connection, $sql);
        $meals = mysqli_fetch_all($result, MYSQLI_ASSOC); 
        if (!mysqli_query($this->db_connection, $sql)) {
            die("ERROR: Could not able to execute $sql. " . mysqli_error($this->db_connection));
        }
    return $meals;
}

    function getMealById($id){
        include_once 'php/meal.php';
        $mealo = new Meal();


        $sql = "SELECT * FROM meal WHERE id=$id";
        $result = mysqli_query($this->db_connection, $sql);
        if (!$result) {

            die("ERROR: Could not able to execute $sql. " . mysqli_error($this->cc));
        }
        $meal = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return array_merge($meal[0],$mealo->getMealById($id)["nutrition"]);
    }

    function getMealReviews($id){
        $sql = "SELECT * FROM reviews WHERE meal_id=$id";
        $result = mysqli_query($this->db_connection, $sql);
        $review = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result? $review : null;
    }

    function addMealReview()
    {
        $image =  imgName($_FILES['fileName']['name']);
        $post = file_get_contents('php://input');
        $objecto = json_decode($post);
        $object = json_decode(json_encode($objecto), true);

        $date = date("Y-m-d H:i:s", time());
        $id =$_POST['id'];
        $rating = $_POST['rating'];
        $name =$_POST['name'];
        $city =$_POST['city'];
        $review =$_POST['review'];
        $primaryID = $this->getUnique(11);



        $sql = "INSERT INTO reviews (id, reviewer_name, city, date, rating, image, review, meal_id)
        VALUES ('$primaryID', '$name', '$city', '$date', '$rating', '$image' , '$review', '$id')";
        $this->db_connection->query($sql);
        $this->uploadFile($_FILES['fileName']);
        
    }
    function getUnique($n) {
        $randomString = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $i);
            $randomString .= $index;
        }
      
        return $randomString;
    }


    


}

?>