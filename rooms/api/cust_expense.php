<?php
header('Access-Control-Allow-Methods:POST');
require_once('db.php');
if(isset($_POST['cust_id']) && $_POST['cust_id']!==""){
try{

 $cid=$_POST['cust_id'];
 $db=connect();

 $query=$db->prepare('SELECT * FROM cust_expenses WHERE cust_id=:cid');
 $query->execute(['cid'=>$cid]);
 if($query->rowCount()>0){
  
  $row=$query->fetchAll(PDO::FETCH_ASSOC);
  $response['status']=true;
  $response['data']=$row;

 }
 else{
    
    $response['success']=false;
    $response['message']="NO Records Found";
 }

}
catch(Exception $e){

$response['success']=false;
$response['message']=$e->getMessage();

}


}
else{

    $response['status']=false;
    $response['message']='please enter the id';
}



echo json_encode($response);

?>