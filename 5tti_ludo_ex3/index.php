<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo"hello world";
    for ($i = 1; $i <= 10; $i++) {
        echo"<p>Le nombre vaut ".$i."</p>";
    }
    for ($i = 1; $i <= 10; $i++){
        if ($i != 3) {
        echo"<p>Le nombre vaut ".$i."</p>";
        } 
    }
    for ($i = 1; $i <= 10; $i++){
        if ($i < 4 || $i > 7 ) {
            echo"<p>Le nombre vaut ".$i."</p>";
        } 
    }
    {
        $nbr1 = -5;
        $nbr2 = 10;
        echo "<p>la valeur absolue de $nbr1 vaut " . abs($nbr1) . "</p>";
        echo "<p>la valeur absolue de $nbr2 vaut " . abs($nbr2) . "</p>";
    }

    ?> 
</body>
      
</html>