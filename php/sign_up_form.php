<?php
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Importing connection to database
    require(dirname(__FILE__).'/validate.php'); // Importing validate

    if(count($_POST)>0){
        // Variable to store all form fields and their errors
        $fields;
    
        foreach($_POST as $field => $value){
            // firstname and lastname validation
            if($field == "fName" || $field == "lName" ){
                $fields[$field] = ValidateField('text-only', $value);
            }
            
            // email validation
            if($field == "email"){
                $fields[$field] = ValidateField('email', $value);
            }
    
            // password validation
            if($field == "pwd"){
                $fields[$field] = ValidateField('pwd', $value);
            }
    
            // password confirm validation
            if($field == "pwdConf"){
                $fields[$field] = ValidateField('pwdConf', $value);
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
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            $pwdHash = password_hash($pwd, PASSWORD_BCRYPT);

            // Try to get a matching email
            $stmt = $pdo->prepare("SELECT * FROM members WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt = $stmt->fetchAll();
            
            // If more than zero rows are return then it already exists
            if(count($stmt) > 0){
                // Add error to $fields['email']
                $fields['email']['existError'] = true;

                // email no longer valid because of exist error
                $fields['email']['isValid'] = false;

            }else{
                $stmt = $pdo->prepare(
                    "INSERT INTO members(fName, lName, email, pwd)".
                    "VALUES(:fName, :lName, :email, :pwd)"
                );

                // Bind parameters
                $stmt->bindParam(':fName', $fName);
                $stmt->bindParam(':lName', $lName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pwd', $pwdHash);

                // Execute statement
                $stmt->execute();

                // Redirect to login page
                header("Location: {$_SERVER['HTTP_HOST']}/login.php");
            }
        }
    }
?>

<!-- Sign-up form container posting to itself -->
<form class="form" id="sign-up-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <!-- firstname field container -->
    <div class="form-field" id="first-name-field">
        <label class="h5">First Name</label>
        <!-- Input field prefilled with $_POST data -->
        <input type="text" name="fName" placeholder="John" class="text-only-input required-input"
            value = <?php if(isset($_POST['fName'])) echo $_POST['fName']; ?>
        >
        <?php
            // echo error if an error exists
            // else echo empty error container
            if(isset($fields['fName'])){
                EchoError($fields['fName'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Please use letters only"
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <!-- lastname field container -->
    <div class="form-field" id="last-name-field">
        <label class="h5">Last Name</label>
        <!-- Input field prefilled with $_POST data -->
        <input type="text" name="lName" placeholder="Smith" class="text-only-input required-input"
            value = <?php if(isset($_POST['lName'])) echo $_POST['lName']; ?>
        >
        <?php
            // echo error if an error exists
            // else echo empty error container
            if(isset($fields['lName'])){
                EchoError($fields['lName'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Please use letters only"
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
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
                    'existError' => "Email already exists. Please use a different email."
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
                    'formatError' => "Please only use letters, numbers and periods."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <!-- password confirm field container -->
    <div class="form-field" id="password-confirm-field">
        <label class="h5">Confirm Password</label>
        <!-- Input field prefilled with $_POST data -->
        <input type="password" name="pwdConf" placeholder="Confirm password" class="password-confirm-input required-input"
            value = <?php if(isset($_POST['pwdConf'])) echo $_POST['pwdConf']; ?>
        >
        <?php
            // echo error if an error exists
            // else echo empty error container
            if(isset($fields['pwdConf'])){
                EchoError($fields['pwdConf'], array(
                    'empty' => "Please fill this field.",
                    'formatError' => "Passwords do not match."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    <!-- Submit/Sign-in button -->
    <div id="submit-field">
        <input type="submit" value="Sign up" onclick="return ValidateForm('sign-up-form')">
    </div>
</form>