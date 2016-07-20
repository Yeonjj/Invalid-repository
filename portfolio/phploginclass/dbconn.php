<?php
class DatabaseConnect {

    function dbconn(){

        $host_name  = "데이터베이스 서버주소로 바꿔주세요";
        $user_id  = "데이터베이스 사용자 아이디입니다";
        $password   = "패스워드 입니다";
        $database_name = "데이터베이스 이름입니다."; 


        $link = mysql_connect($host_name ,$user_id ,$password) or die ("db connection 실패 스트립트 종료"); 
    	mysql_select_db($database_name, $link) or die("db Fail 실패 스크립트 종료");
        return $link;
    }
}   
?>
