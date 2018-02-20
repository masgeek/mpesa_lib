<?php
$accessKey = 'f9fc9a33baba35bd8066da9d5c45fde1';
$profileID = ' 066620B5-2B5D-49FD-88DC-C4CBA247122A';
?>
<html>
<head>
    <title>Secure Acceptance - Payment Form Example</title>
    <link rel="stylesheet" type="text/css" href="payment.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/yarn-asset/font-awesome/css/font-awesome.css"/>
</head>
<body>
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
            <span>transaction_type:</span><input type="text" name="transaction_type" size="25" value="sale"><br/>
            <span>reference_number:</span><input type="text" name="reference_number" size="25"
                                                 value="<?php echo gmdate("YmdHis"); ?>"><br/>
            <span>amount:</span><input type="text" name="amount" value="10.00" size="25"><br/>
            <span>currency:</span><input type="text" name="currency" value="KES" size="25"><br/>
        </div>
    </fieldset>
    <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-outline-primary btn-block btn-lg"/>


    <script type="text/javascript" src="../vendor/yarn-asset/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="payment_form.js"></script>
</form>
</body>
</html>
