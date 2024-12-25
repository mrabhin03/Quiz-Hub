<?php
session_start();
include("../Connection.php");
    $sql="SELECT QID FROM `question` ORDER BY RAND() LIMIT 10;";
    $Question=$conn->query($sql);
    $Qu=[];
    $i=0;
    while($row=$Question->fetch_assoc()){
        $Qu[$i]=$row['QID'];
        $i++;
    }
    $_SESSION['QIDs']=$Qu;
    $_SESSION['Ans']=[];
    $_SESSION['UserName']=$_POST['UserName'];
    header("location:Question.php");
?>