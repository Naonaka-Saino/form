<?php

session_start();

require "validation.php";

header('X-FRAME-OPTIONS:DENY');

function h($str){
    return htmlspecialchars($str, ENT_QUOTES,'UTF-8');
}

var_dump($_SESSION);

$pageFlag=0;
$error = validation($_POST);

if(!empty($_POST["btn_confirm"]) && empty($error)){
    $pageFlag=1;
}

elseif(!empty($_POST["btn_submit"])){
    $pageFlag=2;
}
?>


<!DOCTYPE html>
<meta charset="UTF-8">
<head></head>
<body>

<h1>お問い合わせフォーム</h1>

<?php //確認
if($pageFlag ===1):?>
<?php if($_POST["csrf"]===$_SESSION["csrfToken"]) :?>

確認画面<br>
<form method="POST" action="index.php">
<labe>名  前:</label>
<?php echo h($_POST["your_name"]); ?>
<br>
Email:
<?php echo h($_POST["your_adress"]); ?>
<br>
ホームページ:
<?php echo h($_POST["your_url"]); ?>
<br>
性別
<?php if($_POST("gender")==="0"){echo "男性";}
if($_POST("gender")==="1"){echo "女性";} 
?>
<br>
年齢
<?php if($_POST("age")==="1"){echo "〜１９歳";}
if($_POST("age")==="2"){echo "２０〜２９歳";}
if($_POST("age")==="3"){echo "３０〜３９歳";} 
if($_POST("age")==="4"){echo "４０〜４９歳";}
if($_POST("age")==="5"){echo "５０〜５９歳";}
if($_POST("age")==="6"){echo "６０歳〜";}
?>
<br>
お問い合わせ内容
<?php echo h($_POST["contact"]); ?>
<br>
注意事項のチェック
<?php echo h($_POST["caution"]); ?>
<br>

<br>
お問い合わせ内容
<br>
<input type="hidden" name="your_name" value="<?php echo h($_POST["your_name"]); ?>">
<input type="hidden" name="your_adress" value="<?php echo h($_POST["your_adress"]); ?>">
<input type="hidden" name="your_adress" value="<?php echo h($_POST["your_url"]); ?>">
<input type="hidden" name="your_adress" value="<?php echo h($_POST["gender"]); ?>">
<input type="hidden" name="your_adress" value="<?php echo h($_POST["age"]); ?>">
<input type="hidden" name="your_adress" value="<?php echo h($_POST["contact"]); ?>">
<input type="hidden" name="your_adress" value="<?php echo h($_POST["caution"]); ?>">
<input type="hidden" name="csrf" value="<?php echo $_POST['csrf']; ?>">
<input type="submit" name="back" value="戻る">
<input type="submit" name="btn_submit" value="送信する">
</form>
<?php endif;?>
<?php endif; ?>



<?php if($pageFlag ===2):?>
<?php if($_POST["csrf"]===$_SESSION["csrfToken"]) :?>
完了画面<br>
送信が完了しました。
<?php unset($_SESSION["csrfToken"]); ?>

<?php endif;?>
<?php endif;?>



<?php //入力
if($pageFlag ===0):?>

<?php
if(!isset($_SESSION['csrfToken'])){

$csrfToken=bin2hex(random_bytes(32));
$_SESSION['csrfToken']=$csrfToken;
}
$token=$_SESSION['csrfToken'];

?>

<?php if(!empty($_POST["btn_confirm"]) && !empty($error)) :?>
<ul>
<?php foreach ($error as $value) :?>
<li><?php echo $value;?></li>
<?php endforeach;?>
</ul>
<?php endif ;?>

入力画面<br>
<form method="POST" action="index.php">
氏名:
<input type="text" name="your_name" value="<?php if(!empty($_POST["your_name"])){echo h($_POST["your_name"]);} ?>" placeholder="氏名">
<br>
Email:
<input type="email" name="your_adress" value="<?php if(!empty($_POST["your_adress"])){echo h($_POST["your_adress"]);} ?>" placeholder="×××@×××.××">
<br>
ホームページ
<input type="url" name="your_url" value="<?php if(!empty($_POST["your_url"])){echo h($_POST["your_url"]);} ?>" placeholder="url">
<br>
性別
<input type="radio" name="gender" value="0" >男性</input>
<input type="radio" name="gender" value="1">女性</input>
<br>
年齢
<select name="age"　value="<?php if(!empty($_POST["age"])){echo h($_POST["age"]);} ?>" id="">
<option value="">選択してください</option> 
<option value="1">〜１９歳</option> 
<option value="2">２０〜２９歳</option>
<option value="3">３０〜３９歳</option>
<option value="4">４０〜４９歳</option>
<option value="5">５０〜５９歳</option>
<option value="6">６０歳〜</option>
</select>
<br>
お問い合わせ内容
<br>

<textarea name="contact" id="" cols="30" rows="10" value="<?php if(!empty($_POST["contact"])){echo h($_POST["contact"]);} ?>" placeholder="お問い合わせ内容をご入力ください"></textarea>
<br>
注意事項のチェック
<br>
<input type="checkbox" name="caution" value="1">注意事項にチェックする
<br>

<input type="submit" name="btn_confirm" value="確認する">
<input type="hidden" name="csrf" value="<?php echo $token ?>">
</form>
<?php endif; ?>

</body>