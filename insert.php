<?php
require_once 'db.php';

$name = $_POST['name'];
$dob = $_POST['dob'];
$skill = $_POST['skill'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$remarks = $_POST['remarks'];

function validate($v_name, $v_dob, $v_skill, $v_address, $v_mobile, $v_email, $v_remarks)
{
      if (empty($v_name)) {
          $errMsg = "Please enter your Name";
          echo json_encode(array("error" => $errMsg));
      } else if (!preg_match("/^[a-zA-Z\s]+$/", $v_name)) {
          $ErrMsg = "Only alphabets and whitespace are allowed.";
          echo json_encode(array("error" => $ErrMsg));
      } else if (empty($v_dob)) {
          $errMsg = "Please enter date of birth";
          echo json_encode(array("error" => $errMsg));
      } else if (empty($v_email)) {
          $errMsg = "Please enter your email";
          echo json_encode(array("error" => $errMsg));
      } elseif (!preg_match('/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/', $v_email)) {
          $ErrMsg = "Email is not valid.";
          echo json_encode(array("error" => $ErrMsg));
      } else if (empty($v_skill)) {
          $errMsg = "Please choose your skill";
          echo json_encode(array("error" => $errMsg));
      } else if (empty($v_mobile)) {
          $errMsg = "Please enter your phone number";
          echo json_encode(array("error" => $errMsg));
      } else if (!preg_match('/[6-9]{1}[0-9]{9}/', $v_mobile)) {
          $errMsg = "Invalid phone number";
          echo json_encode(array("error" => $errMsg));
      } else {
        $query = "INSERT INTO manpower (name, dob, skill, address, mobile, email, remarks) VALUES ('$v_name', '$v_dob', '$v_skill', '$v_address', '$v_mobile', '$v_email', '$v_remarks') RETURNING id";
        $result = pg_query($query);
        if ($result) {
            $row = pg_fetch_row($result);
            $insertedId = $row[0]; // Retrieve the inserted ID
            $insertedData = array(
                "id" => $insertedId,
                "name" => $v_name,
                "dob" => $v_dob,
                "skill" => $v_skill,
                "address" => $v_address,
                "mobile" => $v_mobile,
                "email" => $v_email,
                "remarks" => $v_remarks
            );
            echo json_encode(array("success" => "Data stored successfully", "data" => $insertedData));
        } else {
            echo json_encode(array("error" => "Something went wrong"));
        }
        
      }
  }

validate($name, $dob, $skill, $address, $mobile, $email, $remarks);
?>
