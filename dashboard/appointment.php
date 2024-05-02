<?php
// Start the session to access session variables
session_start();

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../dist/index.php");
    exit;
}

// Define the sidebar items for each role
$sidebarItems = array(
    "doctor" => array(
        "Doctor" => array("icon" => "user", "link" => "doctor.php"),
        "Appointment" => array("icon" => "calendar", "link" => "appointment.php"),
        "Nurse" => array("icon" => "user", "link" => "nurse.php"),
        "Reception" => array("icon" => "user", "link" => "reception.php")
    ),
    "nurse" => array(
        "Nurse" => array("icon" => "user", "link" => "nurse.php"),
        "Doctor" => array("icon" => "user", "link" => "doctor.php"),
        "Appointment" => array("icon" => "calendar", "link" => "appointment.php")
    ),
    "reception" => array(
        "Reception" => array("icon" => "user", "link" => "reception.php"),
        "Doctor" => array("icon" => "user", "link" => "doctor.php"),
        "Nurse" => array("icon" => "user", "link" => "nurse.php"),
        "Appointment" => array("icon" => "calendar", "link" => "appointment.php")
        
    ),
    "admin" => array(
        "Admin" => array("icon" => "user", "link" => "admin.php"),
        "Doctor" => array("icon" => "user", "link" => "doctor.php"),
       
        "Nurse" => array("icon" => "user", "link" => "nurse.php"),
        
        "Reception" => array("icon" => "user", "link" => "reception.php"),
       
        "Appointment" => array("icon" => "calendar", "link" => "appointment.php"),
        
        "Speciality" => array("icon" => "list-ul", "link" => "speciality.php")
    )
);

// Get the sidebar items for the user's role
$userRoleItems = $sidebarItems[$_SESSION["USER_Role"]];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="main.css">
    <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="sidebar" >
    <div class="logo_details">
        <i class='bx bx-clinic'></i>
        <div class="logo_name">
            Nawi-Med
        </div>
    </div>
    <ul>
    <li>
        <a href="dashboard.php" <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'class="active"'; ?>>
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
        </a>
    </li>
    <?php
    // Output the sidebar items based on the user's role
    foreach ($userRoleItems as $itemName => $item) {
        echo "<li>";
        echo "<a href=\"" . $item["link"] . "\" ";
        if(basename($_SERVER['PHP_SELF']) == $item["link"]) echo 'class="active"'; 
        echo ">";
        echo "<i class='bx bx-" . $item["icon"] . "'></i>";
        echo "<span class=\"links_name\">$itemName</span>";
        echo "</a>";
        echo "</li>";
    }
    ?>
</ul>

</div>
<!-- End Sideber -->
<section class="home_section">
    <div class="topbar">
        <div class="toggle">
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <div>
            <a style="text-decoration:none; color:black;" href="../main.php" class="number"> <i style="font-size:28px; font-weight:bold;" class='bx bx-arrow-back'></i></a>
            <a style="text-decoration:none; color:black;" href="../dist/logout.php" class="number"> <i style="margin-left:25px;font-size:28px; font-weight:bold;" class='bx bx-log-out'></i></a>
        </div>
    </div>
    <!-- End Top Bar -->
    <div  class="details" >
        <div class="recent_project">
            <div class="card_header">
                <h2>Appointments Information</h2>
            </div>
            <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Phone Number</td>
                    <td>address</td>
                    <td>Patient</td>
                    <td>Doctor</td>
                    <td>Status</td>
                    <?php if ($_SESSION["USER_Role"] === "admin" || $_SESSION["USER_Role"] === "reception" ) { ?>
                        <td></td>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php
$servername = "localhost";
$username = "root"; // Add your username
$password = ""; // Add your password
$dbname = "clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctors' information and store in an associative array
$sql_doctor = "SELECT id, name, email FROM doctor";
$result_doctor = $conn->query($sql_doctor);
$doctors = array();
if ($result_doctor->num_rows > 0) {
    while ($row_doctor = $result_doctor->fetch_assoc()) {
        // Store doctors' names with their corresponding IDs in the $doctors array
        $doctors[$row_doctor['id']] = $row_doctor['name'];
    }
}

// Fetch patients' information and store in an associative array
$sql_patient = "SELECT id, name FROM patients";
$result_patient = $conn->query($sql_patient);
$patients = array();
if ($result_patient->num_rows > 0) {
    while ($row_patient = $result_patient->fetch_assoc()) {
        // Store patients' names with their corresponding IDs in the $patients array
        $patients[$row_patient['id']] = $row_patient['name'];
    }
}
 if ($_SESSION["USER_Role"] === "doctor") {
$email = $_SESSION["USER_Email"];

// Query to get the id of the doctor based on the email
$query_get_doctor_id = "SELECT id FROM doctor WHERE email = '$email' LIMIT 1";
$result_get_doctor_id = $conn->query($query_get_doctor_id);

// Check if the doctor with the given email exists
if ($result_get_doctor_id->num_rows > 0) {
    // Fetch the id of the doctor
    $row_doctor_id = $result_get_doctor_id->fetch_assoc();
    $doctor_id = $row_doctor_id['id'];

    // Check user role
   
        // Query to select appointments for the doctor with the retrieved id
        $query_select_appointments = "SELECT * FROM reservation WHERE doctor_id = $doctor_id";
    }} else {
        // Query to select all appointments
        $query_select_appointments = "SELECT * FROM reservation";
    }

    $result_select_appointments = $conn->query($query_select_appointments);

    // Check if there are any appointments
    if ($result_select_appointments->num_rows > 0) {
        // Initialize the counter variable
        $i = 1;
        // Display the appointments in the table
        while ($row = $result_select_appointments->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['phone_number']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo isset($patients[$row['patient_id']]) ? $patients[$row['patient_id']] : "Not Assigned"; ?></td>
                <td><?php echo isset($doctors[$row['doctor_id']]) ? $doctors[$row['doctor_id']] : "Not Assigned"; ?></td>
                <td>
                    <?php
                    if ($row['status'] == 0) {
                        echo "<p style='color:#FE9705;'>Pending</p>";
                    } else {
                        echo "<p style='color:#3AC430;'>Done</p>";
                    }
                    ?>
                </td>
                <?php if ($_SESSION["USER_Role"] === "doctor" ||  (isset($_GET['edit']) && $_GET['edit'] == $row['id']) ) { ?>
                    <td class="btn-action">
                        <form action="appointment.php" method="post">
                            <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                            <?php if ($row['status'] == 0) { ?>
                                <button id="btn-stat" type="submit" style="background:#3AC430;" name="mark_done">Mark Done</button>
                            <?php } else { ?>
                                <button id="btn-stat" type="submit" style="background:#FE9705;" name="mark_pending">Mark Pending</button>
                            <?php } ?>
                        </form>
                    </td>
                <?php } elseif ($_SESSION["USER_Role"] === "admin" || $_SESSION["USER_Role"] === "reception") { ?>
                    <td class="btn-action">
                        <a style="text-decoration:none;font-size: 28px;" href="?edit=<?php echo $row['id']; ?>"><i style="color:grey;" class='bx bx-pencil'></i></a>
                        <form  method="post">
                            <input type="hidden" name="table" value="reservation">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="link" value="appointment">
                            <button type="submit" name="delete"><i style="color:red;" class="bx bx-trash"></i></button>
                        </form>
                    </td>
                <?php } ?>
            </tr>
            <?php
            // Increment the counter variable
            $i++;
        }
    } else {
        // No appointments found
        echo "<tr><td colspan='7'><p style='text-align:center;'>No appointments found</p></td></tr>";
    }

?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="error-message">
    <?php
    // Check if error message exists
    if (isset($error_message)) {
        echo $error_message;
    }
    ?>
   <?php if ($_SESSION["USER_Role"] === "reception" || $_SESSION["USER_Role"] === "admin") { ?>
    <div class="add-icon" >
        <i class='bx bx-calendar-plus' id="addAdminIcon"></i>
    </div>
<?php } ?>
    <div class="details form-add1"> 
        <div class="recent_project">
        <div class="card_header">
                <h2>Add Appointment</h2>
            </div>
            <table class="form-add">
            <tbody>
                <form action="appointment.php" method="post">
                    <tr class="form-input">
                        <td>
                        <label for="nom">First Name :</label>                         </td>
                        <td>
                        <input type="text" id="nom" minlength="3" name="first" required> 
                        </td>
                    </tr>
                    <tr class="form-input">
                        <td>
                        <label for="prenom">Last Name :</label> 
                        </td>
                        <td>
                        <input type="text" id="prenom" minlength="3" name="last" required> 
                        </td>
                    </tr>
                    <tr class="form-input">
                        <td>
                        <label for="address">address :</label> 
                        </td>
                        <td>
                        <input type="text" id="address" name="address" required> 
                        </td>
                    </tr>
                    <tr class="form-input">
                        <td>
                        <label for="telephone">Phone :</label> 
                        </td>
                        <td>
                        <input type="tel" id="phone" pattern="[0-9]{10}" name="phone" required> 
                        </td>
                    </tr>
                    <tr class="form-input">
                        <td>
                        <label for="doctor">Doctor :</label> 
                        </td>
                        <td>
                        <select style="margin-left:-25px;" id="Doctor" name="doctor" required> 
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
                        </td>
                    </tr>
                    <tr class="form-input">
                        <td>
                            <label for="patient_id">Patient :</label>
                        </td>
                        <td>
                        <select style="margin-left:-25px;" id="patient" name="patient" required> 
                            <option value="Null">Not Assigned</option>
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

                $sql = "SELECT id, name FROM patients";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option  value="' . $row["id"] . '">' . $row["name"] . '</option>';
                    }
                }

                $conn->close();
                ?>
            </select>                         </td>
                    </tr>
                    <tr class="form-input">
                        <td colspan="2">
                            <button type="submit" name="add">Add</button>
                        </td>
                    </tr>
                </form>
                <?php 
                   
                     if (isset($_POST["mark_done"])) {
                        $servername = "localhost";
                        $username = "root"; // Add your username
                        $password = ""; // Add your password
                        $dbname = "clinic";
                    
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $appointment_id = $_POST["appointment_id"];
                        // Update the status to Done in the database
                        $sql_update_status = "UPDATE reservation SET status = 1 WHERE id = $appointment_id";
                        if ($conn->query($sql_update_status) === TRUE) {
                            echo "<script>window.location.pathname = 'Web/dashboard/appointment.php';</script>";
                            // Success message or redirection if needed
                        } else {
                            // Error handling if the query fails
                        }
                        $conn->close();
                    }
                    
                    // Check if the form is for marking appointment as pending
                    if (isset($_POST["mark_pending"])) {
                        $servername = "localhost";
                        $username = "root"; // Add your username
                        $password = ""; // Add your password
                        $dbname = "clinic";
                    
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $appointment_id = $_POST["appointment_id"];
                        // Update the status to Pending in the database
                        $sql_update_status = "UPDATE reservation SET status = 0 WHERE id = $appointment_id";
                        if ($conn->query($sql_update_status) === TRUE) {
                            echo "<script>window.location.pathname = 'Web/dashboard/appointment.php';</script>";
                            // Success message or redirection if needed
                        } else {
                            // Error handling if the query fails
                        }
                        $conn->close();
                    }
                 
                
// Add operation
if (isset($_POST["add"])) {
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
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $doctor_id = $_POST['doctor'];
    $patient_id = $_POST['patient']; // Retrieve patient ID from form
    $status = isset($_POST['status']) ? $_POST['status'] : 0; // Set status to 0 if not provided

    // Insert data into reservation table
    $sql_insert_reservation = "INSERT INTO reservation (firstname, lastname, address, phone_number, doctor_id, patient_id, status) VALUES ('$first', '$last', '$address', '$phone', $doctor_id, $patient_id, $status)";
    if ($conn->query($sql_insert_reservation) === TRUE) {
        $error_message = "Your appointment has been successfully scheduled.";
        echo "<script>window.location.pathname = 'Web/dashboard/appointment.php';</script>";
    } else {
        // Error
        $error_message = "Error inserting reservation: " . $conn->error;
    }
    $conn->close();
}


           if (isset($_POST["delete"])) {
            $servername = "localhost";
            $username = "root"; // Add your username
            $password = ""; // Add your password
            $dbname = "clinic";
        
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $table = $_POST["table"];
$id = $_POST["id"];
$link = $_POST["link"];

$sql = "DELETE FROM $table WHERE id = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $id);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to the appropriate page after deletion
        echo "<script>window.location.pathname = 'Web/dashboard/$link.php';</script>";

        header("location: ../dashboard/$link.php");
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error deleting record: " . $conn->error;
    }

    // Close statement
    $stmt->close();
    
} $conn->close();
           }
           

                ?>
            </tbody>
        </table>
      
         </div>
   
    </div>
        </section>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
  

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        // call function
        changeBtn();
    });

    function changeBtn() {
        if(sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    };
   
    let addAdminIcon = document.getElementById("addAdminIcon");
    let addAdminForm = document.querySelector(".form-add1");

    addAdminIcon.addEventListener("click", () => {
        // Toggle the display property of the form
        if (addAdminForm.style.display === "block") {
            addAdminForm.style.display = "none";
        } else {
            addAdminForm.style.display = "block";
        }
    });

</script>
</body>
</html>
