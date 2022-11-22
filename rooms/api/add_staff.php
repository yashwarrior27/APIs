<?php
header('Access-Control-Allow-Methods:POST');
require_once('db.php');

if(isset($_POST['name'])&& $_POST['name']!==""&& isset($_POST['salary'])&&$_POST['salary']!=="" && isset($_POST['phone'])&&$_POST['phone']!==""&& isset($_POST['joining']) && $_POST['joining']!==""){
    try{
$name=$_POST['name'];
 $salary=$_POST['salary'];
 $phone=$_POST['phone'];
 $joining=$_POST['joining'];
$db=connect();
$query=$db->prepare('INSERT INTO staff(name, salary, number, joining_date) VALUES (:name,:salary,:phone,:joining)');
 $res= $query->execute(['name'=>$name,'salary'=>$salary,'phone'=>$phone,'joining'=>$joining]);
if($res){
             
        $response['success']=true;
        $response['message']='data add successfully';
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