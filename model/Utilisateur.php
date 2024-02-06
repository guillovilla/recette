<?php
class Utilisateur extends CRUD {
    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'email', 'mot_de_passe', 'privilege_id'];

    public function checkUser($email, $password = null){
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($email));
        $count = $stmt->rowCount();

        if($count === 1){
            $salt = "H3@_l?a";
            $saltPassword = $password.$salt;
            //echo $saltPassword;
            $info_user = $stmt->fetch();
           // echo $info_user['password'];
            
            if($password != null){
                // check password
                if(password_verify($saltPassword, $info_user['mot_de_passe'])){
                    //session
                    session_regenerate_id();
                    $_SESSION['user_id'] = $info_user['id'];
                    $_SESSION['email'] = $info_user['email'];
                    // $_SESSION['username'] = $info_user['username'];
                    $_SESSION['privilege'] = $info_user['privilege_id'];
                    $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                    RequirePage::url('/home');
                    exit();
                }else{
                    $errors = "<ul><li>Verifier le mot de passe</li></ul>";
                    return $errors;
                }
            }else{
                //forgot password
                //print_r( $info_user);
                //update
                $tempPassword = uniqid();
                $user['id'] = $info_user['id'];
                $user['tempPassword'] = $tempPassword; 
                $this->update($user);
                // $sql = "UPDATE $this->table SET tempPassword = ? WHERE id = ?";
                // $stmt = $this->prepare($sql);
                // $stmt->execute(array($temPasswords,  $info_user['id']));
                $lien = "<a href='newPassword?user=".$info_user['id']."&temp=$tempPassword'>New pass</a>";
                //die();
                return $lien;
            }
        }else{
            $errors = "<ul><li>Verifiez votre email.</li></ul>";
            return $errors; 
        }
    }

    public function checkTempPassword($id, $tempPassword){
        $sql = "SELECT * FROM $this->table WHERE id = ? AND tempPassword = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($id, $tempPassword));
        $count = $stmt->rowCount();
        return $count;
    }
}
?>