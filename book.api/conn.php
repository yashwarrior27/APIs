<?php
$con = mysqli_connect('localhost','newdesign_book','newdesign_book','newdesign_book');
$imglink="https://design.webgenesis.in/book/upload/";

$res="";
if(isset($_POST['token'])){
    $token=$_POST['token'];
    $rsql="SELECT * FROM `register` WHERE `token`='$token'";
    $rres=mysqli_query($con,$rsql);
    if(mysqli_num_rows($rres)>0){
        $res="yes";
    }
    else{
        $res="token error";
    }
}
else{
    
    $res="no";
}
?>