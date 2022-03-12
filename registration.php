<?php
session_start();
require_once 'connect.php';
if ( isset( $_SESSION[ 'adminID' ] ) != '' ) {
    header( 'Location: admin/' );
} elseif ( isset( $_SESSION[ 'user_id' ] ) != '' ) {
    header( 'Location: dashboard/' );
}

if ( isset( $_POST[ 'signup' ] ) ) {
    $Firstname = mysqli_real_escape_string( $conn, $_POST[ 'Firstname' ] );
    $Sirname = mysqli_real_escape_string( $conn, $_POST[ 'Secondname' ] );
    $Lastname = mysqli_real_escape_string( $conn, $_POST[ 'Lastname' ] );
    $RegNum = mysqli_real_escape_string( $conn, $_POST[ 'RegNum' ] );
    $IDNumber = mysqli_real_escape_string( $conn, $_POST[ 'IDNumber' ] );
    $PhoneNumber = mysqli_real_escape_string( $conn, $_POST[ 'PhoneNumber' ] );
    $email = mysqli_real_escape_string( $conn, $_POST[ 'email' ] );
    $Gender = mysqli_real_escape_string( $conn, $_POST[ 'Gender' ] );
    $Faculty = mysqli_real_escape_string( $conn, $_POST[ 'Faculty' ] );
    $password = mysqli_real_escape_string( $conn, $_POST[ 'password' ] );
    $cpassword = mysqli_real_escape_string( $conn, $_POST[ 'cpassword' ] );
    if ( $Firstname != '' || $Sirname != '' || $Lastname != '' || $RegNum != '' || $IDNumber != '' || $PhoneNumber != '' || $email != '' || $Gender != '' || $Faculty != '' || $password != '' || $cpassword != '' ) {
        // execute code here
        if ( !preg_match( "/^[a-zA-Z ]+$/", $Firstname ) ) {
            $name_error = 'First name must contain only alphabets and space';
        } else {
            if ( !preg_match( "/^[a-zA-Z ]+$/", $Sirname ) ) {
                $name_error1 = 'Sir name must contain only alphabets and space';
            } else {
                if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                    $email_error = 'Please Enter Valid Email ID';
                } else {
                    if ( !preg_match( "/^[a-zA-Z ]+$/", $Lastname ) ) {
                        $name_error2 = 'Last name must contain only alphabets and space';
                    } else {
                        if ( strlen( $password ) < 8 ) {
                            $password_error = 'Password must be minimum of 8 characters';
                        } else {
                            if ( strlen( $PhoneNumber ) < 10 ) {
                                $mobile_error = 'Mobile number must be minimum of 10 characters';
                            } else {
                                if ( $PhoneNumber < 100000000 ) {
                                    $mobile_error = 'Invalid Mobile Number';
                                } else {
                                    if ( strlen( $PhoneNumber ) > 12 ) {
                                        $mobile_error = 'Invalid Mobile Number';
                                    } else {
                                        if ( strlen( $IDNumber ) < 7 ) {
                                            $id_error = 'ID number must be minimum of 7 characters';
                                        } else {
                                            if ( $IDNumber < 1000000 ) {
                                                $id_error = 'Invalid ID number';
                                            } else {
                                                if ( strlen( $IDNumber ) > 8 ) {
                                                    $id_error = 'Invalid ID number';
                                                } else {
                                                    if ( $password != $cpassword ) {
                                                        $cpassword_error = "Password and Confirm Password doesn't match";
                                                    } else {
                                                        $found_email = mysqli_query( $conn, "SELECT * FROM users1 WHERE email = '" . $email. "'" );
                                                        if ( $found_email->num_rows > 0 ) {
                                                            $fm_error = ' The email entered is already registered into our database';
                                                        } else {
                                                            $found_id = mysqli_query( $conn, "SELECT * FROM users1 WHERE IDNumber = '" . $IDNumber. "'" );
                                                            if ( $found_id->num_rows > 0 ) {
                                                                $id_error = ' The ID number entered is already registered into our database';
                                                            } else {
                                                                $regnum_fm = mysqli_query( $conn, "SELECT * FROM users1 WHERE RegNumber = '" . $RegNum ."'" );
                                                                if ( $regnum_fm->num_rows > 0 ) {
                                                                    $id_error = ' The registration number entered is already registered into our database';
                                                                } else {
                                                                    $found_pn = mysqli_query( $conn, "SELECT * FROM users1 WHERE IDNumber = '" . $IDNumber. "'" );
                                                                    if ( $found_pn->num_rows > 0 ) {
                                                                        $id_error = ' The phone number entered is already registered into our database';
                                                                    } else {
                                                                        if ( mysqli_query( $conn, "INSERT INTO users1(Firstname, Sirname, Lastname, email, Faculty, PhoneNumber, IDNumber, RegNumber, Gender, password) VALUES('" . strtoupper( $Firstname ) . "', '" . strtoupper( $Sirname ) . "', '" . strtoupper( $Lastname ) . "', '" . $email . "', '" . $Faculty . "', '" . $PhoneNumber . "', '" . $IDNumber . "', '" . $RegNum . "', '" . $Gender . "', '".md5( $password ) . "')" ) ) {
                                                                            $_SESSION[ 'REGISTERED' ] = 'Details Captured Successfully Login NOW';

                                                                            header( 'Location: login.php' );
                                                                        } else {
                                                                            echo 'Error: ', '' . mysqli_error( $conn );
                                                                        }

                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        $initial_error = "Can't accept null values";
    }

    mysqli_close( $conn );
}
?>
<!DOCTYPE html>

<head>

<meta charset = 'UTF-8'>
<meta name = 'apple-mobile-web-app-title' content = 'CodePen'>
<title>LIBRARY MANAGEMENT SYSTEM | Registration Form</title>
<style>
body {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 14px;
    animation: myanimation 10s infinite;
}

.clearfix:after {
    content: '';
    display: block;
    clear: both;
    visibility: hidden;
    height: 0;
}

.form_wrapper {
    background: #fff;
    width: 400px;
    max-width: 100%;
    box-sizing: border-box;
    padding: 25px;
    margin: 8% auto 0;
    position: relative;
    z-index: 1;
    border-top: 5px solid #f5ba1a;
    -webkit-box-shadow: 0 0 3px rgba( 0, 0, 0, 0.1 );
    -moz-box-shadow: 0 0 3px rgba( 0, 0, 0, 0.1 );
    box-shadow: 0 0 3px rgba( 0, 0, 0, 0.1 );
    -webkit-transform-origin: 50% 0%;
    transform-origin: 50% 0%;
    -webkit-transform: scale3d( 1, 1, 1 );
    transform: scale3d( 1, 1, 1 );
    -webkit-transition: none;
    transition: none;
    -webkit-animation: expand 0.8s 0.6s ease-out forwards;
    animation: expand 0.8s 0.6s ease-out forwards;
    opacity: 0;
}

.form_wrapper h2 {
    font-size: 1.5em;
    line-height: 1.5em;
    margin: 0;
}

.form_wrapper .title_container {
    text-align: center;
    padding-bottom: 15px;
}
span {
    color: red;
}

.form_wrapper h3 {
    font-size: 1.1em;
    font-weight: normal;
    line-height: 1.5em;
    margin: 0;
}

.form_wrapper label {
    font-size: 12px;
}

.form_wrapper .row {
    margin: 10px -15px;
}

.form_wrapper .row>div {
    padding: 0 15px;
    box-sizing: border-box;
}

.form_wrapper .col_half {
    width: 50%;
    float: left;
}

.form_wrapper .input_field {
    position: relative;
    margin-bottom: 20px;
    -webkit-animation: bounce 0.6s ease-out;
    animation: bounce 0.6s ease-out;
}

.form_wrapper .input_field>span {
    position: absolute;
    left: 0;
    top: 0;
    color: #333;
    height: 100%;
    border-right: 1px solid #cccccc;
    text-align: center;
    width: 30px;
}

.form_wrapper .input_field>span>i {
    padding-top: 10px;
}

.form_wrapper .textarea_field>span>i {
    padding-top: 10px;
}

.form_wrapper input[ type = text ],
.form_wrapper input[ type = date ],
.form_wrapper input[ type = number ],
.form_wrapper input[ type = email ],
.form_wrapper input[ type = password ] {
    width: 100%;
    padding: 8px 10px 9px 35px;
    height: 35px;
    border: 1px solid #cccccc;
    box-sizing: border-box;
    outline: none;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.form_wrapper input[ type = text ]:hover,
.form_wrapper input[ type = date ]:hover,
.form_wrapper input[ type = number ]:hover,
.form_wrapper input[ type = email ]:hover,
.form_wrapper input[ type = password ]:hover {
    background: #fafafa;
}

.form_wrapper input[ type = text ]:focus,
.form_wrapper input[ type = date ]:focus,
.form_wrapper input[ type = number ]:focus,
.form_wrapper input[ type = email ]:focus,
.form_wrapper input[ type = password ]:focus {
    -webkit-box-shadow: 0 0 2px 1px rgba( 255, 169, 0, 0.5 );
    -moz-box-shadow: 0 0 2px 1px rgba( 255, 169, 0, 0.5 );
    box-shadow: 0 0 2px 1px rgba( 255, 169, 0, 0.5 );
    border: 1px solid #f5ba1a;
    background: #fafafa;
}

.form_wrapper input[ type = submit ] {
    background: #f5ba1a;
    height: 35px;
    line-height: 35px;
    width: 100%;
    border: none;
    outline: none;
    cursor: pointer;
    color: #fff;
    font-size: 1.1em;
    margin-bottom: 10px;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.form_wrapper input[ type = submit ]:hover {
    background: #e1a70a;
}

.form_wrapper input[ type = submit ]:focus {
    background: #e1a70a;
}

.form_wrapper input[ type = checkbox ],
.form_wrapper input[ type = radio ] {
    border: 0;
    clip: rect( 0 0 0 0 );
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

.form_container .row .col_half.last {
    border-left: 1px solid #cccccc;
}

.checkbox_option label {
    margin-right: 1em;
    position: relative;
}

.checkbox_option label:before {
    content: '';
    display: inline-block;
    width: 0.5em;
    height: 0.5em;
    margin-right: 0.5em;
    vertical-align: -2px;
    border: 2px solid #cccccc;
    padding: 0.12em;
    background-color: transparent;
    background-clip: content-box;
    transition: all 0.2s ease;
}

.checkbox_option label:after {
    border-right: 2px solid #000000;
    border-top: 2px solid #000000;
    content: '';
    height: 20px;
    left: 2px;
    position: absolute;
    top: 7px;
    transform: scaleX( -1 ) rotate( 135deg );
    transform-origin: left top;
    width: 7px;
    display: none;
}

.checkbox_option input:hover+label:before {
    border-color: #000000;
}

.checkbox_option input:checked+label:before {
    border-color: #000000;
}

.checkbox_option input:checked+label:after {
    -moz-animation: check 0.8s ease 0s running;
    -webkit-animation: check 0.8s ease 0s running;
    animation: check 0.8s ease 0s running;
    display: block;
    width: 7px;
    height: 20px;
    border-color: #000000;
}

.radio_option label {
    margin-right: 1em;
}

.radio_option label:before {
    content: '';
    display: inline-block;
    width: 0.5em;
    height: 0.5em;
    margin-right: 0.5em;
    border-radius: 100%;
    vertical-align: -3px;
    border: 2px solid #cccccc;
    padding: 0.15em;
    background-color: transparent;
    background-clip: content-box;
    transition: all 0.2s ease;
}

.radio_option input:hover+label:before {
    border-color: #000000;
}

.radio_option input:checked+label:before {
    background-color: #000000;
    border-color: #000000;
}

.select_option {
    position: relative;
    width: 100%;
}

.select_option select {
    display: inline-block;
    width: 100%;
    height: 35px;
    padding: 0px 15px;
    cursor: pointer;
    color: #7b7b7b;
    border: 1px solid #cccccc;
    border-radius: 0;
    background: #fff;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    transition: all 0.2s ease;
}

.select_option select::-ms-expand {
    display: none;
}

.select_option select:hover,
.select_option select:focus {
    color: #000000;
    background: #fafafa;
    border-color: #000000;
    outline: none;
}

.select_arrow {
    position: absolute;
    top: calc( 50% - 4px );
    right: 15px;
    width: 0;
    height: 0;
    pointer-events: none;
    border-width: 8px 5px 0 5px;
    border-style: solid;
    border-color: #7b7b7b transparent transparent transparent;
}

.select_option select:hover+.select_arrow,
.select_option select:focus+.select_arrow {
    border-top-color: #000000;
}

.credit {
    position: relative;
    z-index: 1;
    text-align: center;
    padding: 15px;
    color: #f5ba1a;
}

.credit a {
    color: #e1a70a;
}

@-webkit-keyframes check {
    0% {
        height: 0;
        width: 0;
    }
    25% {
        height: 0;
        width: 7px;
    }
    50% {
        height: 20px;
        width: 7px;
    }
}

@keyframes check {
    0% {
        height: 0;
        width: 0;
    }
    25% {
        height: 0;
        width: 7px;
    }
    50% {
        height: 20px;
        width: 7px;
    }
}

@-webkit-keyframes expand {
    0% {
        -webkit-transform: scale3d( 1, 0, 1 );
        opacity: 0;
    }
    25% {
        -webkit-transform: scale3d( 1, 1.2, 1 );
    }
    50% {
        -webkit-transform: scale3d( 1, 0.85, 1 );
    }
    75% {
        -webkit-transform: scale3d( 1, 1.05, 1 );
    }
    100% {
        -webkit-transform: scale3d( 1, 1, 1 );
        opacity: 1;
    }
}

@keyframes expand {
    0% {
        -webkit-transform: scale3d( 1, 0, 1 );
        transform: scale3d( 1, 0, 1 );
        opacity: 0;
    }
    25% {
        -webkit-transform: scale3d( 1, 1.2, 1 );
        transform: scale3d( 1, 1.2, 1 );
    }
    50% {
        -webkit-transform: scale3d( 1, 0.85, 1 );
        transform: scale3d( 1, 0.85, 1 );
    }
    75% {
        -webkit-transform: scale3d( 1, 1.05, 1 );
        transform: scale3d( 1, 1.05, 1 );
    }
    100% {
        -webkit-transform: scale3d( 1, 1, 1 );
        transform: scale3d( 1, 1, 1 );
        opacity: 1;
    }
}

@-webkit-keyframes bounce {
    0% {
        -webkit-transform: translate3d( 0, -25px, 0 );
        opacity: 0;
    }
    25% {
        -webkit-transform: translate3d( 0, 10px, 0 );
    }
    50% {
        -webkit-transform: translate3d( 0, -6px, 0 );
    }
    75% {
        -webkit-transform: translate3d( 0, 2px, 0 );
    }
    100% {
        -webkit-transform: translate3d( 0, 0, 0 );
        opacity: 1;
    }
}

@keyframes bounce {
    0% {
        -webkit-transform: translate3d( 0, -25px, 0 );
        transform: translate3d( 0, -25px, 0 );
        opacity: 0;
    }
    25% {
        -webkit-transform: translate3d( 0, 10px, 0 );
        transform: translate3d( 0, 10px, 0 );
    }
    50% {
        -webkit-transform: translate3d( 0, -6px, 0 );
        transform: translate3d( 0, -6px, 0 );
    }
    75% {
        -webkit-transform: translate3d( 0, 2px, 0 );
        transform: translate3d( 0, 2px, 0 );
    }
    100% {
        -webkit-transform: translate3d( 0, 0, 0 );
        transform: translate3d( 0, 0, 0 );
        opacity: 1;
    }
}

@keyframes myanimation {
    0% {
        background-color: rgb( 81, 96, 116 );
    }
    25% {
        background-color: rgb( 71, 148, 141 );
    }
    50% {
        background-color: rgb( 61, 142, 172 );
    }
    75% {
        background-color: rgb( 51, 179, 184 );
    }
    100% {
        background-color: rgb( 41, 97, 110 );
    }
}

@media ( max-width: 600px ) {
    .form_wrapper .col_half {
        width: 100%;
        float: none;
    }
    .bottom_row .col_half {
        width: 50%;
        float: left;
    }
    .form_container .row .col_half.last {
        border-left: none;
    }
    .remember_me {
        padding-bottom: 20px;
    }
}
</style>

<script src = 'https://use.fontawesome.com/webfontloader/1.6.24/webfontloader.js'></script>
<script>
window.console = window.console || function( t ) {
}
;
</script>

<script>
if ( document.location.search.match( /type = embed/gi ) ) {
    window.parent.postMessage( 'resize', '*' );
}
</script>
<link rel = 'stylesheet' href = 'https://use.fontawesome.com/4ecc3dbb0b.css' media = 'all'>

</head>

<body translate = 'no'>
<div class = 'form_wrapper'>
<div class = 'form_container'>
<div class = 'title_container'>
<h2>Library Management Registration Form</h2>
<span class = 'text-danger'><?php if ( isset( $password_error ) ) echo $password_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $initial_error ) ) echo $initial_error;
?></span>
<span class = 'text-danger' color = 'blue'><?php if ( isset( $cpassword_error ) ) echo $cpassword_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $name_error ) ) echo $name_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $name2_error ) ) echo $name2_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $name1_error ) ) echo $name1_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $id_error ) ) echo $id_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $mobile_error ) ) echo $mobile_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $email_error ) ) echo $email_error;
?></span>
<span class = 'text-danger'><?php if ( isset( $fm_error ) ) echo $fm_error;
?></span>
</div>
<div class = 'row clearfix'>
<div class = ''>
<form action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method = 'POST'>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-user'></i></span>
<input type = 'text' name = 'Firstname' placeholder = 'First Name'>
</div>
<div class = 'row clearfix'>
<div class = 'col_half'>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-user'></i></span>
<input type = 'text' name = 'Secondname' placeholder = 'Sir Name'>
</div>
</div>
<div class = 'col_half'>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-user'></i></span>
<input type = 'text' name = 'Lastname' placeholder = 'Last Name'>
</div>
</div>
</div>
<div class = 'row clearfix'>
<div class = 'col_half'>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-user '></i></span>
<input type = 'number' name = 'IDNumber' placeholder = 'ID Number'>
</div>
</div>
<div class = 'col_half'>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-user' ></i></span>
<input type = 'text' name = 'RegNum' placeholder = 'Reg. Number'>
</div>
</div>
</div>
<div class = 'input_field'> <span><i aria-hidden = 'true'  class = 'fa fa-user'></i></span>
<input type = 'number' name = 'PhoneNumber' placeholder = 'Phone Number' >
</div>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-envelope'></i></span>
<input type = 'email' name = 'email' placeholder = 'Email' >
</div>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-lock'></i></span>
<input type = 'password' name = 'password' placeholder = 'Password' >
</div>
<div class = 'input_field'> <span><i aria-hidden = 'true' class = 'fa fa-lock'></i></span>
<input type = 'password' name = 'cpassword' placeholder = 'Re-type Password' >
</div>
<div class = 'input_field radio_option' name = 'Gender'>
<input type = 'radio' name = 'Gender' id = 'rd1' value = 'MALE'>
<label for = 'rd1'>Male</label>
<input type = 'radio' name = 'Gender' id = 'rd2' value = 'FEMALE'>
<label for = 'rd2'>Female</label>
</div>
<div class = 'input_field select_option'>
<select name = 'Faculty'>
<option> Select a Faculty</option >
<option value = 'SIST'> SCHOOL OF INFORMATION SCIENCE AND TECHNOLOGY</option>
<option value = 'SASS' >SCHOOL OF ARTS AND SOCIAL SCIENCES</option>
</select>
<div class = 'select_arrow'></div>
</div>
<div class = 'input_field checkbox_option'>
<input type = 'checkbox' id = 'cb1'>
<label for = 'cb1'>I agree with terms and conditions</label>
</div>
<div class = 'input_field checkbox_option'>
<input type = 'checkbox' id = 'cb2'>
<label for = 'cb2'>I want to receive the newsletter</label>
</div>
<input class = 'button' type = 'submit' name = 'signup' value = 'signup'> Already have a account?<a href = 'login.php' class = 'btn btn-default' style = 'border-radius: 20%; box-shadow:#000000; animation: myanimation 10s infinite;'>Login</a>
</form>
</div>
</div>
</div>
</div>
<p class = 'credit'>Developed by <a href = 'https://wa.me/254762187336' target = '_blank'>UEL CHIRCHIR</a></p>

<script src = 'https://use.fontawesome.com/4ecc3dbb0b.js'></script>

</body>

</html>