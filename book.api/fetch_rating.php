<?php
include("conn.php");
if(isset($_POST['b_id'])){
    $bid=$_POST['b_id'];
    $sql1="SELECT AVG(rating) FROM `rating` WHERE `book_id`=$bid";
    $res1=mysqli_query($con,$sql1);
    $row1=mysqli_fetch_assoc($res1);
    $sql2="SELECT * FROM `rating` WHERE `book_id`=$bid ORDER BY timestamp  DESC";
    $res2=mysqli_query($con,$sql2);
    $a=[];
  while($row2=mysqli_fetch_assoc($res2)){
    $uid=$row2['user_id'];
    $sql3="SELECT * FROM `register` WHERE id = $uid";
    $res3=mysqli_query($con,$sql3);
    $row3=mysqli_fetch_assoc($res3);
    $d['name']=$row3['name'];
    $d['rating']=$row2['rating'];
    $d['message']=$row2['message'];
    $d['date']=$row2['date'];
   array_push($a,$d);
  }

    $data['overall_rating']=$row1;
    $data['ratings']=$a;
    $response['success']=true;
    $response['data']=$data;

}
else{
     
    $response['message']="please enter the book id";
    $response['success']=false;

}
echo json_encode($response); 


?>
