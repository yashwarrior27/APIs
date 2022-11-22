<?php
include("conn.php");
if(isset($_POST['state'])&&$_POST['state']!=""){
    $state=$_POST['state'];
    $sql="SELECT * FROM `fuelcheck` WHERE `state`='$state'";
    $res=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        // $j=json_decode(file_get_contents('https://jsonplaceholder.typicode.com/todos/2'),true);
        $timesql="SELECT * FROM `timeslot`";
        $timeres=mysqli_query($conn,$timesql);
        $a=[];
        while($trow=mysqli_fetch_assoc($timeres)){
         array_push($a,$trow);
        } 
        $data['timeslots']=$a;
        $p=array('status'=>$row['petrol'],'price'=>'108.1');
        $d=array('status'=>$row['diesel'],'price'=>'100.1');
        $e=array('status'=>$row['engoil'],'price'=>'99.1');
        $petrol=[$p];
        $diesel=[$d];
        $engoil=[$e];

        $data["petrol"]=$petrol;
        $data["diesel"]=$diesel;
        $data["engoil"]=$engoil;
        $response["message"]="founded results";
        $response['success']=true;
        $response['data']=$data;

       
    }
    else{
        $response['message']="state not matched";
        $response['success']=false;
    }

}
else{
  $response['message']="please enter the state";
  $response['success']=false;
}

echo json_encode($response);


?>