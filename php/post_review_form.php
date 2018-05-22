<?php
    require_once(dirname(__FILE__).'/connect_to_db.php'); // Importing connection to database
    require(dirname(__FILE__).'/validate.php'); // Importing validate

    // if user is logged in, try to store review if $_POST data exists
    // else echo loggin prompt and exit
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
        if(count($_POST)>0){
            // Variable to store all form fields and their errors
            $fields;
        
            foreach($_POST as $field => $value){
                // Review content validation
                if($field == "reviewContent"){
                    $fields[$field] = ValidateField('', $value);
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

            if(!$hasError){
                // Extract relevant information
                $userID = $_SESSION['userID'];
                $date = date("Y-m-d");
                $itemID = $_POST['itemID'];
                $content = $_POST['reviewContent'];
                $rating = $_POST['reviewRating'];
    
                // Prepare statement
                $stmt = $pdo->prepare("INSERT INTO reviews (itemID, date, userID, content, rating) VALUES (:itemID, :date, :userID, :content, :rating);");
                
                // Bind parameters
                $stmt->bindParam(':itemID', $itemID);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':userID', $userID);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':rating', $rating);
    
                // Execute statement
                $stmt->execute();
                
                // Redirect to item so that refresh does not double post
                header("Location: /item.php?ID={$_POST['itemID']}");
            }
        }
    }else{
        echo "<div class=\"login-reminder\">Login to Post Reviews</div>";
        exit;
    }
?>

<!-- post review form container posting to itself -->
<form class="form" id="review-form" action="<?php
    $id;

    if(isset($_GET['ID'])){
        $id = $_GET['ID'];    
    }

    if(isset($_POST['itemID'])){
        $id = $_POST['itemID'];   
    }
    echo "/item.php?ID=$id"

?>" method="POST">
    <!-- content field container -->
    <div class="form-field" id="review-field">
        <label class="h5">Write a review</label>
        <textarea name="reviewContent" class="required-input"></textarea>
        <?php
            // echo error if an error exists
            // else echo empty error container
            if(isset($fields['reviewContent'])){
                EchoError($fields['reviewContent'], array(
                    'empty' => "Please fill this field."
                ));
            }else{
                echo "<div class=\"form-error\"></div>";
            }
        ?>
    </div>
    
    <!-- Rating Label -->
    <label class="h5">Rate:</label>
    
    <!-- Rating dropdown -->
    <select name="reviewRating" id="rating-field">
        <option value="1">1/5</option>
        <option value="2">2/5</option>
        <option value="3">3/5</option>
        <option value="4">4/5</option>
        <option value="5">5/5</option>
    </select>

    <!-- Hidden input to post itemID -->
    <input type="text" name="itemID" id="itemID" class="hidden-input" value="<?php
        $id;

        if(isset($_GET['ID'])){
            $id = $_GET['ID'];    
        }

        if(isset($_POST['itemID'])){
            $id = $_POST['itemID'];   
        }

        echo  $id
    ?>" readonly>

    <!-- Submit button -->
    <div id="post-field">
        <input type="submit" value="Post" onclick="return ValidateForm('review-form');">
    </div>
</form>