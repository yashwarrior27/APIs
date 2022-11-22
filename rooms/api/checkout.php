<?php
  require_once('db.php');
  if(isset($_POST['rid'])&&$_POST['rid']!==""){
     try{
        $rid=$_POST['rid'];
        $db=connect();
        $query=$db->query("UPDATE rooms SET status = 0 , cust_id= null WHERE id=$rid");
        if($query){
            $response['status']=true;
            $response['message']="reset successful";
        }   
        else{
           $response['status']=false;
           $response['message']="Something is Wrong";

        }



     }
     catch(Exception $e){
       
        $response['status']=false;
        $response['message']=$e->getMessage();

     }

  }
  else{
    $response['status']=false;
    $response['message']="please enter the room id";
  }


echo json_encode($response);

?>