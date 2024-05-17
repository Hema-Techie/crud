<?php
require_once'db.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $select="select * from manpower where id=$id";
    $result=pg_query($select);
    $data=array();
        
        while($row=pg_fetch_assoc($result)){
            $data[]=$row;
     
     }
     
    }  
 echo json_encode($data);
 exit();


?>