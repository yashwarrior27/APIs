<?php
include("conn.php");
if(isset($_POST['id'])&&($_POST['name'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
$sql1="SELECT * FROM `books` WHERE `$name`=$id";
$res1=mysqli_query($con,$sql1);
$a=[];
while($row1=mysqli_fetch_assoc($res1)){
    $d['id']=$row1['id'];
    $d['name']=$row1['name'];
    $d['image']=$row1['image'];
  array_push($a,$d);
}
$data['imageurl']=$imglink;
$data['books']=$a;
$response['success']=true;
$response['data']=$data;
}
else{
    $response['message']="please enter the required fields";
    $response['success']=false;
}
echo json_encode($response);
?>