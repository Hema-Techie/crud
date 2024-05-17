<?php
require_once 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$skill = $_POST['skill'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$remarks = $_POST['remarks'];

$update = "UPDATE manpower SET name='$name', dob='$dob', skill='$skill', address='$address', mobile='$mobile', email='$email', remarks='$remarks' WHERE id='$id'";
$result = pg_query($update);

if ($result) {
    // Fetch the updated data for the specific row
    $selectUpdatedRow = "SELECT * FROM manpower WHERE id='$id'";
    $resultUpdatedRow = pg_query($selectUpdatedRow);
    $updatedRowData = pg_fetch_assoc($resultUpdatedRow);

    echo json_encode($updatedRowData);
} else {
    echo "Something went wrong during the update.";
}
?>