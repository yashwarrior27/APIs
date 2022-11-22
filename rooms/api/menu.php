<?php
require_once('db.php');
try{
    $db=connect();
    $query=$db->query('SELECT * FROM menu');
    $res=$query->fetchAll(PDO::FETCH_ASSOC);
    $response['success']=true;
    $response['data']=$res;
}
catch(Exception $e){
    $response['success']=false;
    $response['message']=$e->getMessage();

};

echo json_encode($response);

?>