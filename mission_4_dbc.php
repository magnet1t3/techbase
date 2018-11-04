<?php
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password ='パスワード';
	$pdo = new PDO($dsn,$user,$password);
		$sql = "CREATE TABLE bbs2"
		." ("
		. "`id` INT auto_increment primary key,"
		. "name char(32),"
		. "comment TEXT,"
		. "time TEXT,"
		. "pass TEXT"
		.");";
		$stmt = $pdo->query($sql);
?>