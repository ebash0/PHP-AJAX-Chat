<?php
try{
    $db = new PDO('sqlite:test.db');
}
catch(PDOException $e){
    die('Failed to connect:'. $e->getMessage());
}

if (isset($_POST['text'])){
    session_start();

    //если пользователь залогинен используем его имя иначе он Гость
    $us='Guest';
    if (isset($_SESSION['username']))
        $us=$_SESSION['username'];
    session_write_close();
    $msg=$_POST['text'];

    $sql ="INSERT INTO MESSAGES (USER,MESSAGE) VALUES(?, ?)";

    try{
        $ret = $db->prepare($sql);
        $ret->execute([$us,$msg]);
    }
    catch(PDOException $e){
        console.log('Failed to update db:'. $e->getMessage());
    }
}

else{
    $time=time()+20;

    while(time()<$time){
        if ($_POST['time']){
            $prevtime=$_POST['time'];
        }
        else {
            $prevtime=0;
        }
        //проверка новых сообщений

        $sql ="SELECT TIME,USER,MESSAGE FROM MESSAGES WHERE TIME>? ORDER BY TIME ASC";

        try{
            $ret = $db->prepare($sql);
            $ret->execute([$prevtime]);

            $resarr = $ret->fetchAll(PDO::FETCH_ASSOC);

            //если новых сообщений нет спим пол секунды
            if (!$resarr)
                sleep(0.5);
            else{
                echo json_encode($resarr);
                break;
            }
        }
        catch(PDOException $e){
            console.log('Failed to get messages:'. $e->getMessage());
        }
    }
}
$db=null;

?>