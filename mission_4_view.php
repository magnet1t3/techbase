
<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>KUSO BOARD</title>
		</head>
		<body>
			<form action="/mission_4_view.php" method="post" >
				<p>
					名前：<input type="text" name="name" /><br />
					コメント<textarea name="comment" rows="1" cols="50"></textarea><br />
					編集用パス：<input type="text" name="pass" />
					<input type="submit" name="button1" value="送信" />
				</p>
			<p>
				<a href="mission_4_edit.php">編集・削除ページへ</a>
			</p>
			</form>
		</body>
<?php
				//以上フォーム部分
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password ='パスワード';
	$pdo = new PDO($dsn,$user,$password);
//m=編集番号
//以下配列番号,n=レス番号、nm＝n番の名前情報、cm=ｎ番目の投稿内容
//投稿機能ブロック
	if(isset($_POST['comment']))
	{
		//以下投稿情報
		$comment = $_POST['comment'];			//コメント内容
		$name = $_POST['name'];					//なまえ
		$pass = $_POST['pass'];					//パスワード
		$time = date('Y/m/d H:i:s');			//投稿日時

		if ((strlen($name) !==0) && (strlen($comment) !== 0) && (strlen($pass) !== 0))
		{
//名前、コメントがともに０文字でないときに行う処理
			echo "ご入力ありがとうございます。";
			echo "<br />" ;
			echo $time;
			echo "に[";
			echo $comment;
			echo "]を受け付けました。";

					$sql = $pdo -> prepare("INSERT INTO bbs2 (name,comment,time,pass) VALUES (:name, :comment, :time, :pass)");
					$sql -> bindParam(':name', $name, PDO::PARAM_STR);
					$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
					$sql -> bindParam(':time', $time, PDO::PARAM_STR);
					$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
					$sql -> execute();
//ファイルをオープンし、投稿情報と区切り文字を入れた変数$nrを定義し、ファイルに書き込む
		}else{
			echo "文字数足りないンゴ";				//名前かコメントのどちらかが空欄のときに書くメッセージ
		}
	}

//投稿内容表示ブロック

			echo '<br>';
			echo '<br>';

		$sql = 'SELECT * FROM bbs2';
		$results = $pdo -> query($sql);
		foreach ($results as $row){
			echo $row['id'].',';
			echo $row['name'].',';
			echo $row['comment'].'<br>';
			echo $row['time'].'<br>';
			echo '<br>';
		}
//配列として表示
?>