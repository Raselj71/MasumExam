<?php
include 'navbar.php'; 

include("db.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_image = $_FILES['profile_image'];

    if (!empty($username) && !empty($password) && !empty($email)) {
        // Check if username or email already exists
        $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or email already exists! Please choose another');</script>";
        } else {
            // Handle image upload
            $target_dir = "uploads/";
            // Check if the directory exists, if not, create it
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($profile_image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($profile_image["tmp_name"]);
            if ($check === false) {
                die("File is not an image.");
            }

            // Check file size (limit to 500KB)
            if ($profile_image["size"] > 500000) {
                die("Sorry, your file is too large.");
            }

            // Allow certain file formats
            $allowed_types = ["jpg", "png", "jpeg", "gif"];
            if (!in_array($imageFileType, $allowed_types)) {
                die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                die("Sorry, file already exists.");
            }

            // Attempt to move the uploaded file to the target directory
            if (!move_uploaded_file($profile_image["tmp_name"], $target_file)) {
                die("Sorry, there was an error uploading your file.");
            }

            // Save to database
            $query = "INSERT INTO users (username, password, email, profile_image) VALUES ('$username', '$password', '$email', '$target_file')";
            mysqli_query($con, $query);
            header("Location: login.php");
            die;
        }
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<section class="login-container">
    <form class="form-container" method="POST" enctype="multipart/form-data">
        <p class="form-heading">Welcome back</p>
        <div>
            <input class="login-input" type="text" name="username" id="username" placeholder="Username" required>
        </div>
        <div>
            <input class="login-input" type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div>
            <input class="login-input" type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div>
            <input class="login-input" type="file" name="profile_image" id="profile_image" required>
        </div>
        <input class="login-input login-button" type="submit" value="Create an account">
        <p class="signup-text">Already have an Account? <a href="login.php">Login</a></p>
    </form>
</section>
