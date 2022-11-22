<?php
include 'conn.php';
if(isset($_POST['mobile']) && ($_POST['password'])){
    $mobile = $_POST['mobile'];
    $pass = md5($_POST['password']);
    $sql = " SELECT * FROM `register` WHERE `password` = '$pass' AND `mobile` = '$mobile'";
    $q = mysqli_query($con , $sql); 
    if(mysqli_num_rows($q)> 0){
            $token=md5($mobile).time();
            $tsql="UPDATE `register` SET `token`='$token' WHERE `mobile` = '$mobile'";
            $tres=mysqli_query($con,$tsql);
            if($tres){
                $r['message']= "login successfully";
                $r['success']= true;
                $r['token']= $token;
            }
            else{
                $r['message']= "token can't generated";
                $r['success']= false;
            }
        }
        else{
            $r['message']= "data is wrong";
            $r['success']= false;
        }
    }
    

else{
    $r['message']= "please enter valid required data";
    $r['success']= false;
}
   echo json_encode($r);
   ?>