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
        "appoiAppointmentntment" => array("icon" => "calendar", "link" => "appointment.php")
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
    <title>Specialty</title>
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
                <h2>Specialtys Information</h2>
            </div>
            <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <?php if ($_SESSION["USER_Role"] === "admin") { ?>
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
                
                $sql = "SELECT * FROM specialty";
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Initialize a counter variable
                    $i = 1;
                    // Fetch each row as an associative array
                    while ($row = $result->fetch_assoc()) {
                        // Output  information in the table rows
                        ?>
                       <tr>
    <td><?php echo $i; ?></td>
    <td>
        <form action="speciality.php" method="post" class="update-form">
            <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']) { ?>
                <input style="width:100%;" type="text" name="name" minlength="3" value="<?php echo $row['name']; ?>" required>
            <?php } else { ?>
                <?php echo $row['name']; ?>
            <?php } ?>
    </td>
    <?php if ($_SESSION["USER_Role"] === "admin") { ?>
        <td class="btn-action">
            <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']) { ?>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="update_patient"><i  style="color:green;font-size: 30px;" class='bx bx-check'></i></button>
            </form>
            <?php } else { ?>
                <a style="text-decoration:none;font-size: 28px;" href="?edit=<?php echo $row['id']; ?>"><i style="color:grey;" class='bx bx-pencil'></i></a>
                <form  method="post">
    <input type="hidden" name="table" value="specialty">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="link" value="speciality">
    <button type="submit" name="delete"><i style="color:red;" class="bx bx-trash"></i></button>
</form>

            <?php } ?>
        </td>
    <?php } ?>
</tr>
                        <?php
                        // Increment the counter variable
                        $i++;
                    }
                } else {
                    // If there are no  in the database
                    echo "<tr><td colspan='7'><p style='text-align:center;'>No specialty found</p></td></tr>";

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
    <div class="details form-add1"> 
        <div class="recent_project">
        <div class="card_header">
                <h2>Add Specialty</h2>
            </div>
            <table class="form-add">
            <tbody>
                <form action="speciality.php" method="post">
                    <tr class="form-input">
                        <td>
                            <label for="name">Name :</label>
                        </td>
                        <td>
                            <input type="text" id="name" minlength="3" name="name" required>
                        </td>
                    </tr>
                    <tr class="form-input">
                        <td colspan="2">
                            <button type="submit" name="add">Add</button>
                        </td>
                    </tr>
                </form>
                <?php 
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["add"])) {
                        // Establish database connection
                        $servername = "localhost";
                        $username = "root"; // Add your username
                        $password = ""; // Add your password
                        $dbname = "clinic";
                    
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                    
                        // Check if all required fields are provided
                        if (!empty($_POST["name"]) ) {
                            // Get form data
                            $name = $_POST["name"];
                            
                            $stmt = $conn->prepare("INSERT INTO specialty (name) VALUES (?)");
                            if ($stmt) {
                                // Bind parameters
                                $stmt->bind_param("s", $name);
        
                                // Execute statement
                                if ($stmt->execute()) {
                                    echo "<script>window.location.pathname = 'Web/dashboard/speciality.php';</script>";
                                    exit;
                                } else {
                                    // Redirect to the page with error message
                                    header("location: speciality.php?error=1");
                                    exit;
                                }
                            } else {
                                // Error preparing statement
                                $error_message = "Error preparing statement: " . $conn->error;
                            }
                        } else {
                            // Not all required fields provided
                            $error_message = "All fields are required";
                        }
                    
            }
            if (isset($_POST["update_patient"])) {
               // Get the values from the form
               $id = $_POST["id"];
               $name = $_POST["name"];
               
               
              
                   // Update query without password
                   $sql = "UPDATE specialty SET name='$name' WHERE id='$id'";
            
               if ($conn->query($sql) === TRUE) {
                   // Redirect to the  page
                   echo "<script>window.location.pathname = 'Web/dashboard/speciality.php';</script>";
                   
                   exit;
               } else {
                   // Redirect to the page with error message
                   header("location: speciality.php?error=1");
                   exit;
               }
                                   
           }
           if (isset($_POST["delete"])) {
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
}
           }
           
        }
                $conn->close();
                ?>
            </tbody>
        </table>
         </div>
    </div>
 <?php if ($_SESSION["USER_Role"] === "admin") { ?>
    <div class="add-icon">
        <i class='bx bx-list-plus' id="addAdminIcon"></i>
    </div>
<?php } ?>
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
