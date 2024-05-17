<?php
require_once'db.php';
     
    $date='set datestyle=SQL,DMY';
    $select="select * from manpower order by id";
    pg_query($date);
    $result=pg_query($select);
    $data=array();
        
        while($row=pg_fetch_assoc($result)){
            $data[]=$row;
     
     }
     
     
 echo json_encode($data);
 exit();

?>