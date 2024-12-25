<!DOCTYPE html>
<?php 
session_start();
include("../Connection.php");
$Wrongs=[];
for($i=0;$i<10;$i++){
    $SQL="SELECT * FROM `answers` WHERE QID='".$_SESSION['QIDs'][$i]."'";
    $Ans=$conn->query($SQL)->fetch_assoc();
    if($Ans['Answer']!=$_SESSION['Ans'][$i]){
        $Wrongs[]=[
            "No"=>$i+1,
            "Wrong"=>$_SESSION['Ans'][$i],
            "Correct"=>$Ans['Answer']
        ];
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="Style/Style.css?v=<?= time();?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
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
        <div class="WrongAnswersSection">
            <h2>Incorrect Answers</h2>
            <ul class="WrongAnswersList">
                <?php
                if(count($Wrongs)==0){
                    echo"<li>No Wrong Answers</li>";
                }
                foreach ($Wrongs as $wrong) {?>
                <li>Question <?= $wrong['No']?>: <strong>Your answer:</strong> <?= $wrong['Wrong']?>, <strong>Correct answer:</strong> <?= $wrong['Correct']?></li>
            <?php
            }
            ?>
            </ul>
        </div>
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
</body>
</html>
