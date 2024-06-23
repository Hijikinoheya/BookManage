<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST メソッドで送信された ISBN を取得
$isbn = $_POST['isbn'];

// ISBN を使用して書籍を削除する SQL 文
$sql = "DELETE FROM books WHERE isbn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $isbn);

if ($stmt->execute()) {
    echo "書籍が削除されました";
} else {
    echo "書籍の削除中にエラーが発生しました: " . $conn->error;
}

$stmt->close();
$conn->close();

header('Location:index.php');
exit();
?>
