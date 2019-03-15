<?php
    require_once('tokencrt.php');
    require_once('connect.php');
    session_start();
    $user = $_POST['uname'];
	$pass = $_POST['pass'];
	$sql = "SELECT * FROM tbl_user WHERE user_name = '" . $user . "' AND user_pass = '" . $pass . "'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if($count == 1){
		$sql = "SELECT * FROM tbl_user WHERE user_name = '" . $user . "'";
		$result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        // create token
        $id = $row['id'];
        $jwt = generateToken($id, 0, $conn);
        
        // store token and id locally
        $_SESSION['id'] = $id;
        $_SESSION['jwt'] = $jwt;
        
        header("Location: ../validate.html");
    }
    else{
        echo "Login failed";
    }
?>