<?php
$accessKey = 'f9fc9a33baba35bd8066da9d5c45fde1';
$profileID = '066620B5-2B5D-49FD-88DC-C4CBA247122A';
$amount = number_format(10, 2);
$transactionRef = gmdate("YmdHis");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fees Payment Demo</title>
    <link rel="stylesheet" type="text/css" href="../vendor/yarn-asset/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/yarn-asset/font-awesome/css/font-awesome.css"/>
</head>

<body>
<div class="jumbotron text-center">
    <h1>Student FEES Payment</h1>
    <p>CARD PAYMENT</p>
</div>

<div class="container">
    <form id="payment_form" action="payment_confirmation.php" method="post">
        <input type="hidden" name="access_key" value="<?= $accessKey ?>">
        <input type="hidden" name="profile_id" value="<?= $profileID ?>">
        <input type="hidden" name="transaction_uuid" value="<?php echo uniqid() ?>">
        <input type="hidden" name="signed_field_names"
               value="access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency">
        <input type="hidden" name="unsigned_field_names">
        <input type="hidden" name="signed_date_time" value="<?php echo gmdate("Y-m-d\TH:i:s\Z"); ?>">
        <input type="hidden" name="locale" value="en">
        <fieldset>
            <legend>Payment Details</legend>
            <div id="paymentDetailsSection" class="section">

                <div class="form-group">
                    <label for="transaction_type">Transaction Type</label>
                    <input type="text" readonly="readonly" name="transaction_type" class="form-control" value="sale">
                </div>

                <div class="form-group">
                    <label for="reference_number">Reference Number</label>
                    <input type="text" readonly="readonly" name="reference_number" class="form-control"
                           value="<?= $transactionRef ?>">
                </div>


                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" class="form-control" value="<?= $amount ?>">
                </div>

                <div class="form-group">
                    <label for="currency">Currency</label>
                    <input type="text" readonly="readonly" name="currency" class="form-control" value="KES">
                </div>
        </fieldset>
        <div class="form-group">
            <input type="submit" id="submit" name="submit" value="Submit"
                   class="btn btn-outline-primary btn-block btn-lg"/>
        </div>
    </form>
</div>

<script type="text/javascript" src="../vendor/yarn-asset/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../vendor/yarn-asset/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="payment_form.js"></script>
</body>

</html>