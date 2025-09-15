<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$servername = "localhost";
$username = "root";
$password = "1234";
// $conn=new mysqli( 
// $servername = "localhost",
// $username = "root",
// $password = "1234",
// );

// Create connection
$conn = mysqli_connect($servername, $username, $password);
if ($conn) {
    $quiry = "create database if not exists img";
    $conn->query($quiry);
    $conn->select_db("img");

    $quiry = "create table if not exists img(id int auto_increment primary key,path varchar(50))";
    $conn->query($quiry);

} else {
    echo "not connected";
}




// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ". images path: " . $target_file . "<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        $quiry = "insert into img (path) values('./$target_file')";
        $conn->query($quiry);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>