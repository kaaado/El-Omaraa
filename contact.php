<?php
session_start();
$error_message = "";

// Handle form submission and insertion into reservation table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clinic";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Extract form data
        $first = $_POST['first'];
        $last = $_POST['last'];
        $address = $_POST['Adress'];
        $phone = $_POST['phone'];
        $doctor_id = $_POST['doctor'];
        $patient_id = null; // Initialize patient_id

        // Check if the patient's phone exists in the reservation table with status FALSE
        $sql_check_reservation = "SELECT id FROM reservation WHERE phone_number = ? AND status = FALSE";
        $stmt_check_reservation = $conn->prepare($sql_check_reservation);

        if (!$stmt_check_reservation) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt_check_reservation->bind_param("s", $phone);
        $stmt_check_reservation->execute();
        $result_check_reservation = $stmt_check_reservation->get_result();

        if ($result_check_reservation->num_rows > 0) {
            // Phone number already exists in reservation table with status FALSE
            $error_message = "You already have an appointment scheduled.";
        } else {
            // Check if the phone number exists in the patients table
            $sql_check_patient = "SELECT id FROM patients WHERE phone_number = ?";
            $stmt_check_patient = $conn->prepare($sql_check_patient);

            if (!$stmt_check_patient) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt_check_patient->bind_param("s", $phone);
            $stmt_check_patient->execute();
            $result_check_patient = $stmt_check_patient->get_result();

            if ($result_check_patient->num_rows > 0) {
                // Phone number exists in patients table
                $row_patient = $result_check_patient->fetch_assoc();
                $patient_id = $row_patient["id"];
            } 

            // Insert data into reservation table
            $sql_insert_reservation = "INSERT INTO reservation (firstname, lastname, address, phone_number, doctor_id, patient_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert_reservation = $conn->prepare($sql_insert_reservation);

            if (!$stmt_insert_reservation) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt_insert_reservation->bind_param("ssssii", $first, $last, $address, $phone, $doctor_id, $patient_id);

            if ($stmt_insert_reservation->execute()) {
                $error_message = "Your appointment has been successfully scheduled.";
            } else {
                // Error
                $error_message = "Error inserting reservation: " . $stmt_insert_reservation->error;
            }

            $stmt_insert_reservation->close();
            $stmt_check_patient->close();
        }

        $stmt_check_reservation->close();
        $conn->close();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="bbbb.CSS">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-EXAMPLE" crossorigin="anonymous" />
</head>
<body>
    <section id="contact"> 
        <div>
            <h1 class="title-appel">Contact us</h1> 
            <div class="social_icons"> 
                <a href="https://www.facebook.com/clinique.el.omaraa"><i style="font-size:20px" class="fab fa-facebook"></i></a> 
                <div id="phoneButton" class="number" onclick="showPhoneNumber()">
                    <i class="fas fa-phone"></i>
                    <p id="phoneButtonP" style="display: none;">0773996741</p> 
                </div>
                <a href="https://web.telegram.org"><i style="font-size:20px" class="fab fa-telegram"></i></a></i></a>
            </div> 
        </div>
        <?php
        if (!empty($error_message)) {
            echo '<p id="error_message" style="text-align:center;">' . $error_message . '</p>';
        }
        ?>
        <h2>Make an appointment</h2> 
        <form method="post">
            <label for="nom">First Name :</label> 
            <input type="text" id="nom" minlength="3" name="first" required> 

            <label for="prenom">Last Name :</label> 
            <input type="text" id="prenom" minlength="3" name="last" required> 

            <label for="Adress">Adress :</label> 
            <input type="text" id="Adress" name="Adress" required> 

            <label for="telephone">Phone :</label> 
            <input type="tel" id="phone" pattern="[0-9]{10}" name="phone" required> 

            <label for="doctor">Doctor :</label> 
            <select id="Doctor" name="doctor" required> 
                <option value="">Select Doctor</option> 
                <?php
                // PHP code to fetch available doctors and populate the select options
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "clinic";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, name FROM doctor";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option  value="' . $row["id"] . '">' . $row["name"] . '</option>';
                    }
                }

                $conn->close();
                ?>
            </select> 
            <input type="submit" id="subs" value="Envoyer" name="submit"> 
        </form> 
      
    </section>
    <script>
       function showPhoneNumber() {
          var button = document.getElementById("phoneButton");
          var isActive = button.classList.contains("number");
          var phoneP = document.getElementById("phoneButtonP");

          if (isActive) {
            button.classList.remove("number");
            phoneP.style.display = "none";
          } else {
            button.classList.add("number");
            phoneP.style.display = "inline";
          }
        }          
    // Display error message for 3 seconds
    setTimeout(function() {
        var errorMessage = document.getElementById('error_message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
            window.close();
        }
    }, 3000);
</script>

</body>
</html>
