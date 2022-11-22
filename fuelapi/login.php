<?php
include("conn.php");
if(isset($_POST['mobile'])&&($_POST['pass'])){
    $mobile=$_POST['mobile'];
    $pass=md5($_POST['pass']);
    $sql="SELECT * FROM `register` WHERE mobile = $mobile AND password ='$pass'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) > 0){
        $row1=mysqli_fetch_assoc($res);
        $uid1=$row1['id'];

        $token=md5($mobile).time();
        $usql="UPDATE `register` SET token ='$token' WHERE mobile = $mobile";
        $ures=mysqli_query($conn,$usql);
        if($ures){
            $response['message']="login successfully";
            $response['success']=true;
            $response['token']=$token;
            $response['id']=$uid1;            
        }
        else{
            $response['message']="Something is wrong";
            $response['success']=false;
        }
           
    }
    else{
        $response['message']="Invalid number or password";
        $response['success']=false;
    }
}
else{
    $response['message']="please enter the required fields";
    $response['success']=false;
}


echo json_encode($response);
?>