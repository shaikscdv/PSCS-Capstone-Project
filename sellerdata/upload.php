<?php
include_once("connect.php");
if ($_POST["submit"]) {
    $productName = $_POST["product_name"];
    $productOwner = $_POST["product_owner"];
    $price = $_POST["price"];
    $fileName = $_FILES["image"]["name"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    $tempName = $_FILES["image"]["tmp_name"];
    $targetPath = "uploads/".$fileName;
    if(in_array($ext, $allowedTypes)){
        if(move_uploaded_file($tempName, $targetPath)){
            $query = "INSERT INTO  products1 ( product_name, product_owner, price, image) VALUES ('$productName', '$productOwner', '$price', '$fileName')";
            if(mysqli_query($conn, $query)){
                header("Location: index.php");
            }else{
                echo "Something is wrong";
            }
        }else{
            echo "File is not uploaded";
        }
    }else{
        echo "Your files are not allowed";
    }
}
?>