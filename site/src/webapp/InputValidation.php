<?php 
    namespace ttm4135\webapp;




    class InputValidation {
        function validUserName($username)
        {
            if($username == null || strlen($username)> 0 || strlen($username)<0 ){
                return FALSE; 
            }
            else{
                return TRUE;
            }

        }

 #       function validPassword($password){
 ##           if($password == null || strlen($password)>20){
 #               return FALSE;
 #           }
 #           else{
 #               return TRUE;
 #           }
            
 #       }
//NOT NULL
//Max 20 characters
//Valid email format, The FILTER_VALIDATE_EMAIL filter validates an e-mail address.
        function validEmail($email){
            if(strlen($email) > 20 && $email != NULL && filter_var($email, FILTER_VALIDATE_EMAIL)){
                return TRUE;
            }
            return FALSE;

        }

//Max 200 characters
        function ValidBio($bio){
            if(strlen($bio) < 200 && $bio !=NULL ){
                return TRUE;
            }
            return FALSE;
        }





    }