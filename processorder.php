<!--
Assignment from: Luke, Welling; Thomson Laura. PHP and MySQL Web Development (Developer's Library).
STUDENT: F.RUSTIQUE
-->

<!DOCTYPE html>
<!--USE PHP SCRIPT DELIMETER TO INDICATE PHP CODING -->
<?php
  //CREATE PHP VARIABLE NAMES ASSIGNED TO HTML FORM INPUT FIELD NAMES:
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $address = $_POST['address'];
  $totalqty = 0;
  $totalamount = 0.00;
  //DECLARE & DEFINE CONSTANTS:
  define('TIREPRICE', 100);
  define('OILPRICE', 10);
  define('SPARKPRICE', 4);
?> <!--END PHP SCRIPT DELIMETER -->
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Order Results</h2>
        <?php
            echo '<p>Your order is as follows: </p>';
            echo htmlspecialchars($tireqty).' tires<br />';
            echo htmlspecialchars($oilqty).' bottles of oil<br />';
            echo htmlspecialchars($sparkqty).' spark plugs<br />';

            $totalqty = 0;
            $totalqty = $tireqty + $oilqty + $sparkqty;
            echo "<p>Items orderd: $totalqty </p>";

            $totalamount = 0.00;
            $totalamount = ($tireqty * TIREPRICE)
                         + ($oilqty * OILPRICE)
                         + ($sparkqty * SPARKPRICE);

            echo "Subtotal: $".number_format($totalamount,2)."<br />";

            $taxrate = 0.10;  // local sales tax is 10%
            $totalamount = $totalamount * (1 + $taxrate);
            echo "Your total bill with tax is: $".number_format($totalamount,2)."</p>";

            echo "<p>Shipping to: $address </p>";
            echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";
        ?>
    </body>
</html>