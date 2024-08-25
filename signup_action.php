<?php
session_start();

$url = "https://script.google.com/macros/s/AKfycbzpeQIAHWHff8jqitJlWEX2HflJK3EEVqEYKuM__VFeAqYeOYv77Vg1p-19D_puzbFwoQ/exec";
$postData = [
   "action" => "signup",
   "name" => $_POST['name'],
   "email" => $_POST['email'],
   "password" => $_POST['password'],
   "date" => date("Y-m-d") // Adding the current date
];

$ch = curl_init($url);
curl_setopt_array($ch, [
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_POSTFIELDS => $postData
]);

$result = curl_exec($ch);
$result = json_decode($result, 1);

if($result['status'] == "success"){
   $_SESSION['success'] = "Signup successfully, please login";
   header("location: signup.php");
}else{
   $_SESSION['error'] = $result['message'];
   header("location: signup.php");
}
?>
