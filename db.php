    <?php
    $SN = "localhost";
    $DBuser = "root";
    $DBpass = "";
    $DBname = "sunson_solar";
    
    $conn = new mysqli($SN, $DBuser, $DBpass, $DBname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $FN = $_POST["Fname"] ?? "";
    $LN = $_POST["Lname"] ?? "";
    $MN = $_POST["Mname"] ?? "";
    $BD = $_POST["Bday"] ?? "";
    $GD = $_POST["Gender"] ?? "";
    $PHN = $_POST["PhNo"] ?? "";
    $EM = $_POST["EmAdd"] ?? "";
    $AD = $_POST["Addrs"] ?? "";
    $DPTS = $_POST["Departments"] ?? "";
    $UN = $_POST["Uname"] ?? "";
    $PW = $_POST["Pwd"] ?? "";

    
    $sql = "INSERT INTO users (Firstname, Lastname, Middlename, Birthdate, Gender, Phonenumber, Email, Address, Departments, Username, Password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Database Error: " . $conn->error);
    }
    
    $stmt->bind_param("sssssssssss", $FN, $LN, $MN, $BD, $GD, $PHN, $EM, $AD, $DPTS, $UN, $PW);
    
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Registration successful!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
    $conn->close();
    ?>
