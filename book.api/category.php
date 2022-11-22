<?php
include("conn.php");
if($res=="yes"){
    $sql="SELECT * FROM `category` WHERE `status`=1";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_all($res,MYSQLI_ASSOC);
    $data['imageurl']=$imglink;
    $data['categories']=$row;
    $response['success']=true;
    $response['data']=$data;
}
else{
$response["message"]="token required or invalid";
}
echo json_encode($response);
?>