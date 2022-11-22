<?php
include 'conn.php';
if(isset($_POST['name']) && ($_POST['email'])  && ($_POST['mobile'])  && ($_POST['state'])  && ($_POST['city'])  && ($_POST['password'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $password =md5($_POST['password']);
    $sql = "select * from `register` where mobile = '$mobile'";
    $query = mysqli_query($con , $sql);
    if(mysqli_num_rows($query) > 0){
            $r['message']="Number already exist";
            $r['success']=false;
        }
        else{
            $insert = "insert into `register` (`name`,`email`,`mobile`,`state`,`city`,`password`) values ('$name','$email','$mobile',$state,$city,'$password')";
        $q = mysqli_query($con ,$insert);
        if($q){
            $token=md5($mobile).time();
            $tsql="UPDATE `register` SET `token`='$token' WHERE mobile = '$mobile'";
            $tres=mysqli_query($con,$tsql);
            if($tres){
                $r['message']="Record added successfully";
                $r['success']=true;
                $r['token']=$token;
            }
            else{
                $r['message']="token can't generated";
                $r['success']=false;
            }
        }
        else{
            $r['message']="Something is wrong";
            $r['success']=false;
        }
    }
    
}
else{
    $r['message']="please enter the required fields";
    $r['success']=false;
}
   echo json_encode($r);
   
    ?>