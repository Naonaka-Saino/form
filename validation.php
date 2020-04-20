<?php
function validation($data){
    $error=[];

    if(empty($data["your_name"]) || 20<mb_strlen($data["your_name"])){
        $error[]="「氏名」は２０文字以下で入力してください";
    }
//メールアドレス
if(empty($data["email"]) || !filter_var($data["email"],FILTER_VALIDATE_EMAIL)){
    $error[]="「メールアドレス」は正しく入力してください。";

}
//url
if(!empty($data["url"])){
    if(!filter_var($data["url"],FILTER_VALIDATE_URL)){
    $error[]="「ホームページ」は正しく入力してください。";
    }
}

//gender
if(!isset($data["gender"])){
    $error[]="「性別」は必ず入力してください。";
}
//age
if(empty($data["age"]) || 6<$data["age"]){
    $error[]="「年齢」は必ず入力してください。";
}
//お問い合わせ内容
if(empty($data["contact"]) || 200<mb_strlen($data["contact"])){
    $error[]="「お問い合わせ内容」は２００文字以内で入力してください。";
}
//注意事項
if(!isset($data["caution"])){
    $error[]="「注意事項」をご確認ください";
}
    
    return $error;
}
?>