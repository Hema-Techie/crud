<?php
require_once'db.php';
// print_r($_POST); die;
$id=$_POST['id'];
$name=$_POST['name'];
$dob=$_POST['dob'];
$skill=$_POST['skill'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$remarks=$_POST['remarks'];

$update="update manpower set name='$name',dob='$dob',skill=$skill,address='$address',mobile=$mobile,email='$email',remarks='$remarks' where id=$id";
$result=pg_query($update);
if($result){
    echo"Updated successfully";
}
else{
    echo"Something wrong";
}
echo json_encode($updatedRowData);
?>