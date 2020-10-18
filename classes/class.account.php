<?php

require_once 'class.db_connect.php';

class account extends db_connect
{


    public function __construct($dbo = NULL)
    {

        parent::__construct($dbo);
    }

    public function sign_up($user_name = '', $user_email = '', $user_password = '')
    {

        $currentTime = time();

        $stmt = $this->db->prepare("INSERT INTO user (user_id,user_name,user_email,user_password) VALUES ('',(:user_name),(:user_email),(:user_password))");
        $stmt->bindParam(":user_name", $user_name, PDO::PARAM_STR);
        $stmt->bindParam(":user_email", $user_email, PDO::PARAM_STR);
        $stmt->bindParam(":user_password", $user_password, PDO::PARAM_STR);
       


        if ($stmt->execute()) return json_encode(array('error' => False, 'msg' => 'User Registered!' ,"data"=>$this->getAccountInfo($user_email)));
        else return json_encode(array('error' => True, 'msg' => 'There is error in registering new user!'));


    }

    public function is_email_already_reg($user_email)
    {

        $stmt = $this->db->prepare("SELECT user_id from user where user_email=:user_email");

        $stmt->bindParam(":user_email", $user_email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return true;
        else return false;

    }

   

    public function loginByEmailNdPass($user_email = '', $user_password = '')
    {

        $stmt = $this->db->prepare("SELECT * from user where user_email=:user_email AND user_password=:user_password");
        $stmt->bindParam(":user_email", $user_email, PDO::PARAM_STR);
        $stmt->bindParam(":user_password", $user_password, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    

    public function getAccountInfo($user_email)
    {

        $result=array();

        $stmt = $this->db->prepare("SELECT * from user where user_email=:user_email");
        $stmt->bindParam(":user_email", $user_email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetch();

            $result=array(
                "user_id"=>$row['user_id'],
                "user_name"=>$row['user_name'],
                "user_email"=>$row['user_email'],
              
            );

            return $result;

        }

        return $result;
    }

}

?>