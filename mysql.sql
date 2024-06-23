CREATE DATABASE book_management;
USE book_management;

CREATE TABLE books (
    isbn VARCHAR(13) PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    publication_date DATE,
    publisher VARCHAR(255),
    location VARCHAR(5)
);
