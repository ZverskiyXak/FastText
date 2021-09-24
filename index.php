<!DOCTYPE html>
<html lang="en">
<head>
    <title>FastText</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body style="position:absolute; height: 100%; width: 100%;">
<?php
    $mysql = new mysqli("127.0.0.1", "root", "root", "bd");
    $mysql->query("SER NAMES 'utf8'");
    if($mysql->connect_error) {
        echo 'Error Number: '.$mysql->connect_errno.'<br>';
        echo 'Error: '.$mysql->connect_error;
    } else {
        if(isset($_POST['password']) && isset($_POST['text'])){
            echo $_POST['password'].'<br>';
            echo $_POST['text'];
            $mysql->query("INSERT INTO `fasttext` (`password`, `text`, `data`, `sum`) VALUES ('{$_POST['password']}', '{$_POST['text']}', current_timestamp(), '5')");
            $mysql->close();
        }
    }

?>
    <div>
        <h1>TextFast</h1>
    </div>


<div style="display: flex; flex-direction: row; justify-content: space-around; height: 50%;">

    <form action="/index.php" method="post" style="display: flex; width: 30%; flex-direction: column; justify-content: space-around">
        <input type="number" name="password">
        <textarea name="text" style="height: 50%"></textarea>
        <button type="submit" class="button" name="save">Отправить</button>
    </form>



    <div style="display: flex; flex-direction: column; width: 50%;">


        <form action="/index.php" method="post">
            <input type="number" name="text_rec">
            <button type="submit" class="button" name="save_rec">Отправить</button>
        </form>
        <br>
        <span>
            <?php
                $mysql = new mysqli("127.0.0.1", "root", "root", "bd");
                $mysql->query("SER NAMES 'utf8'");
                if($mysql->connect_error) {
                    echo 'Error Number: '.$mysql->connect_errno.'<br>';
                    echo 'Error: '.$mysql->connect_error;
                } else {
                    if(isset($_POST['text_rec'])){
                        echo $_POST['text_rec'];
                        $answer = mysqli_fetch_assoc($mysql->query("SELECT `text` FROM `fasttext` WHERE `password` = {$_POST['text_rec']}"));
                        echo $answer['text'];
                        $mysql->close();
                    }
                }
            ?>
        </span>

    </div>


</div>

</body></html>