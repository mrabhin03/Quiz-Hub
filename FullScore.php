<?php
include("../Connection.php");
$Scroes="SELECT * FROM scores WHERE  Name!='' ORDER BY TotalScore DESC";
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
    <div class='indexchecks' >
        <div class='UserData MainScore' >
            <h1 style='font-size:25px;margin-top:5px; display:flex;align-item:center;justify-content:space-between;;'>
                <a href="index.php"><ion-icon name="arrow-back-outline"></ion-icon></a>
                Score Board
                <ion-icon style='opacity:0;' name="arrow-back-outline" i></ion-icon>
            </h1>
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
        </div>
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