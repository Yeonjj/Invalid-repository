<?php 
	session_save_path('./'); #현제디렉토리로 세션 저장
	session_start(); 
 	include 'login_logic.php';
?>
<html>
	<head>
		<?php 
		if($_GET['logout'] == 1){  

			$logoutdb = new Letslogin();
			$logoutdb-> dbconnect();
			Letslogin::logout();
			
		}
		// $logoutdb = new Letslogin();
		// $logoutdb-> dbconnect();
		// $result= mysql_query("SELECT * FROM users");
	 	// $row = mysql_fetch_assoc($result);
	 	// var_dump($row)
		
		if(isset($_SESSION['howlong'])){header("Location:logedin.php");} #로그인을 한뒤에 다시 주소창으로 접근할 경우;
		?>
		<title>로그인 페이지입니다.</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	</head>
	<body>
		<?php 
		if($_GET['novailedid'] == 1){ echo "아이디가 존재하지 않습니다.";  session_destroy();}; 
		if($_GET['passerror'] == 1){ echo "비밀번호가 틀렸습니다."; session_destroy();}
		if($_GET['sessionerror'] == 1){ echo "세션이 종료되었거나 로그인을 하지 않았습니다.";session_destroy();}
		if($_GET['differentip'] == 1){ echo "다른 아이피로 이미 로그인 되어있는 아이디입니다.";session_destroy();}
		?>
		<form action="login_hendling.php" method="POST">
			<p><label>아이디</label><input type="text" name="username"/></p>
			<p><label>비밀번호</label><input type="text" name="password"/></p>
		<input type="submit" />
		</form>
	</body>
</heml>
