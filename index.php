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
        <div class='UserData MainScore' style='padding:1rem 2rem;'>
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
                <tr>
                    <td colspan='3'><a href="FullScore.php"><Button class='subButton' style='padding:5px;'>View Full Score</Button></a></td>
                </tr>
            </table>
        </div>
        <form class='UserData' method='POST' action='GetQuestions.php' onsubmit="return SubmitUser()">
            <h1>Welcome</h1>
            <div>
                <label for="UserName">Your name</label>
                <input type="text" name="UserName" id="User"  placeholder="Enter Your Name" required>
            </div>
            <button class='subButton' >Start Quiz <ion-icon name="arrow-forward-outline"></ion-icon></button>
        </form>
    </div>
    <script>
        function SubmitUser(){
            Uvalue=document.getElementById("User").value;
            if(Uvalue.trim()==''){
                alert('Enter the User Name')
                return false
            }
            return true
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>