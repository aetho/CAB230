<?php
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Bringing in connection to database
    require(dirname(__FILE__).'/validate.php');

    if(count($_POST)>0){
        // Variable to store all form fields and their errors
        $fields;
    
        foreach($_POST as $field => $value){            
            // email validation
            if($field == "email"){
                $fields[$field] = ValidateField('email', $value);
            }
    
            // password validation
            if($field == "pwd"){
                $fields[$field] = ValidateField('pwd', $value);
            }
    
        }
    
        $hasError = false;
        foreach($fields as $field){
            if(!$field['isValid']){
                $hasError = !$field['isValid'];
                // Break out of loop as one error would result in the form being invalid
                break;
            }
        }

        // if form has error then show form again else insert to DB
        if(!$hasError){
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];

            // Try to get a matching email
            $stmt = $pdo->prepare("SELECT * FROM members WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt = $stmt->fetchAll();

            if(count($stmt) > 0){
                $pwdHash = $stmt[0]['pwd'];
                if(password_verify($pwd, $pwdHash)){
                    // session_start();
                    $_SESSION['userID'] = $stmt[0]['id']; // User's ID
                    $_SESSION['loggedIn'] = true;
                    header("Location: ../index.php");
                };
            }
            
        }
    }
?>
<form class="form" id="sign-in-form" action="./login.php" method="POST">
    <div class="form-field" id="email-field">
        <label class="h5">Email</label>
        <input type="text" name="email" placeholder="john@email.com" class="email-input required-input"
            value = <?php if(isset($_POST['email'])) echo $_POST['email']; ?>
        >
        <?php
            if(isset($fields['email'])){
                EchoError($fields['email'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Please enter a valid email.",
                    'existError' => "Email already exists. Please use a different email."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <div class="form-field" id="password-field">
        <label class="h5">Password</label>
        <input type="password" name="pwd" placeholder="Password" class="password-input required-input"        
            value = <?php if(isset($_POST['pwd'])) echo $_POST['pwd']; ?>
        >
        <?php
            if(isset($fields['pwd'])){
                EchoError($fields['pwd'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Please only use letters, numbers and periods."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <div id="submit-field">
        <input type="submit" value="Sign in" onclick="return ValidateForm('sign-in-form');">
    </div>
</form>