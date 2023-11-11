<?php
    require_once("./App/models/config.php");

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    class AuthHelper {
        function getAuthHeaders() {
            $header = "";
            if(isset($_SERVER['HTTP_AUTHORIZATION']))
                $header = $_SERVER['HTTP_AUTHORIZATION'];
            if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
                $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            
            return $header;
        }

        function createToken($payload) {
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload->expiration= time()+JWT_EXP;
     
          

            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            
            $signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
            $signature = base64url_encode($signature);

            $token = "$header.$payload.$signature";
            
            return $token;
        }

        function verify($token) {
            // $header.$payload.$signature

            $token = explode(".", $token); // [$header, $payload, $signature]
            $header = $token[0];
            $payload = $token[1];
            $signature = $token[2];
           

            $new_signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
            $new_signature = base64url_encode($new_signature);
            // var_dump($new_signature);
            // die(__FILE__);
            if($signature!=$new_signature) {
<<<<<<< HEAD
                
=======
                echo' La firma no es valida';
>>>>>>> b1b5a22378ef668c657c0390328b3eab0f8224bc
                return false;
            }

            $payload = json_decode(base64_decode($payload));

             if($payload->expiration<time()) {
            
                return false;
             }

            return $payload;
        }

        function currentUser() {
            $auth = $this->getAuthHeaders(); // "Bearer $token"
            $auth = explode(" ", $auth); // ["Bearer", "$token"]

            if($auth[0] != "Bearer") {
<<<<<<< HEAD
              
=======
                echo 'Falla el bearer';
>>>>>>> b1b5a22378ef668c657c0390328b3eab0f8224bc
                return false;
            }
          
            return $this->verify($auth[1]); // Si está bien nos devuelve el payload
        }
    }
