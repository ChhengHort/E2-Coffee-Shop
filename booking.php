<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        .booking {
            background: #fff;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        .bookinput {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn {
            background: #333;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            text-align: center;
        }
        .btn:hover {
            background: #555;
        }
        .confirmation {
            text-align: center;
            margin-top: 20px;
        }
        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values safely
    $person = htmlspecialchars(trim($_POST['person']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));

    // OPTIONAL: Save to database (uncomment to use)

    // $conn = new mysqli('localhost', 'your_username', 'your_password', 'your_database');
    $conn = new mysqli('localhost', 'root', '', 'food_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO bookings (person, date, time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $person, $date, $time);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    

    // Confirmation message
    echo "<div class='confirmation'>";
    echo "<h2>Booking Confirmed</h2>";
    echo "<p><strong>For:</strong> " . $person . "</p>";
    echo "<p><strong>Date:</strong> " . $date . "</p>";
    echo "<p><strong>Time:</strong> " . $time . "</p>";
    echo "<div class='back-btn'><a href='index.php' class='btn'>Back to Home</a></div>";
    echo "</div>";
} else {
?>

<section class="booking">
    <h1 class="title">COFFEE BUILD YOUR BASE</h1>
    <form action="booking.php" method="POST" class="bookinput">
        <label>How many people?</label>
        <input type="text" name="person" placeholder="e.g. 2 people" required>

        <label>Select a date:</label>
        <input type="date" name="date" required>

        <label>Select a time:</label>
        <input type="time" name="time" required>

        <input type="submit" class="btn" value="BOOK A TABLE">
    </form>
</section>

<?php } ?>

</body>
</html>


