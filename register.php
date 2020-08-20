<?php
include_once 'request.php';
$user = new Users();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $register = $user->register($_REQUEST['name'],$_REQUEST['login'],$_REQUEST['email'],$_REQUEST['password']);
    if($register){
        header("Location: http://orders/login.php"); exit();
    }else{
        echo "Введенный логин уже существует!";
    }
}
?>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
<div class="form">
    <div class="container">
    <h1>Регистрация</h1>
    <form action="" method="post">
        <input type="text" name="name" placeholder="Please Enter Name" required /><br />
        <input type="text" name="login" placeholder="Please Enter login" required /><br />
        <input type="text" name="email" placeholder="Please Enter Email" required /><br />
        <input type="password" name="password" placeholder="Please Enter Password" required /><br />
        <input type="submit" name="submit" value="Регистрация" />
    </form>
    <p>Уже зарегистрирован? ?<a href="login.php"> Вход</a></p>
</div>
</div>
</body>
</html>
