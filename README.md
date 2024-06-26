## 書籍管理システムの設定ガイド

※exeファイルはdistフォルダーにあります。
### 1. 初期設定
書籍管理システムを使用するためには、最初にindex.phpのデータベース接続情報を設定する必要があります。以下の手順に従って、必要な情報を入力してください。

### 2. 必要な情報
以下の情報を用意してください：
- **ホスト名**: データベースサーバーのホスト名（例：localhost、192.168.50.52など）。
- **ユーザー名**: データベースにアクセスするためのユーザー名。
- **パスワード**: データベースにアクセスするためのパスワード。
- **データベース名**: 使用するデータベースの名前。

### 3. 設定ファイルの編集
1. **index.phpファイルを開く**:
   - `index.php`ファイルをテキストエディタ（例：Notepad、Visual Studio Code、Sublime Textなど）で開きます。

2. **データベース接続情報を入力**:
   - ファイルの上部にある以下のコード部分を見つけます。

     ```php
     $servername = "";
     $username = "";
     $password = "";
     $dbname = "";
     ```

   - 用意した情報をそれぞれの変数に入力します。

3. **具体的な例**:
   - 以下の例では、ホスト名が`192.168.50.52`、ユーザー名が`hi`、パスワードが`hi`、データベース名が`book_management`の場合の設定を示します。

     ```php
     $servername = "192.168.50.52";
     $username = "hi";
     $password = "hi";
     $dbname = "book_management";
     ```

4. **設定ファイルを保存**:
   - 情報を入力したら、`index.php`ファイルを保存します。

### 4. 設定完了
以上で、書籍管理システムの初期設定は完了です。設定が完了したら、ウェブブラウザで`index.php`ファイルを開いて、システムが正常に動作することを確認してください。

### 5. トラブルシューティング
- **接続エラー**: データベースに接続できない場合は、入力した情報が正しいか再確認してください。
- **データベースの存在確認**: 指定したデータベースが実際に存在するかを確認し、必要に応じてデータベースを作成してください。

### 6. 問い合わせ
設定中に問題が発生した場合や質問がある場合は、システム管理者、または作者にお問い合わせください。
hi.snow714@gmail.com

## delete_book.phpの設定ガイド

### 1. 初期設定
`delete_book.php` ファイルを正しく設定するためには、データベース接続情報を入力する必要があります。以下の手順に従って、必要な情報を入力してください。

### 2. 必要な情報
以下の情報を用意してください：
- **ホスト名**: データベースサーバーのホスト名（例：localhost、192.168.50.52など）。
- **ユーザー名**: データベースにアクセスするためのユーザー名。
- **パスワード**: データベースにアクセスするためのパスワード。
- **データベース名**: 使用するデータベースの名前。

### 3. 設定ファイルの編集
1. **delete_book.phpファイルを開く**:
   - `delete_book.php`ファイルをテキストエディタ（例：Notepad、Visual Studio Code、Sublime Textなど）で開きます。

2. **データベース接続情報を入力**:
   - ファイルの上部にある以下のコード部分を見つけます。

     ```php
     $servername = "";
     $username = "";
     $password = "";
     $dbname = "";
     ```

   - 用意した情報をそれぞれの変数に入力します。

3. **具体的な例**:
   - 以下の例では、ホスト名が`192.168.50.52`、ユーザー名が`hi`、パスワードが`hi`、データベース名が`book_management`の場合の設定を示します。

     ```php
     $servername = "192.168.50.52";
     $username = "hi";
     $password = "hi";
     $dbname = "book_management";
     ```

4. **設定ファイルを保存**:
   - 情報を入力したら、`delete_book.php`ファイルを保存します。

### Pythonアプリケーションの説明

このアプリケーションは、手動で入力されたISBNコードを使用して書籍情報を取得し、データベースに保存するためのツールです。以下に、このアプリケーションの使用方法とSQLに関する詳細を説明します。

#### 機能説明

1. **ISBNコードの一括入力**:
    - テキストエリアに縦に並べて複数のISBNコードを入力します。
    - `一括処理`ボタンを押すと、各ISBNコードについて書籍情報を取得し、データベースに保存します。

2. **書籍情報の保存**:
    - `保存`ボタンを押すと、取得した書籍情報がデータベースに保存されます。

#### 使用方法

1. アプリケーションを起動します。
2. ウィンドウが表示されたら、`ISBNコードを一括入力（縦に入力）:`ラベルの下にあるテキストエリアに、縦に並べてISBNコードを入力します。
3. `一括処理`ボタンを押します。アプリケーションは各ISBNコードについてOpenBD APIを使って書籍情報を取得し、その情報をデータベースに保存します。
4. 保存結果やエラーメッセージはウィンドウ内のラベルに表示されます。

#### SQLについて

このアプリケーションは、以下のSQL文を使用してデータベースに書籍情報を保存します。

```sql
INSERT INTO books (isbn, title, author, publication_date, publisher, description)
VALUES (?, ?, ?, ?, ?, ?)
```

- 各パラメータは取得された書籍情報に基づいて設定されます。
- 書籍情報が正常に保存されると、「書籍情報が保存されました」と表示されます。
- エラーが発生した場合は、エラーメッセージが表示されます。

#### データベース設定

データベースに接続するためには、以下の情報を設定する必要があります。

```python
connection = mysql.connector.connect(
    host='ホスト名',
    user='ユーザー名',
    password='パスワード',
    database='データベース名'
)
```

これらの情報は、データベース管理者から提供されるものを使用してください。

#### 重要な注意点

- アプリケーションを使用する前に、データベースの接続情報を正確に設定してください。
- 書籍情報を取得するためにインターネット接続が必要です。
- ISBNコードは正確に入力してください。正確でない場合、書籍情報が正しく取得できないことがあります。

### MySQL
これはMySQLにmysql.sqlをインポートすれば完了です。


### 必要なものと環境設定

#### 必要なパッケージとライブラリ

Pythonアプリケーションを実行するためには、以下のパッケージとライブラリが必要です：

1. **Pythonライブラリ**
    - `sys`
    - `mysql.connector`
    - `PyQt5`
    - `requests`
    - `datetime`

2. **Pythonインストール**
    - Python 3.12以上が必要です。

3. **その他のソフトウェア**
    - MySQL
    - PHP 8.0以上

これらを一括インストールするためのバッチファイルも用意しています。

#### インストール用バッチファイル

以下の内容を持つ `install_requirements.bat` ファイルを実行してください。このバッチファイルは必要なPythonパッケージをインストールします。

```bat
@echo off
REM バッチファイルは必要なPythonパッケージをインストールします

echo Installing required Python packages...
pip install mysql-connector-python
pip install PyQt5
pip install requests
pip install opencv-python
pip install datetime

echo All required packages have been installed.
pause
```

このバッチファイルを実行することで、必要なパッケージを一括でインストールできます。

#### 環境設定

1. **Pythonのインストール**：
    - [Pythonの公式サイト](https://www.python.org/)からPython 3.12以上をダウンロードしてインストールします。

2. **MySQLのインストール**：
    - [MySQLの公式サイト](https://dev.mysql.com/downloads/mysql/)からMySQLをダウンロードしてインストールします。
    - データベースの設定を行い、必要なテーブルを作成します。

3. **PHPのインストール**：
    - [PHPの公式サイト](https://www.php.net/downloads)からPHP 8.0以上をダウンロードしてインストールします。

4. **バッチファイルの実行**：
    - 上記のバッチファイル `install_requirements.bat` を実行して、必要なPythonパッケージをインストールします。

5. **Webサーバーの設定してください**

Pythonの設定環境は自分でお願いします
PHPとMySQLなどで、ローカル環境でデバッグするときは'「XAMPP」'をお勧めします。
https://www.apachefriends.org/index.html

ご不明な点がありましたら、hi.snow714@gmail.comまで連絡をお願いします。

🄫By Hijikinoheya
