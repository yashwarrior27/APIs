<?php

use function PHPSTORM_META\map;

include("conn.php");
if($_POST['bid']){

    function author_seller($c,$i){
     global $con;
     $sql2="SELECT * FROM `$c` WHERE `id` =$i";
     $res2=mysqli_query($con,$sql2);
     $row2=mysqli_fetch_assoc($res2);
     return $row2['name'];
    }
    function fetch_rating($idk){
        global $con;
        $bid=$idk;
        $rsql1="SELECT AVG(rating) FROM `rating` WHERE `book_id`=$bid";
        $rres1=mysqli_query($con,$rsql1);
        $rrow1=mysqli_fetch_assoc($rres1);
        $rsql2="SELECT * FROM `rating` WHERE `book_id`='$bid' ORDER BY timestamp  DESC";
        $rres2=mysqli_query($con,$rsql2);
        $a=[];
      while($rrow2=mysqli_fetch_assoc($rres2)){
        $uid=$rrow2['user_id'];
        $rsql3="SELECT * FROM `register` WHERE id = $uid";
        $rres3=mysqli_query($con,$rsql3);
        $rrow3=mysqli_fetch_assoc($rres3);
        $d['name']=$rrow3['name'];
        $d['rating']=$rrow2['rating'];
        $d['message']=$rrow2['message'];
        $d['date']=$rrow2['date'];
       array_push($a,$d);
      }
    
        $ddata['overall_rating']=$rrow1;
        $ddata['ratings']=$a;
       return $ddata;     

    }

$bid=$_POST['bid'];
$sql1="SELECT * FROM `books` WHERE id=$bid";
$res1=mysqli_query($con,$sql1);
$row1=mysqli_fetch_assoc($res1);
$cat=$row1['category'];
$author="";
if(is_null($row1['author'])){
    $author=$row1['author'];
}else{
  $author=author_seller('author',$row1['author']);  
}
$seller="";
if(is_null($row1['seller'])){
    $seller=$row1['seller'];
}else{
  $seller=author_seller('seller',$row1['seller']);  
}

$sql3="SELECT * FROM `category` WHERE id = $cat";
$res3=mysqli_query($con,$sql3);
$row3=mysqli_fetch_assoc($res3);
$category=$row3['name'];
$dat['name']=$row1['name'];
$dat['image']=$row1['image'];
$dat['description']=$row1['description'];
$dat['author']=$author;
$dat['seller']=$seller;
$dat['category']=$category;
$dat['sample_pdf_link']=$row1['samplepdf'];
$dat['full_pdf_link']=$row1['fullpdf'];
$dat['type']=$row1['type'];
$data['book_details']=$dat;
$x=array_merge($data,fetch_rating($bid));
$response['success']=true;
$response['data']=$x; 
}
else{
    $response['message']="please enter the book id";
    $response['success']=false;
}

echo json_encode($response);



?>