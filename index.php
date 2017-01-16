<?php
session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PHP AJAX Chat</title>
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/chat.js" defer="true"></script>
    <link rel="stylesheet" type="text/css" href="css/chat.css">

</head>

<div id="container">

    <div id='header'>
        <h2>Пример асинхронного чата PHP</h2>
    </div>

    <?php
    // проверка на наличие сессии, если есть определяем имя отправителя если нет, то гость
    if (isset($_SESSION['username'])){
        echo "<a href='session.php'>Выйти</a>";
        $usn=$_SESSION['username'];
        echo "<p>Привет, $usn</p>";
    }
    else{
        echo "<p>Задайте имя или можете писать от имени гостя.</p>";?>

        <div id='namebox'>
            <form action="session.php?$set=1" id="givename" method="post" onsubmit="if ($('#nametext')[0].value=='' || $('#nametext')[0].value.length>8) return false;">
                <input type='text' placeholder='Имя' name='Givename' id='nametext'/>
                <input type='submit' name='submit_button' value='Отправить' id='namesubmit'/>
            </form>
        </div>
    <?php	}
    ?>

    <div id="chat-wrap">
        <form id="message_form">
            <textarea id="writehere" maxlength = '100' placeholder="Сообщение..."></textarea>
        </form>
    </div>

    <div id="messages" >

    </div>

</div>