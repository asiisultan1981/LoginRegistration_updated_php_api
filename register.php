<?php

require_once 'classes/class.account.php';

if (!empty($_POST)) {


    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    $account = new account();

    if (!$account->is_email_already_reg($user_email)) {
        echo $account->sign_up($user_name, $user_email, $user_password, '');
    }
    else echo json_encode(array('error' => True, 'msg' => 'Email Already Registered'));

}


?>