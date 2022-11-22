<?php
include("conn.php");
if(isset($_POST['state'])&&$_POST['state']!=""){
    $state=$_POST['state'];
$sql="SELECT * FROM `cities` WHERE `state_id`=$state";
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0){
$row=mysqli_fetch_all($res,MYSQLI_ASSOC);
$data['cities']=$row;
$response["success"]=true;
$response["data"]=$data;

}
else{
    $response['message']="please enter the correct state number";
    $response['success']=false;
}

}
else{
    $response["message"]="please enter the state number";
    $response['success']=false;
}

echo json_encode($response); 
?>