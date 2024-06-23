<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQLクエリをロケーションに基づかずに書籍情報を取得する
$sql = "SELECT isbn, title, author, publication_date, publisher, description FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍管理システム R側</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 100%;
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow-x: auto; /* 横スクロールを有効にする */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            table {
                width: 100%;
                overflow-x: auto; /* 横スクロールを有効にする */
                display: block; /* 表の幅を自動調整 */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>書籍管理システム R側</h1>
        <table>
            <tr>
                <th>ISBNコード</th>
                <th>タイトル</th>
                <th>著者</th>
                <th>出版日</th>
                <th>出版社</th>
                <th>説明</th>
                <th>操作</th> <!-- 削除ボタンを追加 -->
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["isbn"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["publication_date"] . "</td>";
                    echo "<td>" . $row["publisher"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    // 削除ボタンを追加
                    echo "<td>";
                    echo "<form action=\"delete_book.php\" method=\"post\">";
                    echo "<input type=\"hidden\" name=\"isbn\" value=\"" . $row["isbn"] . "\">";
                    echo "<input type=\"submit\" value=\"削除\">";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>データがありません</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
