<?php

// Fill in the code for the following four functions


function incomeTaxSingle($taxableIncome) {
    $incTax = 0.0;

    if ($taxableIncome <= 9700) $incTax = $taxableIncome * 0.1;
    else if ($taxableIncome > 9700 && $taxableIncome <= 39475) $incTax = 970 + (($taxableIncome - 9700) * 0.12);
    else if ($taxableIncome > 39475 && $taxableIncome <= 84200) $incTax = 4543 + (($taxableIncome - 39475) * 0.22);
    else if ($taxableIncome > 84200 && $taxableIncome <= 160725) $incTax = 14382 + (($taxableIncome - 84200) * 0.24);
    else if ($taxableIncome > 160725 && $taxableIncome <= 204100) $incTax = 32748 + (($taxableIncome - 160725) * 0.32);
    else if ($taxableIncome > 204100 && $taxableIncome <= 510300) $incTax = 46628 + (($taxableIncome - 204100) * 0.35);

    else $incTax = 153798 + (($taxableIncome - 510300) * .37);
    
    return round($incTax, 2);
}

function incomeTaxMarriedJointly($taxableIncome) {
    $incTax = 0.0;

    if ($taxableIncome <= 19400) $incTax = $taxableIncome * 0.1;
    else if ($taxableIncome > 19400 && $taxableIncome <= 78950) $incTax = 1940 + (($taxableIncome - 19400) * 0.12);
    else if ($taxableIncome > 78950 && $taxableIncome <= 168400) $incTax = 9086 + (($taxableIncome - 78950) * 0.22);
    else if ($taxableIncome > 168400 && $taxableIncome <= 321450) $incTax = 28765 + (($taxableIncome - 168400) * 0.24);
    else if ($taxableIncome > 321450 && $taxableIncome <= 408200) $incTax = 65497 + (($taxableIncome - 321450) * 0.32);
    else if ($taxableIncome > 408200 && $taxableIncome <= 612350) $incTax = 93257 + (($taxableIncome - 408200) * 0.35);

    else $incTax = 164709 + (($taxableIncome - 612350) * .37);
    
    return round($incTax, 2);
}

function incomeTaxMarriedSeparately($taxableIncome) {
    $incTax = 0.0;

    if ($taxableIncome <= 9700) $incTax = $taxableIncome * 0.1;
    else if ($taxableIncome > 9700 && $taxableIncome <= 39475) $incTax = 970 + (($taxableIncome - 9700) * 0.12);
    else if ($taxableIncome > 39475 && $taxableIncome <= 84200) $incTax = 4543 + (($taxableIncome - 39475) * 0.22);
    else if ($taxableIncome > 84200 && $taxableIncome <= 160725) $incTax = 14382.50 + (($taxableIncome - 84200) * 0.24);
    else if ($taxableIncome > 160725 && $taxableIncome <= 204100) $incTax = 32748.50 + (($taxableIncome - 160725) * 0.32);
    else if ($taxableIncome > 204100 && $taxableIncome <= 306175) $incTax = 46628.50 + (($taxableIncome - 204100) * 0.35);

    else $incTax = 82354.75 + (($taxableIncome - 306175) * .37);
    
    return round($incTax, 2);
}

function incomeTaxHeadOfHousehold($taxableIncome) {
    $incTax = 0.0;

    if ($taxableIncome <= 13850) $incTax = $taxableIncome * 0.1;
    else if ($taxableIncome > 13850 && $taxableIncome <= 52850) $incTax = 1385 + (($taxableIncome - 13850) * 0.12);
    else if ($taxableIncome > 52850 && $taxableIncome <= 84200) $incTax = 6065 + (($taxableIncome - 52850) * 0.22);
    else if ($taxableIncome > 84200 && $taxableIncome <= 160700) $incTax = 12962 + (($taxableIncome - 84200) * 0.24);
    else if ($taxableIncome > 160700 && $taxableIncome <= 204100) $incTax = 31322 + (($taxableIncome - 160700) * 0.32);
    else if ($taxableIncome > 204100 && $taxableIncome <= 510300) $incTax = 45210 + (($taxableIncome - 204100) * 0.35);

    else $incTax = 152380 + (($taxableIncome - 510300) * .37);
    
    return round($incTax, 2);
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
            <label class="control-label col-sm-2" for="netIncome">Your Net Income:</label>
            <div class="col-sm-10">
            <input type="number" step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
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

            $netIncome = $_POST['netIncome'];

            $taxSingle = incomeTaxSingle($netIncome);
            $taxMarriedJointly = incomeTaxMarriedJointly($netIncome);
            $taxMarriedSeparately = incomeTaxMarriedSeparately($netIncome);
            $taxHeadOfHousehold = incomeTaxHeadOfHousehold($netIncome);

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

</div>
</body>
</html>