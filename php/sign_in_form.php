<?php
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Importing connection to database
    require(dirname(__FILE__).'/validate.php'); // Importing validate

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
            // Get result as an array
            $stmt = $stmt->fetchAll();

            // if an email exists then try ot verify password
            // else set email field 'isValid' to false
            if(count($stmt) > 0){
                // Extract password hash from results
                $pwdHash = $stmt[0]['pwd'];
                // if password is verified then set $_SESSION variables accordingly and redirect to index page
                // else set pwd field 'isValid' to false
                if(password_verify($pwd, $pwdHash)){
                    $_SESSION['userID'] = $stmt[0]['id']; // User's ID
                    $_SESSION['loggedIn'] = true;
                    header("Location: /index.php");
                }else{
                    // set pwd field 'wrong' error to true
                    $fields['pwd']['wrong'] = true;
                    // set pwd field 'isValid' to false
                    $fields['pwd']['isValid'] = false;
                }
            }else{
                // set email field 'true' to true
                $fields['email']['wrong'] = true;
                // set email field 'isValid' to false
                $fields['email']['isValid'] = false;
            }
            
        }
    }
?>
<!-- Sign-in form container posting to itself -->
<form class="form" id="sign-in-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <!-- email field container -->
    <div class="form-field" id="email-field">
        <label class="h5">Email</label>
        <!-- Input field prefilled with $_POST data -->
        <input type="text" name="email" placeholder="john@email.com" class="email-input required-input"
            value = <?php if(isset($_POST['email'])) echo $_POST['email']; ?>
        >
        <?php
            // echo error if an error exists
            // else echo empty error container
            if(isset($fields['email'])){
                EchoError($fields['email'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Please enter a valid email.",
                    'wrong' => "Email is not registered."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <!-- password field container -->
    <div class="form-field" id="password-field">
        <label class="h5">Password</label>
        <!-- Input field prefilled with $_POST data -->
        <input type="password" name="pwd" placeholder="Password" class="password-input required-input"        
            value = <?php if(isset($_POST['pwd'])) echo $_POST['pwd']; ?>
        >
        <?php
            // echo error if an error exists
            // else echo empty error container
            if(isset($fields['pwd'])){
                EchoError($fields['pwd'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Please only use letters, numbers and periods.",
                    'wrong' => "Wrong password."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <!-- Submit/Sign-in button -->
    <div id="submit-field">
        <input type="submit" value="Sign in" onclick="return ValidateForm('sign-in-form');">
    </div>
</form>