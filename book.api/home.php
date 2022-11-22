<?php
include 'conn.php';
if($res==="yes"){
    $sql1="SELECT * FROM `slider_table`";
$res1=mysqli_query($con,$sql1);
$row1=mysqli_fetch_all($res1,MYSQLI_ASSOC);
$data['imageurl']=$imglink;
$data["images"]=$row1;

$sql2="SELECT * FROM  `author` WHERE `status` = 1";
$res2=mysqli_query($con,$sql2);
$row2=mysqli_fetch_all($res2,MYSQLI_ASSOC);
$data["authors"]=$row2;

$sql3="SELECT * FROM `seller` WHERE `status` = 1";
$res3=mysqli_query($con,$sql3);
$row3=mysqli_fetch_all($res3,MYSQLI_ASSOC);
$data["sellers"]=$row3;

$response['success']=true;
$response['data']=$data;
}
else{
    $response['message']="token required";
    $response['success']=false;
}

echo json_encode($response);
?>