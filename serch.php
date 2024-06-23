<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍管理システム 検索</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            width: 80%;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>書籍管理システム 検索</h1>
        <form method="get" action="">
            <label for="location">Location: </label>
            <select name="location" id="location">
                <option value="All">All</option>
                <option value="R1">R1</option>
                <option value="R2">R2</option>
                <option value="R3">R3</option>
                <option value="R4">R4</option>
                <option value="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
                <option value="L4">L4</option>
            </select>
            <label for="search">Search: </label>
            <input type="text" id="search" name="search" placeholder="Enter keyword...">
            <button type="submit">Search</button>
        </form>

        <?php
        $servername = "192.168.50.52";
        $username = "hi";
        $password = "hi";
        $dbname = "book_management";

        // データベース接続
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 接続チェック
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 検索とソートの処理
        $location = isset($_GET['location']) ? $_GET['location'] : 'All';
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $sql = "SELECT * FROM (
                    SELECT * FROM books_l
                    UNION ALL
                    SELECT * FROM books_r
                ) AS combined_books WHERE 1=1";

        if ($location != 'All') {
            $sql .= " AND location = '$location'";
        }

        if (!empty($search)) {
            $sql .= " AND (isbn LIKE '%$search%' OR title LIKE '%$search%' OR author LIKE '%$search%' OR publisher LIKE '%$search%')";
        }

        $sql .= " ORDER BY location, title";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Publication Date</th><th>Publisher</th><th>Location</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['isbn'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['publication_date'] . "</td>";
                echo "<td>" . $row['publisher'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
