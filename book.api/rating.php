<?php
include("conn.php");
if(isset($_POST['token'])&&($_POST['b_id'])&&($_POST['rating'])){
    $token=$_POST['token'];
    $bid=$_POST['b_id'];
    $rating=$_POST['rating'];
    $msg=$_POST['msg'];
$sql1="SELECT * FROM `register` WHERE `token`='$token'";
$res1=mysqli_query($con,$sql1);

if(mysqli_num_rows($res1)>0){
    $row1=mysqli_fetch_assoc($res1);
     $dat=strval(date("d-m-y"));
    $tie=strval(time());
    $uid=$row1['id'];
     $sql3="SELECT * FROM `rating` WHERE `user_id`=$uid AND `book_id`=$bid";
     $res3=mysqli_query($con,$sql3);
     if(mysqli_num_rows($res3)>0){
         
        $sql4="UPDATE `rating` SET `rating`='$rating',`message`='$msg',`date`='$dat',`timestamp`= '$tie' WHERE `user_id`=$uid AND `book_id`=$bid";
        $res4=mysqli_query($con,$sql4);
        if($res4){
            $response['message']="rating submit successfully";
            $response['success']=true;
        }
        else{
            $response['message']="something is wrong";
            $response['success']=false;
        }
     }
     
     else{
       
        $sql2="INSERT INTO `rating`(`user_id`, `book_id`,`rating`, `message`,`date`,`timestamp`) VALUES ('$uid','$bid','$rating','$msg','$dat','$tie')";
        $res2=mysqli_query($con,$sql2);
        if($res2){
            $response['message']="rating submit successfully";
            $response['success']=true;
        }
        else{
            $response['message']="something is wrong";
            $response['success']=false;
        }
     }
    
   

}
else{
    $response['message']="invalid token";
    $response['success']=false;
}

}
else{
    $response['message']="please enter the required field";
    $response['success']=false;
}
 
 echo json_encode($response);


?>