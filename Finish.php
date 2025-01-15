<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="Style/Style.css?v=<?= time();?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php 
    session_start();
    include("../Connection.php");
    $Wrongs=[];
    for($i=0;$i<10;$i++){
        $SQL="SELECT * FROM `question` WHERE QID='".$_SESSION['QIDs'][$i]."'";
        $Ans=$conn->query($SQL)->fetch_assoc();
        if($Ans['Answer']!=$_SESSION['Ans'][$i]){
            $Wrongs[]=[
                "No"=>$i+1,
                "Qns"=>$Ans['Question'],
                "Wrong"=>$_SESSION['Ans'][$i],
                "Correct"=>$Ans['Answer']
            ];
        }
    }
    if(!$_SESSION['Added']){
        for($i=0;$i<10;$i++){
            $updateQns="UPDATE question SET Count=Count+1 WHERE QID='".$_SESSION['QIDs'][$i]."'";
            $conn->query($updateQns);
        }
        $usercheck="SELECT ID FROM scores WHERE Name='".$_SESSION['UserName']."'";
        $data=$conn->query($usercheck);
        if($data->num_rows==0){
            $sqlvalue="INSERT INTO scores(`Name`,`TotalAttemt`,`TotalWrong`,`TotalScore`) VALUES('".$_SESSION['UserName']."',1,'".(count($Wrongs))."','".(10-count($Wrongs))."')";
        }else{
            $id=$data->fetch_assoc()['ID'];
            $sqlvalue="UPDATE scores SET TotalScore=TotalScore+(".(10-count($Wrongs))."), TotalAttemt=TotalAttemt+1,TotalWrong=TotalWrong+(".(count($Wrongs)).") WHERE ID='$id'";
        }
        setcookie('User',$_SESSION['UserName'],time()+(86400*3),'/');
        $conn->query($sqlvalue);
        $_SESSION['Added']=true;
    }
    
    ?>
    <?php
        $Scroes="SELECT * FROM scores ORDER BY TotalScore DESC";
        $data=$conn->query($Scroes);
    ?>

    <div class="ResultContainer">
        <div class="UpperSection">
            <div class="PieChartContainer">
                <canvas id="resultChart"></canvas>
            </div>
            <div class="MarksContainer">
                <h1>Your Score</h1>
                <p><strong>Marks:</strong> <?=10-count($Wrongs)?> / 10</p>
            </div>
        </div>
        <a href="index.php"><button class='subButton' style='margin-top:20px; background:#ee0000; font-size:20px;'>Try Again <ion-icon name="refresh-outline"></ion-icon></button></a>
        <div class="WrongAnswersSection">
            <h2>Incorrect Answers</h2>
            <ul class="WrongAnswersList">
                <?php
                if(count($Wrongs)==0){
                    echo"<li>No Wrong Answers</li>";
                }
                foreach ($Wrongs as $wrong) {?>
                <li><b>Question <?= $wrong['No']."</b>: ".$wrong['Qns']?><br> <strong>Your answer:</strong> <?= $wrong['Wrong']?>, <br> <strong>Correct answer:</strong> <?= $wrong['Correct']?></li>
            <?php
            }
            ?>
            </ul>
        </div>
        <form class='UserData' style='padding:1rem 0rem;max-width:100%;width:100%; margin-top:20px;box-shadow:0 0 0;' method='POST' action='GetQuestions.php'>
            <h1 style='font-size:25px;margin-top:5px;'>Score Board</h1>
            <table>
                <?php
                $i=1;
                while($row=$data->fetch_assoc()){
                    ?>
                    <tr <?=($row['Name']==$_SESSION['UserName'])?"class='Player'":"";?>>
                        <td><?=$i++?></td>
                        <td><?=$row['Name']?></td>
                        <td><?=$row['TotalScore']?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </form>
    </div>
    

    <script>
        const ctx = document.getElementById('resultChart').getContext('2d');
        const resultChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Correct', 'Wrong'],
                datasets: [{
                    data: [<?=10-count($Wrongs)?>, <?=count($Wrongs)?>], 
                    backgroundColor: ['#4caf50', '#f44336'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    }
                }
            }
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
