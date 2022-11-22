<?php
header('Access-Control-Allow-Methods:POST');
require_once('db.php');

if(isset($_POST['name'])&& $_POST['name']!==""&& isset($_POST['qty'])&&$_POST['qty']!=="" && isset($_POST['price'])&&$_POST['price']!==""&& isset($_POST['cust_id']) && $_POST['cust_id']!==""){
    try{
$name=$_POST['name'];
 $qty=$_POST['qty'];
 $price=$_POST['price'];
 $cust_id=$_POST['cust_id'];
$db=connect();
$query=$db->prepare('INSERT INTO cust_expenses(name, qty, price, cust_id) VALUES (:name,:qty,:price,:cust_id)');
 $res= $query->execute(['name'=>$name,'qty'=>$qty,'price'=>$price,'cust_id'=>$cust_id]);
if($res){
            
        $response['success']=true;
        $response['message']='expense add successfully';
    
}
else {
    $response['success']=false;
    $response['message']="Something is Wrong";
}

    }
    catch(Exception $e){
        $response['success']=false;
        $response['message']=$e->getMessage();
    }

}
else{
    $response['success']=false;
    $response['message']="please enter the required fields";
}
echo json_encode($response);
?>