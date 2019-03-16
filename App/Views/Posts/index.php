<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h3>Welcome <?= htmlspecialchars($name) ?></h3>
    <h4>Favourte Colors:</h4>
    <?php 
        foreach($colors as $color){
            echo '<li>' .$color. '</li>';
        }
    ?>
</body>
</html>