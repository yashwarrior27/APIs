<?php
header('Access-Control-Allow-Methods:POST');
require_once('db.php');

if(isset($_POST['fname'])&& $_POST['fname']!==""&& isset($_POST['email'])&&$_POST['lname']!=="" && isset($_POST['phone'])&&$_POST['phone']!==""&& isset($_POST['id']) && $_POST['id']!==""){
    try{
$fname=$_POST['fname'];
 $lname=$_POST['lname'];
 $email=$_POST['email'];
 $phone=$_POST['phone'];
 $address=$_POST['address'];
$db=connect();
$query=$db->prepare('INSERT INTO customer(fname, lname, email, phone, address) VALUES (:fname,:lname,:email,:phone,:address)');
 $res= $query->execute(['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone,'address'=>$address]);
if($res){
             $rid=$_POST['id'];

             $fquery=$db->query('SELECT * FROM customer ORDER BY id DESC');
             $frow=$fquery->fetch(PDO::FETCH_ASSOC);
             $cid=$frow['id'];

          $rquery=$db->prepare('UPDATE rooms SET status = 1,cust_id=:cid WHERE id=:rid');
         $res2=  $rquery->execute(['cid'=>$cid,'rid'=>$rid]);
     if($res2){
        $response['success']=true;
        $response['message']='data add successfully';
        $response['customer_id']=$cid;
     }
     else{
        $response['success']=false;
        $response['message']="data added but not update the room";
     }
    
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