<?php

require_once 'Book.php';
require_once 'BookList.php';

// Khởi tạo danh sách sách
$bookList = new BookList();

// Xử lý thêm sách mới khi nhấn nút "Thêm sách"
if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publicationYear = $_POST['publication_year'];
    $ISBN = $_POST['ISBN'];
    $chapters = explode(",", $_POST['chapters']);

    $newBook = new Book($title, $author, $publisher, $publicationYear, $ISBN, $chapters);
    $bookList->addBook($newBook);
}

// Xử lý chức năng sắp xếp sách
if (isset($_POST['sort_books'])) {
    $sortType = $_POST['sort_type'];

    switch ($sortType) {
        case 'author':
            $bookList->sortBooksByAuthor();
            break;
        case 'title':
            $bookList->sortBooksByTitle();
            break;
        case 'publication_year':
            $bookList->sortBooksByPublicationYear();
            break;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý danh sách sách</title>
</head>
<body>
<h1>Danh sách sách</h1>
<form action="" method="post">
    <label for="title">Tên sách:</label>
    <input type="text" name="title" required>
    <br>
    <label for="author">Tên tác giả:</label>
    <input type="text" name="author" required>
    <br>
    <label for="publisher">Nhà xuất bản:</label>
    <input type="text" name="publisher" required>
    <br>
    <label for="publication_year">Năm xuất bản:</label>
    <input type="number" name="publication_year" required>
    <br>
    <label for="ISBN">Số hiệu ISBN:</label>
    <input type="text" name="ISBN" required>
    <br>
    <label for="chapters">Danh mục chương sách (phân cách bởi dấu phẩy):</label>
    <input type="text" name="chapters" required>
    <br>
    <input type="submit" name="add_book" value="Thêm sách">
</form>

<h2>Danh sách sách:</h2>
<form action="" method="post">
    <label for="sort_type">Sắp xếp theo:</label>
    <select name="sort_type" id="sort_type">
        <option value="author">Tên tác giả</option>
        <option value="title">Tên sách</option>
        <option value="publication_year">Năm xuất bản</option>
    </select>
    <input type="submit" name="sort_books" value="Sắp xếp">
</form>

<?php
// Hiển thị danh sách sách
$books = $bookList->getBooks();
foreach ($books as $book) {
    echo "<h3>" . $book->getBookTitle() . "</h3>";
    echo "<p>Tác giả: " . $book->getAuthor() . "</p>";
    echo "<p>Nhà xuất bản: " . $book->getPublisher() . "</p>";
    echo "<p>Năm xuất bản: " . $book->getPublicationYear() . "</p>";
    echo "<p>Số hiệu ISBN: " . $book->getISBN() . "</p>";
    echo "<p>Danh mục chương sách: " . implode(", ", $book->getChapters()) . "</p>";
}
?>

</body>
</html>
