<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "Aayush14$";
$dbname = "flight_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert a new passenger
if (isset($_POST['insert'])) {
    $passenger_name = $_POST['passenger_name'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $booking_date = $_POST['booking_date'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $sql = "INSERT INTO passengers (passenger_name, `from`, `to`, booking_date, departure_date, arrival_date, phone_number, email)
            VALUES ('$passenger_name', '$from', '$to', '$booking_date', '$departure_date', '$arrival_date', '$phone_number', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New passenger booking inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update passenger details based on Phone Number
if (isset($_POST['update'])) {
    $passenger_name = $_POST['passenger_name'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $booking_date = $_POST['booking_date'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $sql = "UPDATE passengers SET passenger_name='$passenger_name', `from`='$from', `to`='$to', booking_date='$booking_date',
            departure_date='$departure_date', arrival_date='$arrival_date', email='$email' WHERE phone_number='$phone_number'";

    if ($conn->query($sql) === TRUE) {
        echo "Passenger details updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete a passenger based on Phone Number
if (isset($_POST['delete'])) {
    $phone_number = $_POST['phone_number'];

    $sql = "DELETE FROM passengers WHERE phone_number='$phone_number'";

    if ($conn->query($sql) === TRUE) {
        echo "Passenger booking deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Display all passenger records
$sql = "SELECT * FROM passengers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking Management System</title>
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
            max-width: 500px;
            width: 100%;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="date"], input[type="email"] {
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
            width: 100%;
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
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Flight Booking Management System</h1>
        <form name="bookingForm" action="index.php" method="post">
            <label for="passenger_name">Passenger Name:</label>
            <input type="text" id="passenger_name" name="passenger_name" required>
            
            <label for="from">From:</label>
            <input type="text" id="from" name="from" required>
            
            <label for="to">To:</label>
            <input type="text" id="to" name="to" required>
            
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>
            
            <label for="departure_date">Departure Date:</label>
            <input type="date" id="departure_date" name="departure_date" required>
            
            <label for="arrival_date">Arrival Date:</label>
            <input type="date" id="arrival_date" name="arrival_date" required>
            
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            
            <label for="email">Email ID:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <button type="submit" name="insert">Insert Passenger</button><br><br>
            <button type="submit" name="update">Update Passenger</button><br><br>
            <button type="submit" name="delete">Delete Passenger</button>
        </form>
    </div>

    <!-- Displaying Passenger Records -->
    <table>
        <thead>
            <tr>
                <th>Passenger Name</th>
                <th>From</th>
                <th>To</th>
                <th>Booking Date</th>
                <th>Departure Date</th>
                <th>Arrival Date</th>
                <th>Phone Number</th>
                <th>Email ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['passenger_name'] . "</td>";
                    echo "<td>" . $row['from'] . "</td>";
                    echo "<td>" . $row['to'] . "</td>";
                    echo "<td>" . $row['booking_date'] . "</td>";
                    echo "<td>" . $row['departure_date'] . "</td>";
                    echo "<td>" . $row['arrival_date'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No passengers found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
