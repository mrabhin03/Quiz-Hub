<?php
include("../Connection.php");
$Scroes="SELECT * FROM scores ORDER BY TotalScore DESC LIMIT 3";
$data=$conn->query($Scroes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Hub</title>
    <link rel="stylesheet" href="Style/Style.css?v=<?= time();?>">
</head>
<body>
    <div class='indexchecks'>
        <form class='UserData MainScore' style='padding:1rem 2rem;' method='POST' action='GetQuestions.php'>
            <h1 style='font-size:25px;margin-top:5px;'>Score Board</h1>
            <table>
                <?php
                $i=1;
                while($row=$data->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$row['Name']?></td>
                        <td><?=$row['TotalScore']?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </form>
        <form class='UserData' method='POST' action='GetQuestions.php'>
            <h1>Welcome</h1>
            <div>
                <label for="UserName">Your name</label>
                <input type="text" name="UserName"  placeholder="Enter Your Name" required>
            </div>
            <button class='subButton'>Continue</button>
        </form>
    </div>
</body>
</html>