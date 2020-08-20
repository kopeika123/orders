<?php
include("config.php");

class Users {
    public $link;
    public function __construct() {
        $this->link = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die ('Connection Error! '.mysqli_connect_error());
        if ($this->link->connect_error) {
            die('Error : ('. $this->link->connect_errno .') '. $this->link->connect_error);
        }
    }
    public function register($name,$login,$email,$pass){
        $pass = md5($pass);
        $checkuser = mysqli_query($this->link,"select * from users where login='".$login."'");
        $result = mysqli_num_rows($checkuser);
        if ($result==0){
            $register = mysqli_query($this->link,"INSERT INTO users SET login='".$login."', password='".$pass."', email='".$email."', fio='".$name."'") or die(mysqli_error());
            return $register;
        }
        else{
            return false;
        }
    }
    public function session(){
        if(isset($_SESSION['login'])){
            return $_SESSION['login'];
        }
    }
    public function login($email,$pass){
        $pass = md5($pass);
        $check = mysqli_query($this->link,"Select * from users where email='$email' and password='$pass'");
        $data = mysqli_fetch_array($check);
        $result = mysqli_num_rows($check);
        if($result==1){
            $_SESSION['login']=true;
            $_SESSION['id']=$data['id'];
            return true;
        }else{
            return false;
        }
    }
    public function logout(){
        $_SESSION['login']=false;
        session_destroy();
    }
    public function fullname($id){
        $result=mysqli_query($this->link,"select * from users where id='$id'");
        $row=mysqli_fetch_array($result);
        echo $row['fio'];
    }
    public function getEmailone(){
        return $this->link->query( "select email from (SELECT email, COUNT(login) from users GROUP BY email HAVING COUNT(login) > 1) email");
    }
    public function getLoginNoOrders(){
        return $this->link->query( "select login FROM users WHERE NOT EXISTS (SELECT user_id FROM orders  WHERE users.id = orders.user_id)");
    }
    public function getLoginOrders(){
        return $this->link->query( "select u.login from users u join orders o on o.user_id=u.id group by u.login having count(u.login)>2");
    }
}
