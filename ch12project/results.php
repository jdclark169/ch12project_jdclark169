<!-- Joseph Clark -->
<!-- 11/08/2026 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter 12 Project</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST["email"]);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $conn = mysqli_connect("localhost", "root", "", "taus_data");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT firstName, lastName, email FROM tbl_student WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $student = mysqli_fetch_assoc($result);

            echo '<div class="message">';

            if ($student) {
                echo "Student found: " . $student["firstName"] . " "
                    . $student["lastName"] . " - " . $student["email"];
            } else {
                echo "Email not found.";
            }

            echo '</div>';
        }
    ?>

    <a href="index.php">Back to Search</a>

</body>
</html>