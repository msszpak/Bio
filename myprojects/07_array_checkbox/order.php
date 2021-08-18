<?php

   
    $msg  = '';


    if(isset($_POST['topping'])) {
        $msg = $name = htmlspecialchars(trim($_POST['name']));
        $name = ucfirst($name);
        $phone = $_POST['phone'];
        $msg = "You have ordered the following toppings:<br>\n\r";
        $msg = "Your name is $name your phone number is $phone. The total cost of your order is<br>\n\r";




        
     



    
    
    foreach($_POST['topping'] as $topping_checked){
    
        $msg .="\t\t\t\t" . $topping_checked . "<br>\n\r";
        
        
         } 
            
            
        }

    else{
        $name = htmlspecialchars(trim($_POST['name']));
        $name = ucfirst($name);
        $phone = $_POST['phone'];
        $msg = "You did not order any extra toppings so you will receive our traditional cheese pizza.<br>\n\r";
        $msg = "Your name is $name your phone number is $phone. The total cost of your order is $7.95.<br>\n\r";
    }
?>



<!DOCTYPE html>

<html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pizza Express</title>
    
    <style type="text/css" media="screen">
        .error { color: red; }
    </style>
</head>
<body>


<?php echo $msg ?>
    
</body>
</html>