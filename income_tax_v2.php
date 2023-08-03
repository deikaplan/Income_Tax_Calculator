<?php

define('TAX_RATES',
  array(
    'Single' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,510300),
      'MinTax' => array(0, 970,4543,14382,32748,46628,153798)
      ),
    'Married_Jointly' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,19400,78950,168400,321450,408200,612350),
      'MinTax' => array(0, 1940,9086,28765,65497,93257,164709)
      ),
    'Married_Separately' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,306175),
      'MinTax' => array(0, 970,4543,14382.50,32748.50,46628.50,82354.75)
      ),
    'Head_Household' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,13850,52850,84200,160700,204100,510300),
      'MinTax' => array(0, 1385,6065,12962,31322,45210,152380)
      )
    )
);

// Fill in the code for the following function

function incomeTax($taxableIncome, $status) {
  $taxData = TAX_RATES[$status];
  for ($i = count($taxData['Rates']) - 1; $i >= 0; $i--) {
    if ($taxableIncome > $taxData['Ranges'][$i]) {
      return $taxData['MinTax'][$i] + $taxData['Rates'][$i] / 100 * ($taxableIncome - $taxData['Ranges'][$i]);
    }
  }
  return 0.0; 
}



function displayTaxTables() {
  $output = "<table class='table'>";
  foreach (TAX_RATES as $status => $data) {
    // prints tax status and column headings before printing the table
    $output .= "<tr><th colspan='2'>$status</th></tr>";
    $output .= "<tr><th>Taxable Income</th><th>Tax Rate</th></tr>";
    // loops through every tax rate, and creates a table row
    for ($i = 0; $i < count($data['Rates']); $i++) {
      $rangeStart = $data['Ranges'][$i] + 1;
      $rangeEnd = $i < count($data['Rates']) - 1 ? $data['Ranges'][$i + 1] : "and over";
      $output .= "<tr>";
      // check if this is the first iteration through the table's rows
      if ($i == 0) {
        $output .= "<td>\$0 - \$" . number_format($rangeEnd) . "</td>";
        $output .= "<td>{$data['Rates'][$i]}%</td>";
      } else {
        // if rangeEnd is "and over", it won't be formatted to currency format
        if (is_numeric($rangeEnd)) {
          $rangeEnd = number_format($rangeEnd);
      }
      $output .= "<td>\$" . number_format($rangeStart) . " - " . ($rangeEnd === "and over" ? $rangeEnd : "\$" . $rangeEnd) . "</td>";
      $output .= "<td>\$" . number_format($data['MinTax'][$i]) . " plus " . $data['Rates'][$i] . "% of the amount over \$" . number_format($rangeStart) . "</td>";
    }
      $output .= "</tr>";
    }
    // blank row
    $output .= "<tr><td colspan='2'></td></tr>";  
  }
  $output .= "</table>";
  return $output;
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Income Tax Calculator - Kaplan</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2">Enter Net Income:</label>
        <div class="col-sm-10">
          <input type="number"  step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
        </div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>

    </form>

    <?php

        // Fill in the rest of the PHP code for form submission results

        if(isset($_POST['netIncome'])) {

            // echo "Results...";
            $netIncome = $_POST['netIncome'];

            $taxSingle = incomeTax($netIncome, 'Single');
            $taxMarriedJointly = incomeTax($netIncome, 'Married_Jointly');
            $taxMarriedSeparately = incomeTax($netIncome, 'Married_Separately');
            $taxHeadOfHousehold = incomeTax($netIncome, 'Head_Household');


            echo "<h4>With a net taxable income of $$netIncome</h4>";
            echo "<br>";
            echo "<h4>Results:</h4>";
            echo "<br>";
            echo "<table class=\"table table-striped\" style=\"width:70%;\">";
            echo "<thead><tr><th>Filing Status</th><th>Taxable Amount</th></tr></thead>";
            echo "<tbody>";
            echo "<tr><td>Single</td><td>$" . number_format($taxSingle, 2) . "</td></tr>";
            echo "<tr><td>Married Filing Jointly</td><td>$" . number_format($taxMarriedJointly, 2) . "</td></tr>";
            echo "<tr><td>Married Filing Separately</td><td>$" . number_format($taxMarriedSeparately, 2) . "</td></tr>";
            echo "<tr><td>Head of Household</td><td>$" . number_format($taxHeadOfHousehold, 2) . "</td></tr>";
            echo "</tbody>";
            echo "</table>";

        }

    ?>

    

    <h3>2019 Tax Tables</h3>

    <?php

      // Fill in the code for Tax Tables display

      echo displayTaxTables();

    ?>

   
       
</div>

</body>
</html>