<?php
$to = "jseplak@gmail.com";
$subject = "geolocation error";
$message = $_POST['message'];

mail($to,$subject,$message);
?>