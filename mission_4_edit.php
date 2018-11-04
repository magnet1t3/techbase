
<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>KUSO BOARD[削除・編集ページ]</title>
		</head>
		<body>
			<p>
				<a href="mission_4_view.php">KUSO BOARD[表示画面]へ戻る</a>
			</p>
			<form action="/mission_4_edit.php" method="post" >
				<p>
				削除対象番号：<input type="text" name="del" /><br />
				パスワード：<input type="text" name="delps" />
				<input type="submit" value="削除" />
				</p>
			</form>
			<form action="/mission_4_edit.php" method="post" >
				<p>
				編集対象番号：<input type="text" name="edit" />
				<input type="submit" name="button1" value="編集モードON" />
				</p>
			</form>
<?php
				//以上フォーム部分
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password ='パスワード';
	$pdo = new PDO($dsn,$user,$password);

	if(isset($_POST['edit']))
	{
		$ep = $_POST['edit'];
		$sqlA = $pdo->prepare("SELECT * FROM bbs2 where id = '$ep'");
		$sqlA->execute();
		$resultA = $sqlA->fetch(PDO::FETCH_ASSOC);
			$oldname = $resultA['name'];
			$oldcomment = $resultA['comment'];

	}

?>
				<form action="/mission_4_edit.php" method="post" >
					<p>
					番号：<input type="text" readonly="readonly" name="newnum" value="<?php echo $ep;?>" /><br />
					名前：<input type="text" name="newname" value="<?php echo $oldname ;?>" /><br />
					コメント<input type="text" name="newcomment" value="<?php echo $oldcomment ;?>" /><br />
					パスワード：<input type="text" name="editps" />
					<input type="submit" name="button1" value="修正" />
					</p>
				</form>
		</body>
	</html>
<?php
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password ='パスワード';
	$pdo = new PDO($dsn,$user,$password);

		if(isset($_POST['del']))
		{
//投稿削除ブロック
			$delno = $_POST['del'];
			$delps = $_POST['delps'];
			$sqlB = $pdo->prepare("SELECT pass FROM bbs2 where id = '$delno' ");
			$sqlB ->execute();
			$resultB = $sqlB->fetch(PDO::FETCH_ASSOC);
				$ps = $resultB[pass];
				if($delps == $ps)
				{
				$nm = 'zjksqonhxqigfyueq';
				$kome = "[deleted]";	
				$sqlC = "update bbs2 set pass='$nm' ,comment='$kome' where id ='$delno'";
				$resultC = $pdo->query($sqlC);
					echo '削除完了です・・・';
				}else{
					echo 'パスが違います';
				}
		}
//投稿編集ブロック
		if(isset($_POST['newcomment']))
		{
			$no = $_POST['newnum'];
			$com = $_POST['newcomment'];
			$nam = $_POST['newname'];
			$eps = $_POST['editps'];
		$sqlD = $pdo->prepare("SELECT * FROM bbs2 where id = '$no'");
		$sqlD->execute();
		$resultD = $sqlD->fetch(PDO::FETCH_ASSOC);
				$psw = $resultD['pass'];
			
			if ((strlen($nam) !==0) && (strlen($com) !== 0) && (strlen($eps) !== 0))
			{
				if($eps == $psw )
				{	
					$sqlE = "update bbs2 set name='$nam' ,comment='$com' where id ='$no'";
					$resultE = $pdo->query($sqlE);
					echo '編集したぜ。';
				}else{
						echo 'パスが違います';
				}
			}else{
				echo '申し訳ないが空白はNG';
			}
		}
?>