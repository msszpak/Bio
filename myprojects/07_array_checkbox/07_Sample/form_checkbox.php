<?php
   // initialize variable in the <body> output
   $msg  = '';  

   // test if at least one box is checked
     if(isset($_POST['pet'])) {

        
   // test that condition is read
    // echo "Something checked<br>";
     
  // store in varaible
     $pets = $_POST['pet'];
     
  // test the values
    // print_r($pets);
     
  // get the count of the array or number of boxes checked
    // $count = count($_POST['pet']);
     
  // test the count
     //echo "<br>The count is " . $count . "<br>";
     
         
  // variable for message
    $msg = "You have the following pets:<br>\n\r";    
         
  // loop through the array to display the values of the checked boxes  
    foreach($_POST['pet'] as $pet_checked){
     // test the values
        //echo "The pet is " . $pet_checked . "<br>";
         
         $msg .= "\t\t\t\t" . $pet_checked . "<br>\n\r";
         } // end foreach
         
     }  // end if

  // give error message if nothing checked
    else{
        $msg = "You did not check any pets\n\r";
    } // end else

?>


    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <title>07 - Checkbox Demo Results</title>

        <style>
            body {
                font-family: arial;
                font-size: 100%;
            }
            
            #outer {
                width: 960px;
                margin: 50px auto;
                padding: 10px;
                border: 1px solid #a8a8a8;
                box-shadow: 0px 0px 20px #a8a8a8;
                background-color: aliceblue;
            }
            
            h1,
            h2 {
                font-size: 1.5em;
                color: navy;
                text-align: center;
            }
            
            .info {
                text-align: left;
            }

        </style>

    </head>

    <body>
        <header>
            <h1>Humane Society</h1>
            <h2>Survey Results</h2>
        </header>


        <section id="outer">
            <h1 class="info">Your Response</h1>
            <p>
                <?php echo $msg ?>
            </p>
        </section>

    </body>
    </html>
