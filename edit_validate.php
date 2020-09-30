<?php
	session_start();
	function redirect($url){
		ob_start();
		header('location: '.$url);
		ob_end_flush();
		die();
	}
	// if($_SESSION['login']!="yogesh"){
	// 	redirect("index.php");
	// }
	$ids=$_SESSION["ids"];
	require 'sql_data.php';
	if(!empty($_POST)){
		$len=sizeof($ids);
		$i=0;
		$success=0;
		while($i<$len){
			$sname=$_POST['sname'.$ids[$i]];
			// $uname=$_POST['sid'.$ids[$i]];
			$pass=$_POST['password'.$ids[$i]];
			$location=$_POST['location'.$ids[$i]];
			$admin=$_POST['admin'.$ids[$i]];
			// $dname=$_POST['dname'.$ids[$i]];
			$srno=$_POST['sr_no'.$ids[$i]];
			$delete=$_POST['delete'.$ids[$i]];
			$link = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if($link === false){
			    die("ERROR: Could not connect. " . mysqli_connect_error());
			}
			if($delete=="yes"){
				$sql = "DELETE FROM admin WHERE sr_no=".$srno.";";
			}else{
				$sql = "UPDATE admin SET station_name='".$sname."', password='".$pass."', location='".$location."', admin='".$admin."'
				WHERE sr_no=".$ids[$i]."";
			}
			if (mysqli_query($link, $sql)) {
			    $success++;
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($link);
			}
			 
			// Close connection
			mysqli_close($link);
			$i++;
		}
		echo "<center><span id=\"result\">".$success." records updated successfully</span></center>";
		redirect("edit.php");
	}
?>