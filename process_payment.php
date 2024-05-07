<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'form'; 

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {
    exit('Error connecting to the database: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['card_number']) || empty($_POST['cvv'])) {
        exit('Please fill all the fields');
    } else {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $cardNumber = mysqli_real_escape_string($con, $_POST['card_number']);
        $cvv = mysqli_real_escape_string($con, $_POST['cvv']);
        $sql = "INSERT INTO users (name, card_number, cvv) VALUES ('$name', '$cardNumber', '$cvv')";
        if (mysqli_query($con, $sql)) {
            echo "Payment confirmed successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>
