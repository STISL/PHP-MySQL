<?php
  //VARIABLE TO ESTABLISH THE PATH FOR .TXT FILE:
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
        <style type="text/css">
            table, th, td {
                border-collapse: collapse;
                border: 1px solid black;
                padding: 6px;
                }
            th {background: #ccccff;}
        </style>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Customer Orders</h2>  
    <?php
        //USE FILE() FUNCTION TO LOAD ENTIRE FILE INTO AN ARRAY:
        $orders = file("$document_root/orders/orders.txt");
        //USE COUNT() FUNCTION TO COUNT HOW MANY ELEMENTS IN ARRAY:
        $numberOrders = count($orders);
        //IF NO ORDERS PLACED:
        if ($numberOrders == 0){
            echo "<p><strong>No orders pending.<br />
                Please try again later.</strong></p>";
        }

        //CREATE A TABLE TO STYLE AND DISPLAY $ORDERS ARRAY:
        echo "<table>\n";
        echo "<tr>
                <th>Order Date</th>
                <th>Tires</th>
                <th>Bottles of Oil</th>
                <th>Spark Plugs</th>
                <th>Total</th>
                <th>Shipping Address</th>
            </tr>";

        //DISPLAY EACH LINE ORDER AS STYLED ELEMENTS OF THE ARRAY:
        for ($i=0; $i<$numberOrders; $i++) {
            //SPLIT UP EACH LINE:
            $line = explode("\t", $orders[$i]);
            //EACH LINE ORDER HAS 5 INDEXES, BUT USE ONLY INDICES 1 -3 THAT CONTAIN NUMBER OF EACH ITEM ORDERED:
            $line[1] = intval($line[1]);
            $line[2] = intval($line[2]);
            $line[3] = intval($line[3]); 
            //OUTPUT EACH ORDER:
            echo "<tr>
                <td>".$line[0]."</td>
                <td style=\"text-align: right;\">".$line[1]."</td>
                <td style=\"text-align: right;\">".$line[2]."</td>
                <td style=\"text-align: right;\">".$line[3]."</td>
                <td style=\"text-align: right;\">".$line[4]."</td>
                <td>".$line[5]."</td>
            </tr>";
        } //END FOR LOOP
        echo "</table>";
    ?>
    </body>
</html>