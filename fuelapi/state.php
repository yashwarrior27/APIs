<?php
include("conn.php");
$sql="SELECT * FROM `states`";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($res,MYSQLI_ASSOC);
$data['states']=$row;
$response['data']=$data;
$response['success']=true;

echo json_encode($response); 
?>