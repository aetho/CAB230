<?php
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Bringing in connection to database
    require(dirname(__FILE__).'/validate.php');

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

                $stmt->bindParam(':fName', $fName);
                $stmt->bindParam(':lName', $lName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pwd', $pwdHash);

                $stmt->execute();
                header("Location: ../login.php");
            }
        }
    }
?>


<form class="form" id="sign-up-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-field" id="first-name-field">
        <label class="h5">First Name</label>
        <input type="text" name="fName" placeholder="John" class="text-only-input required-input"
            value = <?php if(isset($_POST['fName'])) echo $_POST['fName']; ?>
        >
        <?php
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
    <div class="form-field" id="last-name-field">
        <label class="h5">Last Name</label>
        <input type="text" name="lName" placeholder="Smith" class="text-only-input required-input"
            value = <?php if(isset($_POST['lName'])) echo $_POST['lName']; ?>
        >
        <?php
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
    <div class="form-field" id="password-confirm-field">
        <label class="h5">Confirm Password</label>
        <input type="password" name="pwdConf" placeholder="Confirm password" class="password-confirm-input required-input"
            value = <?php if(isset($_POST['pwdConf'])) echo $_POST['pwdConf']; ?>
        >
        <?php
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
    <div id="submit-field">
        <input type="submit" value="Sign up" onclick="return ValidateForm('sign-up-form')">
    </div>
</form>