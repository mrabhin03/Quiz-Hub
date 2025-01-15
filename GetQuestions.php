<?php
session_start();

include("../Connection.php");
    $sql="SELECT QID FROM `question` ORDER BY `Count`, RAND() LIMIT 10;";
    $Question=$conn->query($sql);
    $Qu=[];
    $i=0;
    while($row=$Question->fetch_assoc()){
        $Qu[$i]=$row['QID'];
        $i++;
    }
    $_SESSION['QIDs']=$Qu;
    $_SESSION['Ans']=[];
    $_SESSION['UserName']=(isset($_COOKIE['User']))?$_COOKIE['User']:$_POST['UserName'];
    $_SESSION['Added']=false;
    header("location:Question.php");
?>