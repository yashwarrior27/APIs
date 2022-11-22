<?php
include("conn.php");
if(isset($_POST['name'])&&($_POST['email'])&&($_POST['mobile'])&&($_POST['password'])&&($_POST['state'])&&($_POST['city'])){
    $name=$_POST['name'];
    $email=$_POST['email'];;
    $mobile=$_POST['mobile'];
    $pass=md5($_POST['password']);
    $state=$_POST['state'];
    $city=$_POST['city'];
   $sql1="SELECT * FROM `register` WHERE `mobile`='$mobile'";
   $res1=mysqli_query($conn,$sql1);
   if(mysqli_num_rows($res1)>0){
    $response["message"]="mobile number already exist";
    $response["success"]=false;
   }
   else{
    $token=md5($mobile).time();
     $sql2="INSERT INTO `register`(`name`, `email`, `mobile`, `password`, `state`, `city`,`token`) VALUES ('$name','$email','$mobile','$pass','$state','$city','$token')";
     $res2=mysqli_query($conn,$sql2);
     if($res2){
       $sql3="SELECT * FROM `register` WHERE `mobile`='$mobile'";
       $res3=mysqli_query($conn,$sql3);
       $row3=mysqli_fetch_assoc($res3);
       $data["user"]=$row3;
       $response["message"]="registration successfully";
       $response["success"]=true;
       $response["data"]=$data;
     }
     else{
        $response["message"]="something is wrong";
        $response["success"]=false;
     }
   }


}
else{
    $response["message"]="please fill the required fields";
    $response["success"]=false;
}

echo json_encode($response);

?>