<?php
require('db.php');
if(isset($_GET['id']))
{
     $sql = "DELETE FROM manpower WHERE manid=".$_GET['id'];
     pg_query($sql);
	 echo 'Deleted successfully.';
}

?>