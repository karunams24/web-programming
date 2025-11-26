<?php
$name = $email = $phone = $password = $confirm_password = $dob = "";
$nameErr = $emailErr= $phoneErr = $passwordErr = $confirmPasswordErr = $dobErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    
        if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    
    
    if (empty($_POST["phone"])) {
    $phoneErr = "Phone No is required";
} else {
    $phone = test_input($_POST["phone"]);

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $phoneErr = "Phone number must be exactly 10 digits";
    }
}

    
    
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters long";
        }
    }

    
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Please confirm your password";
    } else {
        $confirm_password = test_input($_POST["confirm_password"]);
       
        if ($confirm_password !== $password) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
    } else {
        $dob = test_input($_POST["dob"]);
       
        $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
        if (!$dobDate || $dobDate->format('Y-m-d') !== $dob) {
            $dobErr = "Invalid Date format. Please use YYYY-MM-DD";
        }
    }

    
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($dobErr)) {
     
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $successMsg = "Registration successful! Your password has been securely stored.";
	$name = $email = $phone = $password = $confirm_password = $dob = "";   
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<html>
<head>
   
    <title>Registration Form</title>
    <style>
        .error {color: #FF0000;}
        .success {color: #28a745;}
        form {
            width: 300px;
            margin: auto;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="phone"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: skyblue;
        }
        
        input[type="reset"] {
   	    width: 100%;
    	    padding: 10px;
   	    background-color: #4CAF50;
  	    color: white;
   	    border: none;
   	    cursor: pointer;
    	    margin-top: 5px;
	}

	input[type="reset"]:hover {
   	    background-color: skyblue; 
	}

    </style>
</head>
<body>

<h2 style="text-align: center;">Registration Form</h2>

<?php

if (!empty($successMsg)) {
    echo "<p class='success' style='text-align: center;'>$successMsg</p>";
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name;?>">
    <span class="error"><?php echo $nameErr;?></span><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email;?>">
    <span class="error"><?php echo $emailErr;?></span><br>
    
    <label for="phone">Phone:</label>
    <input type="phone" id="phone" name="phone" value="<?php echo $phone;?>">
    <span class="error"><?php echo $phoneErr;?></span><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo $password;?>">
    <span class="error"><?php echo $passwordErr;?></span><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password;?>">
    <span class="error"><?php echo $confirmPasswordErr;?></span><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $dob;?>">
    <span class="error"><?php echo $dobErr;?></span><br>

    <input type="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
</form>
</body>
</html>

