<?php

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
$corp = $_POST['corp'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q5 = $_POST['q5'];
$q6 = $_POST['q6'];
$q7 = $_POST['q7'];
$q8 = $_POST['q8'];
$name = $_POST['name'];
$email = $_POST['email'];

//2. DB接続します、おまじない！
try {
  //ID:'root', Password: xamppは 空白 ''
  // gs_dbはdbの名前。
  $pdo = new PDO('mysql:dbname=kadai7;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意
// $name ではなく:name とする。なぜ？
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id,Corp,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,name,email,date) 
                        VALUES(NULL, :corp,:q1,:q2,:q3,:q4,:q5,:q6,:q7,:q8,:name,:email,sysdate())");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR


$stmt->bindValue(':corp', $corp, PDO::PARAM_STR);
$stmt->bindValue(':q1', $q1, PDO::PARAM_STR);
$stmt->bindValue(':q2', $q2, PDO::PARAM_STR);
$stmt->bindValue(':q3', $q3, PDO::PARAM_STR);
$stmt->bindValue(':q4', $q4, PDO::PARAM_STR);
$stmt->bindValue(':q5', $q5, PDO::PARAM_STR);
$stmt->bindValue(':q6', $q6, PDO::PARAM_STR);
$stmt->bindValue(':q7', $q7, PDO::PARAM_STR);
$stmt->bindValue(':q8', $q8, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');
}
?>
