<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Hub</title>
    <link rel="stylesheet" href="Style/Style.css?v=<?= time();?>">
</head>
<body>
    <form class='UserData' method='POST' action='GetQuestions.php'>
        <h1>Welcome</h1>
        <div>
            <label for="UserName">Your name</label>
            <input type="text" name="UserName"  placeholder="Enter Your Name" required>
        </div>
        <button class='subButton'>Continue</button>
    </form>
</body>
</html>