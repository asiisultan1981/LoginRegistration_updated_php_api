<?php

require_once 'classes/class.account.php';

if (!empty($_POST)) {


    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    $account = new account();


    if ($account->loginByEmailNdPass($user_email,$user_password)){

        echo json_encode(array('error' => False, 'msg' => 'User Login Successfully',"data"=>$account->getAccountInfo($user_email)));

    }
    else echo json_encode(array('error' => TRUE, 'msg' => 'Unable to Login'));

}


?>