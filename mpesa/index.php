<?php
$transactionRef = gmdate("YHs");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fees Payment MPEsa</title>
    <link rel="stylesheet" type="text/css" href="../vendor/yarn-asset/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/yarn-asset/font-awesome/css/font-awesome.css"/>
</head>

<body>
<div class="jumbotron text-center">
    <h1>MOBILE MONEY PAYMENTS</h1>
    <p>Please select your payment method</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!-- form -->
            <form enctype="multipart/form-data" action="process_mpesa.php" method="post" name="mpesa-form">
                <div class="card">
                    <div class="card-header bg-success text-white">MOBILE MONEY PAYMENTS</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="phone">Reference Number</label>
                            <input type="text" class="form-control" id="refNumber" name="refNumber"
                                   aria-describedby="refNumberHelp"
                                   placeholder="Reference Number" required="required" value="<?= $transactionRef ?>">
                            <small id="refNumberHelp" class="form-text text-muted">Enter your reference number i.e
                                Student Registration Number
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="phone">Paying Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp"
                                   placeholder="Enter Phone number" required="required" value="254713196504">
                            <small id="phoneHelp" class="form-text text-muted">Enter phone number you'll be paying from
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount"
                                   aria-describedby="amountHelp"
                                   placeholder="Enter Amount" required="required" value="1">
                            <small id="amountHelp" class="form-text text-muted">Enter amount you want to pay</small>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Proceed</button>
                    </div>
                </div>
            </form>
            <!-- form -->
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="../vendor/yarn-asset/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../vendor/yarn-asset/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<link rel="stylesheet" type="text/css" href="../vendor/yarn-asset/bootstrap/dist/js/bootstrap.js"/>

<script type="application/javascript">
    jQuery(function ($) {
        $("#phone").mask("254999999999", {placeholder: " "});
        $("#amount").mask("9?999999999", {placeholder: " "});
        //$("#refNumber").mask("a9?9/9999999", {placeholder: " "});
    });
</script>
</html