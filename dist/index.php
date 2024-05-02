<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>El Omaraa clinic - Sign up / Login Form</title>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <div class="main">    
    <input type="checkbox" id="chk" aria-hidden="true" style="opacity: 0;">

      <div class="signup">
        <form method="post" action="">
          <label for="chk" aria-hidden="true">Sign up</label>
          <input type="text" minlength="3" name="name" placeholder="Name" required>
          <input type="text" name="address" placeholder="Adresse" required>
          <input type="date" name="date" placeholder="Date" required min="1900-01-01" max="<?php echo date('Y-m-d'); ?>">
          <div class="phone-input-container">
            <input type="number" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>
          </div>                    
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" minlength="6" name="password" placeholder="Password" required>
          <button type="submit" name="signup_btn">Sign up</button>
        </form>
        
      </div>

      <div class="login">
        <form method="post" action="">
          <label for="chk" aria-hidden="true">Login</label>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" minlength="6" name="password" placeholder="Password" required>
          <button type="submit" name="login_btn">Login</button>
        </form>
      </div>
      <div class="custom-toastify">
      <?php
      session_start(); 
// Initialize error variable
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = "";
    $dbname = "clinic"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
    } else {
   
      if (isset($_POST['signup_btn'])) {
        // Check if all required fields are provided
        if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address'], $_POST['date'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Raw password
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $date = $_POST['date'];
    
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            // Check if email already exists
            $email_check_query = "SELECT * FROM patients WHERE email=?";
            $stmt = $conn->prepare($email_check_query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Email already exists, set error message
                $error_message = "Email already exists";
            } else {
                // Check if phone number already exists
                $phone_check_query = "SELECT * FROM patients WHERE phone_number=?";
                $stmt = $conn->prepare($phone_check_query);
                $stmt->bind_param("s", $phone);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // Phone number already exists, set error message
                    $error_message = "Phone number already exists";
                } else {
                    // Check phone number validity
                    if (strlen($phone) != 10 || !ctype_digit($phone)) {
                        // Phone number is invalid, set error message
                        $error_message = "Phone number should be exactly 10 digits long and contain only digits";
                    } else {
                        // Prepare and bind the SQL statement
                        $stmt = $conn->prepare("INSERT INTO patients (name, email, password, phone_number, address, dateofbirth) VALUES (?, ?, ?, ?, ?, ?)");
                        if (!$stmt) {
                            $error_message = "Error preparing statement: " . $conn->error;
                        } else {
                            // Bind parameters
                            $stmt->bind_param("ssssss", $name, $email, $hashed_password, $phone, $address, $date);
    
                            // Execute statement
                            if ($stmt->execute()) {
                                $_SESSION["loggedin"] = true;
                                $_SESSION["USER_Role"] = 'patient'; 
                                $_SESSION["USER_ID"] = $row['id']; 
                                
                                header("Location: ../main.php");
                                exit;
                            } else {
                                $error_message = "Error: " . $stmt->error;
                            }
    
                            // Close statement
                            $stmt->close();
                        }
                    }
                }
            }
        } else {
            // Not all required fields provided
            $error_message = "All fields are required";
        }
    }
    if (isset($_POST['login_btn'])) {
      // Check if email and password are provided
      if (isset($_POST['email']) && isset($_POST['password'])) {
          $email = $_POST['email'];
          $password = $_POST['password'];
  
          // Check if the email exists in any of the tables
          $tables = array("patients", "doctor", "reception", "admin", "nurse");
          foreach ($tables as $table) {
              $query = "SELECT * FROM $table WHERE email=? LIMIT 1";
              $stmt = $conn->prepare($query);
              $stmt->bind_param("s", $email);
              $stmt->execute();
              $result = $stmt->get_result();
  
              if ($result->num_rows > 0) {
                  // Email exists in this table
                  $row = $result->fetch_assoc();
                  if ($table == "patients") {
                      // For patients redirect to ../main.php
                      $_SESSION["loggedin"] = true;
                      $_SESSION["USER_Role"] = $table; 
                        $_SESSION["USER_ID"] = $row['id']; 

                      header("Location: ../main.php");
                      exit;
                  } else {
                      // For other users, check hashed password
                      $hashed_password = $row['password'];
                          // For other users, verify hashed password
                          if (password_verify($password, $hashed_password)) {
                              $_SESSION["loggedin"] = true;
                              $_SESSION["USER_Role"] = $table; 
                              $_SESSION["USER_Email"] = $email; 
                              $_SESSION["USER_ID"] = $row['id']; ;

                              header("Location: ../dashboard/dashboard.php");
                              exit;
                          } else {
                              $error_message = "Incorrect email or password";
                              break;
                      }
                  }
              }
          }
  
          // Email doesn't exist in any table
          $error_message = "Incorrect email or password";
      } else {
          // Email or password not provided
          $error_message = "Email and password are required";
      }
  }
  

// Output error message using JavaScript
if (!empty($error_message)) {
    echo "<script>";
    echo "document.querySelector('.custom-toastify').innerHTML = '" . $error_message . "';";
    echo "document.querySelector('.custom-toastify').style.display = 'block';";
    echo "setTimeout(function() {";
    echo "    document.querySelector('.custom-toastify').style.display = 'none';";
    echo "}, 3000);";
    echo "</script>";
}}}
?>

      </div>

  </div>
</body>
</html>
