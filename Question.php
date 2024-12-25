<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <link rel="stylesheet" href="Style/Style.css?v=<?= time();?>">
</head>
<body>
    <div class="QuizContainer">
        <?php 
            session_start();
            include("../Connection.php");
            if(isset($_POST['QuestionNumber'])){
                $Qnum=$_POST['QuestionNumber'];
                $_SESSION['Ans'][$Qnum-1]=$_POST['option'];
            }else{
                $Qnum=0;
                $_SESSION['Ans'][0]="";
            }
            if($Qnum==10){
                header("location:Finish.php");
            }

            $QID=$_SESSION['QIDs'][$Qnum];

            $sql="SELECT * FROM `question` WHERE QID ='$QID';";
            $Question=$conn->query($sql)->fetch_assoc();
        ?>
        <h1>Quiz Time</h1>
        <p class="Question"><?=$Question['Question'];?></p>
        <form class="Options" method='POST' onsubmit="return SubmitQuestion()">
            <input type="hidden" name='QuestionNumber' id="AnswerNext" value="<?= $Qnum;?>">
            <label>
                <input type="radio" name="option" required value="<?=$Question['Option1'];?>">
                <?=$Question['Option1'];?>
            </label>
            <label>
                <input type="radio" name="option" required value="<?=$Question['Option2'];?>">
                <?=$Question['Option2'];?>
            </label>
            <label>
                <input type="radio" name="option" required value="<?=$Question['Option3'];?>">
                <?=$Question['Option3'];?>
            </label>
            <label>
                <input type="radio" name="option" required value="<?=$Question['Option4'];?>">
                <?=$Question['Option4'];?>
            </label>
            <button type="submit" class="ContinueButton">Continue</button>
        </form>
    </div>
    <script>
        function SubmitQuestion(){
            object=document.getElementById('AnswerNext');
            object.value=parseInt(object.value)+1;
            return true;
        }
    </script>
</body>
</html>
