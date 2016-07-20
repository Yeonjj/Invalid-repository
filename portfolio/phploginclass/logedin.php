<html>
	<head>
<?php
	session_save_path('./');
	session_start();
	include 'login_logic.php';
	#직접접근하는 세션을 막고 리다이렉션을 하기위한 코드 입니다.
	if(!isset($_SESSION['howlong'])){header("Location: $homeurl login.php?sessionerror=1&logout=1"); exit;}
	#isSessExpired가 타임아웃을 감지하면 세션은 종료됩니다.
	if(Letslogin::isSessExpired()){header("Location: $homeurl login.php?sessionerror=1&logout=1"); exit;}
?>	
		<title>로그인 성공!!</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	</head>
	<body>

		<h1>로그인에 성공하였습니다.</h1>
		<p>당신의 접근 래벨은 <?php echo $_SESSION['userlevel']; ?> 입니다.</br>
		당신의 아이피 주소입니다 <?php echo $_SESSION['USER_IP']; ?></p>
		<a href=<?php echo $homeurl."login.php?logout=1"?>>  
  	 		<button>logout</button>
		</a>
		


	</body>
</html>
 
