<?php
header('content-Type:application/json');
include("conn.php");
$d=json_decode(file_get_contents("php://input"),true);
    $state=$d['state'];
    $sql="SELECT * FROM `fuelcheck` WHERE `state`='$state'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
       $j=json_decode(file_get_contents('https://jsonplaceholder.typicode.com/todos/2'),true);
       
        $data["petrol"]=$row['petrol'];
        $data["diesel"]=$row['diesel'];
        $data["engoil"]=$row['engoil'];
        $response["message"]="founded results";
        $response['success']=true;
        $response['response']=$data;
        $response['data']=$j;
    }
    else{
        $response['message']="state not matched";
        $response['success']=false;
    }

echo json_encode($response);


?>
