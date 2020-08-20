<?php
session_start();
include_once 'request.php';
$user = new Users;
$id = $_SESSION['id'];
if (!$user->session()){
    header("location:login.php");
}
if (isset($_REQUEST['q'])){
    $user->logout();
    header("location:login.php");
}
?>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .display {
            width: 100%;
        }
        .display td {
            width: 25%;
            border: 1px solid #ddd;
            padding: 7px 10px;
        }
    </style>
</head>
<body>
<div class="form">
    <div class="container">
    <div class="row">
    <p align="right"><a href="?q=logout">LOGOUT</a></p>
    </div>
    <label>Cписок email встречающихся более чем у одного пользователя</label>
    <table id="example" class="display">
        <tbody>
        <?php foreach ($user->getEmailone() as $row): ?>
            <tr>
                <td><?php echo $row['email'];?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <label>Cписок логинов пользователей, которые не сделали ни одного заказа</label>
    <table id="example" class="display">
        <tbody>
        <?php foreach ($user->getLoginNoOrders() as $row): ?>
            <tr>
                <td><?php echo $row['login'];?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <label>Cписок логинов пользователей которые сделали более двух заказов</label>
    <table id="example" class="display">
        <tbody>
        <?php foreach ($user->getLoginOrders() as $row): ?>
            <tr>
                <td><?php echo $row['login'];?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>
