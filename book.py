import sys
import mysql.connector
from PyQt5.QtWidgets import QApplication, QMainWindow, QPushButton, QVBoxLayout, QWidget, QLabel, QTextEdit
import cv2
import requests
import datetime

class BookManager(QMainWindow):
    def __init__(self):
        super().__init__()
        self.initUI()

    def initUI(self):
        # Setup the main window
        self.setWindowTitle('書籍管理')  # Set window title
        self.setGeometry(100, 100, 800, 600)  # Set window size and position

        # Create a vertical layout to organize widgets
        self.layout = QVBoxLayout()



        # Label to display scanned book information or errors
        self.infoLabel = QLabel('')
        self.layout.addWidget(self.infoLabel)

        # Button to save scanned book information to the database
        self.saveButton = QPushButton('保存')
        self.saveButton.clicked.connect(self.saveToDB)  # Connect saveToDB method
        self.layout.addWidget(self.saveButton)

        # Text area and button for batch ISBN input
        self.isbnLabel = QLabel('ISBNコードを一括入力（縦に入力）:')
        self.layout.addWidget(self.isbnLabel)
        self.isbnInput = QTextEdit()
        self.layout.addWidget(self.isbnInput)
        self.batchButton = QPushButton('一括処理')
        self.batchButton.clicked.connect(self.processBatchISBNs)
        self.layout.addWidget(self.batchButton)

        # Create a container widget and set the layout
        container = QWidget()
        container.setLayout(self.layout)
        self.setCentralWidget(container)

    def formatDate(self, date_str):
        # Format publication date
        try:
            date_obj = datetime.datetime.strptime(date_str, '%Y%m')
            formatted_date = date_obj.strftime('%Y-%m-%d')  # Change format to YYYY-MM-DD
            return formatted_date
        except ValueError:
            return ''

    def scanQRCode(self):
        # Function to scan QR code using webcam
        cap = cv2.VideoCapture(0)
        detector = cv2.QRCodeDetector()

        while True:
            _, img = cap.read()
            data, bbox, _ = detector.detectAndDecode(img)
            if data:
                self.infoLabel.setText(f'スキャンされたデータ: {data}')
                book_info = self.getBookInfo(data)
                if book_info:
                    self.infoLabel.setText(f'書籍情報: {book_info}')
                    self.saveToDB(book_info)
                else:
                    self.infoLabel.setText('書籍情報が見つかりませんでした')
                break

            cv2.imshow("QRコードスキャン", img)
            if cv2.waitKey(1) == ord("q"):
                break
        cap.release()
        cv2.destroyAllWindows()

    def getBookInfo(self, isbn):
        # Function to fetch book information from API based on ISBN
        url = f"https://api.openbd.jp/v1/get?isbn={isbn}"
        response = requests.get(url)
        data = response.json()
        print(f"API Response: {data}")  # Debug message

        if data and isinstance(data, list) and data[0] is not None and 'summary' in data[0]:
            book_info = data[0]['summary']
            publication_date = book_info.get('pubdate', '')
            publication_date = self.formatDate(publication_date)  # Format publication date
            book_info['pubdate'] = publication_date
            return book_info
        else:
            return None

    def saveToDB(self, book_info):
        # Function to save book information to database
        if not book_info:
            self.infoLabel.setText("OK")
            return

        try:
            connection = mysql.connector.connect(
                host='',
                user='',
                password='',
                database=''
            )
            cursor = connection.cursor()

            sql = """
                INSERT INTO books (isbn, title, author, publication_date, publisher, description)
                VALUES (%s, %s, %s, %s, %s, %s)
            """

            data = (
                book_info.get('isbn', ''),
                book_info.get('title', ''),
                book_info.get('author', ''),
                book_info.get('pubdate', ''),
                book_info.get('publisher', ''),
                book_info.get('description', '')
            )

            cursor.execute(sql, data)

            connection.commit()
            cursor.close()
            connection.close()
            self.infoLabel.setText("書籍情報が保存されました")
        except mysql.connector.Error as err:
            self.infoLabel.setText(f"データベースエラー: {err}")

    def processBatchISBNs(self):
        # Function to process batch ISBNs from text input
        isbn_list = self.isbnInput.toPlainText().strip().split('\n')
        for isbn in isbn_list:
            isbn = isbn.strip()
            if isbn:
                book_info = self.getBookInfo(isbn)
                self.saveToDB(book_info)
        self.infoLabel.setText("一括処理が完了しました")

if __name__ == '__main__':
    app = QApplication(sys.argv)
    manager = BookManager()
    manager.show()
    sys.exit(app.exec_())
