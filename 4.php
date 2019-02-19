<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    body{
        margin: 0;
    }
    .content{
        display: flex;
        height: 100vh;
    }
    .block1{
        display: flex;
        background-color: #696969;
        width: 100%;
        margin: 5% 0 5% 5%;
        justify-content: center;
        align-items: flex-start;
    }
    .block2{
        background-color: #696969;
        width: 100%;
        margin: 5% 5% 5% 5%;
    }
    .square{
        background-color: red;
        margin: 5%;
        height: calc(100% - 80px);
    }
</style>
<div class="content">
    <div class="block1"><div class="square"></div></div>
    <div class="block2"></div>


</div>

</body>
</html>