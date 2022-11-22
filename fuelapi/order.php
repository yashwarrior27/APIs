<?php 
include("conn.php");
if(isset($_POST['user_id'])&&($_POST['product'])&&($_POST['quantity'])&&($_POST['rate'])&&($_POST['drate'])&&($_POST['gst'])&&($_POST['tdamount'])&&($_POST['tamount'])&&($_POST['daddress'])){
      
    $uid=$_POST['user_id'];
    $product=$_POST['product'];
    $quantity=$_POST['quantity'];
    $rate=$_POST['rate'];
    $drate=$_POST['drate'];
    $gst=$_POST['gst'];
    $tdamount=$_POST['tdamount']; 
    $daddress=$_POST['daddress'];
    $tamount=$_POST['tamount'];
    $dat=strval(date("d-m-y")); 
    $tie=strval(time());

    $sql1="INSERT INTO `order_table`(`user_id`,`product`, `quantity`, `rate`, `delivery_rate_per_liter`, `GST_on_delivery`, `total_delivery_amount`, `total_amount`, `delivery_address`,`date`,`time`) VALUES ($uid,'$product','$quantity','$rate','$drate','$gst','$tdamount','$tamount','$daddress','$dat','$tie')";
    $res1=mysqli_query($conn,$sql1);
    if($res1){
        $sql2="SELECT * FROM `order_table`  ORDER BY id DESC";
        $res2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($res2);
        $response['message']="record added successfull";
        $response['success']=true;
        $id1=$row2['id'];
        $response['data']=array("id"=>"$id1");
    }
    else{
        $response['message']="something is wrong";
        $response['success']=false;
    }
 
}

else{
    $response['message']="please enter the required fields";
    $response['success']=false;
}
echo json_encode($response);


?>