<?php
session_save_path('./');
session_start();
session_regenerate_id(true);
include 'dbconn.php'; 

class Letslogin{
	
	var $userstable = 'users';
	#logedin.php에서도 사용하기 위에서 static으로 선언 하였습니다.
	public static $homeurl = 'http://서버주소로 바꿔주세요'; 

	# 좀더 안전하도록 다른 파일로부터 가져오도록 하였습니다. 
	function dbconnect(){ 
    	$sd = new DatabaseConnect;
    	$sd -> dbconn();
    	return;
	}
	# 세션 타임아웃은 로그인 메소드 뿐아니라 여러 부분에서 자주 쓰일 것 같아 정적 클래스로 선언하얐습니다. 
	static public function isSessExpired(){


		if(!isset($_SESSION['howlong'])){ 
			$_SESSION['howlong'] = time();
			return false;
		} elseif ( time() - $_SESSION['howlong'] > 300 ) {
			//세션을 종료합니다. 
			session_destroy();

			echo "session out";
			return true;
		}
	}

	function login($userid,$password){

	    $link = $this->dbconnect(); 
	    get_magic_quotes_gpc($userid);
	    get_magic_quotes_gpc($password);  


	    $result= mysql_query("SELECT * FROM users WHERE username= '".$userid."' AND password ='".$password."'");
	    $row = mysql_fetch_assoc($result);
	    $ip = self::ipaddr();

		if(!$row){
			#로그아웃한 상태에서 다시 로그인 하였을 때 리다이렉션 
			if(!isset($_SESSION['howlong'])){ header("Location: $homeurl login.php?logout=1&login.php&novailedid=1");exit;}

			$error= mysql_query("SELECT id FROM users WHERE username= '".$userid."'");
			$row = mysql_fetch_assoc($error);
			if($row){ header("Location: $homeurl login.php?passerror=1");}
			else{ header("Location: $homeurl login.php?novailedid=1"); }
			mysql_close($link);
		}
		if($this->statusCheck($row[id],$row[username])){


			$_SESSION['userlevel']= $row[level];
			$_SESSION['id'] = $row[id];
			$_SESSION['USER_IP'] = self::ipaddr();

			mysql_query("UPDATE users SET ipaddress = '".$_SESSION['USER_IP']."' WHERE id =".$row[id]);  #ip와 아이디를 연결합니다. 첫 로그인일 경우 입니다.
			mysql_query("UPDATE users SET state = 1 WHERE id =".$row[id]);	#로그인 상태를 1로 
															
			header("Location: $homeurl logedin.php");		#로그인에 성공하였을때 입니다.

			mysql_close($link);
			return self::isSessExpired();  #세션설정을 해서 넘겨주므로 로그인후에 시간을 잴 수 있게 하였습니.
		}
		mysql_close($link);

		return;
	}


	static public function logout(){
 		
 		mysql_query("UPDATE users SET ipaddress = '0' WHERE id =".$_SESSION['id']);
 		mysql_query("UPDATE users SET state = 0 WHERE id =".$_SESSION['id']);	
 		session_unset($_SESSION['howlong']); 
		session_unset($_SESSION['userlevel']); 
 		session_unset($_SESSION['id']);
    	session_destroy();
    	return;
	}

	#ip를 채크합니다.

	static public function ipaddr(){

		$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
		$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote_addr = $_SERVER['REMOTE_ADDR'];

		if(!empty($http_client_ip)){
			return $ip_address = $http_client_ip;
		}elseif (!empty($http_x_forwarded_for)){
			return $ip_address = $http_x_forwarded_for;
		} 
		return $ip_address = $remote_addr;
	}

	#로그인 상태를 체크합니다.

	function statusCheck($id,$userid){

		$ip = self::ipaddr();
 		
 		$statusOut = mysql_query("SELECT state FROM users WHERE id=".$id);	//받은 아이디의 상태확인
 		$val = mysql_fetch_assoc($statusOut); 
		if(!$val[state]==1){
			return true;
		}elseif(!$ipch= mysql_query("SELECT id FROM users WHERE ipaddress ='".$ip."' AND username = '".$userid."'")){
			#로그인 되어있음 그리고 다른아이피에서 사용중
			 $vare = mysql_fetch_assoc($ipch); 
			 var_dump($ip);
			 var_dump($userid);
			 var_dump($val);
			 var_dump($vare);
			header("Location: $homeurl login.php?differentip=1");
			exit;
		}else{
			#로그인 되어있지않음 아이피가 같음
			return true;
		}
	}

}

?> 
