<?php
    function ValidateField($type, $value){
        $errors;

        // empty validation
        $errors["empty"] = empty($value);

        // firstname and lastname validation
        if($type == "text-only"){
            preg_match('/^[a-zA-z]+$/', $value, $matches);
            $errors["formatError"] = !count($matches);
        }
        
        // email validation
        if($type == "email"){
            preg_match('/^[a-zA-Z](\w|\.)*@[a-zA-Z]+\.[a-zA-Z]+$/', $value, $matches);
            $errors["formatError"] = !count($matches);
        }

        // password validation
        if($type == "pwd"){
            preg_match('/^([a-zA-Z0-9]|\.)+$/', $value, $matches);
            $errors["formatError"] = !count($matches);
        }

        // password confirm validation
        if($type == "pwdConf"){
            $errors["formatError"] = $value != $_POST['pwd'];
        }

        // add variable to indicate a field's validity
        foreach($errors as $error){
            if($error){
                $errors['isValid'] = false;
                // Break out of loop as one error would result in the field being invalid
                break;
            }else{
                $errors['isValid'] = true;
            }
        }

        return $errors;
    }
    function EchoError($errors, $msg){
        if(isset($errors['isValid']) && !$errors['isValid']){
            foreach($errors as $error => $value){
                if($value == true){
                    // if error is true then echo the message
                    echo "<div class=\"form-error form-error-active\">$msg[$error]</div>";
                    // break out of loop because only one error should be shown at a time.
                    break;
                }
            }
        }else{
            // echo empty error form if so errors
            echo "<div class=\"form-error\"></div>";
        }
    }
?>