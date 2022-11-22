<?php
require_once('db.php');
try{
    $db=connect();
    $query=$db->query('SELECT * FROM rooms');
     $num= $query->rowCount();
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    $response['success']=true;
    $response['number of rooms']=$num;
    $response['data']=$res;
     $db=null;
}
catch(Exception $e){

    $response['success']=false;
    $response['message']=$e->getMessage();

};

echo json_encode($response);

?>