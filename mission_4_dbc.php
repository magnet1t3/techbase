<?php
	$dsn = '�f�[�^�x�[�X��';
	$user = '���[�U�[��';
	$password ='�p�X���[�h';
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