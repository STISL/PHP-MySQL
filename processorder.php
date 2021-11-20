<!--
Assignment from: Luke, Welling; Thomson Laura. PHP and MySQL Web Development (Developer's Library).
STUDENT: F.RUSTIQUE
-->

<!DOCTYPE html>
<!--USE PHP SCRIPT DELIMETER TO INDICATE PHP CODING. 
DECLARE VARIABLES & POINTERS TO USE -->
<?php
  //PHP VARIABLE NAMES ASSIGNED TO HTML FORM'S INPUT FIELD NAMES:
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $address = preg_replace('/\t|\R/',' ',$_POST['address']);
  
  //USE DOCUMENT_ROOT AS PART OF FILE PATH
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  
  //DECLARE & DEFINE CONSTANTS:
  define('TIREPRICE', 100);
  define('OILPRICE', 10);
  define('SPARKPRICE', 4);
?><!--END PHP SCRIPT DELIMETER -->
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Order Results</h2>
        <?php
            /*OPEN FILE AS $FP TO WRITE ORDERS TO.
            PREFIX $FP WITH @ FOR ERROR SUPPRESSION*/
            @$fp = fopen("$document_root/orders/orders.txt", 'ab');
            
            //IF FILE DOESN'T EXIST OR CAN'T BE WRITTEN TO, EXIT:
            if (!$fp) {
                echo "<p><strong>Your order could not be processed at this time. Please try again later.</strong></p>";
                exit; //NOTHING BELOW HERE GETS RENDERED
            }
            
            //CALULATE NUMERICAL RESULTS FROM INPUTTED DATA, CONSTANTS, AND SET TAX RATE:
            $totalqty = 0; //need to initialize to something
            $totalqty = $tireqty + $oilqty + $sparkqty;
            $subTotal = 0; //need to initialize to something
            $subTotal = ($tireqty * TIREPRICE)
                        + ($oilqty * OILPRICE)
                        + ($sparkqty * SPARKPRICE);
            $taxrate = 0.10;  // local sales tax is 10%
            $totalamount = 0.00; //need to initialize to something
            $totalamount = $subTotal * (1 + $taxrate);

            //CONSTRUCT A STRING THAT REPRESENTS ONE RECORD IN THE DATA FILE:
            $date = date("H:i: Y-m-d");
            $outputstring = $date. "\t" .$tireqty. " tires\t" .$oilqty." bottle of oil\t" .$sparkqty. " spark plugs\t\$" .number_format($totalamount,2). "\t" .$address. "\n"; //USE TAB CHARACTER AND NEWLINE SO EACH NEW ORDER IS ENTERED WITH READABILITY AND ON A NEW LINE IN THE ORDERS FILE

            //WRITE ORDER INFO FROM $OUTPUTSTRING TO THE THE ORDERS.TXT FILE:
            fwrite($fp, $outputstring, strlen($outputstring));

            //CLOSE THE ORDERS.TXT FILE:
            fclose($fp);

            //OUTPUT WEB PAGE RESULTS OF ORDER:
            echo '<p>Your order is as follows: </p>';
            echo htmlspecialchars($tireqty).' tires<br />';
            echo htmlspecialchars($oilqty).' bottles of oil<br />';
            echo htmlspecialchars($sparkqty).' spark plugs<br />';
            echo "<p>Items orderd: $totalqty </p>";
            echo "Subtotal: $".number_format($subTotal,2)."<br />";
            echo "Your total bill with tax is: $".number_format($totalamount,2)."</p>";
            echo "<p>Shipping to: $address </p>";
            echo "<p>Order processed at " .$date. "</p>";
        ?><!--END PHP SCRIPT DELIMETER -->
    </body>
</html>