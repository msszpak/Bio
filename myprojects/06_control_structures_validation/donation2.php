<?php

// $msg the user receives when the form is not completed properly 
$msg = "<p class=error>Please <a href='javascript: history.back()'>GO BACK</a> and fill in the following errors: </p>";
$okay = true;


// if and else statements for empty and confirmed data
    if (empty($_POST['fname'])) {
        $msg .= "\t<span class=error>First name must be filled in</span><br>\n\r";
        $okay = false;   
    }
    else {
        $fname = htmlspecialchars(trim($_POST['fname']));
    }

    if (empty($_POST['lname'])) {
        $msg .= "\t<span class=error>Last name must be filled in</span><br>\n\r";
        $okay = false;
    }
    else {
        $lname = htmlspecialchars(trim($_POST['lname']));
    }

    if (empty($_POST['email'])) {
        $msg .= "\t<span class=error>Email must be filled in</span><br>\n\r";
        $okay = false; 
    }

    else {
        $email = ($_POST['email']);
    }
    
    if (empty($_POST['amount'])) {
        $msg .= "\t<span class=error>Donation amount must be entered</span><br>\n\r";
        $okay = false;
    }
    else {
        $amount = ($_POST['amount']);
    }

//variables to format the print statement


        
// If okay print msg else print msg
    if ($okay) {
        $name = $fname . ' ' .$lname;
        $name = ucfirst($fname) . ' '. ucfirst($lname);
        $amount = number_format ($amount, 2);
        $msg = "<p>Thank you $name for your donation of \$$amount.</p>\n\r";
        $msg .= "\t<p>We will email your receipt to $email.</p>\n\r";
    

    if (isset($_POST['subscription'])){
        $msg .="\t<p>You have chose to not receive a free year subscription to our e- magazine.</p>";
    }
    
    else {
        $msg .= "\t<p>You have chose to receive a free year subscription to our e-        magazine.</p>\n\r";
    }
    
    }
    
    ?>
   <!DOCTYPE html>
    <!-- Mike Szpak -->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Donation</title>
<!-- css text style for the error message -->        
        <style type="text/css" media="screen">
            .error { color: red; }
        </style>
    </head>
    
    <body>
    <h1>Donation Confirmation</h1>
<!-- php code to print the msg for the donation confirmation page -->
    <div>
        <?php echo $msg ?>
    
    </div>                                        
            
    </body>
    </html>