<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "Aayush14$";
$dbname = "library_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert a new book
if (isset($_POST['insert'])) {
    $book_name = $_POST['book_name'];
    $isbn_no = $_POST['isbn_no'];
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $publisher_name = $_POST['publisher_name'];

    $sql = "INSERT INTO books (book_name, isbn_no, book_title, author_name, publisher_name)
            VALUES ('$book_name', '$isbn_no', '$book_title', '$author_name', '$publisher_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New book inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update book details based on ISBN No
if (isset($_POST['update'])) {
    $isbn_no = $_POST['isbn_no'];
    $book_name = $_POST['book_name'];
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author_name'];
    $publisher_name = $_POST['publisher_name'];

    $sql = "UPDATE books SET book_name='$book_name', book_title='$book_title', author_name='$author_name', publisher_name='$publisher_name'
            WHERE isbn_no='$isbn_no'";

    if ($conn->query($sql) === TRUE) {
        echo "Book details updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete a book based on ISBN No
if (isset($_POST['delete'])) {
    $isbn_no = $_POST['isbn_no'];

    $sql = "DELETE FROM books WHERE isbn_no='$isbn_no'";

    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Display all book records
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        h1 {
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .form-container {
            margin: 20px 0;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .back-button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Library Management System</h1>
        <form name="libraryForm" action="index.php" method="post">
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>
            
            <label for="isbn_no">ISBN No:</label>
            <input type="text" id="isbn_no" name="isbn_no" required>
            
            <label for="book_title">Book Title:</label>
            <input type="text" id="book_title" name="book_title" required>
            
            <label for="author_name">Author Name:</label>
            <input type="text" id="author_name" name="author_name" required>
            
            <label for="publisher_name">Publisher Name:</label>
            <input type="text" id="publisher_name" name="publisher_name" required><br><br>
            
            <button type="submit" name="insert">Insert Book</button><br><br>
            <button type="submit" name="update">Update Book</button><br><br>
            <button type="submit" name="delete">Delete Book</button>
        </form>
    </div>

    <!-- Displaying Book Records -->
    <table>
        <thead>
            <tr>
                <th>Book Name</th>
                <th>ISBN No</th>
                <th>Book Title</th>
                <th>Author Name</th>
                <th>Publisher Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['book_name'] . "</td>";
                    echo "<td>" . $row['isbn_no'] . "</td>";
                    echo "<td>" . $row['book_title'] . "</td>";
                    echo "<td>" . $row['author_name'] . "</td>";
                    echo "<td>" . $row['publisher_name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No books found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Back Button -->
    <a href="index.php" class="back-button">Back</a>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
