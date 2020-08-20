<?php
session_start();
include_once 'request.php';
$user = new Users();
if ($user->session())
{
    header("location:index.php");
}

$user = new Users();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $user->login($_REQUEST['email'],$_REQUEST['password']);
    if($login){
        header("location:index.php");
    }else{
        echo "Ошибка входа!";
    }
}
?>
<html>
<head>
    <title>Log In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
<div class="form">
    <h1 class="text-center">Вход</h1>
    <div class="container  justify-content-center">
        <div class="row col-xs-4">
        <form action="" method="post" class="form-horizontal">
            <input type="text" name="email" placeholder="Please Enter Email" required class="form-control"/><br/>
            <input type="password" name="password" placeholder="Please Enter Password" required
                   class="form-control"/><br/>
            <input type="submit" name="submit" value="Войти"/>
        </form>
    <p class="text-center col-lg-7">Еще не зарегистрированы?<a href="register.php"> Зарегистрируйтесь здесь</a></p>
    </div>
    </div>
</div>
</body>
</html>
