<?php
$transactionRef = gmdate("YHs");
$c2bPhoneNumber = "254708374149";
$realPhoneNumber = "254713196504";
$testAmount = 1;

//$callbackURL = 'https://webhook.site/ae877091-9700-40da-8016-b02114ab3d01';
$baseUrl = "https://littlereuby.com/checkout/mobile/";
$callbackURL = "{$baseUrl}callback.php";
$confirmationURL = "{$baseUrl}confirmation.php";
$validationURL = "{$baseUrl}validation.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fees Payment MPEsa</title>
    <link rel="stylesheet" type="text/css" href="../vendor/bower-asset/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/bower-asset/font-awesome/css/font-awesome.css"/>
</head>

<body>
<!--<div class="jumbotron text-center">-->
<!--    <h1>MOBILE MONEY PAYMENTS</h1>-->
<!--    <p>Please select your payment method</p>-->
<!--</div>-->

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="ajax-response"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- form -->
            <form enctype="multipart/form-data" action="process-mpesa.php" method="post" name="mpesa-form"
                  id="mpesa-form">
                <div class="card">
                    <div class="card-header bg-success text-white">MOBILE MONEY PAYMENTS</div>
                    <div class="card-body">


                        <div class="form-group">
                            <label for="transaction-type">Choose shortcode:</label>
                            <select class="form-control" name="businessShortCode" id="businessShortCode">
                                <option value="174379">174379</option>
                                <option value="600344" selected>600344</option>
                                <option value="600000">600000</option>
                                <option value="600610">600610</option>
                                <option value="600147">600147</option>
                                <option value="601426">601426</option>
                                <option value="600256">600256</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="transaction-type">Choose transaction type:</label>
                            <select class="form-control" name="transactionType" id="transactionType">
                                <option value="CustomerPayBillOnline">CustomerPayBillOnline</option>
                                <option value="CustomerBuyGoodsOnline">CustomerBuyGoodsOnline</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone">Reference Number</label>
                            <input type="text" class="form-control" id="refNumber" name="refNumber"
                                   aria-describedby="refNumberHelp"
                                   placeholder="Reference Number" required="required" value="<?= $transactionRef ?>">
                            <small id="refNumberHelp" class="form-text text-muted">Enter your reference number i.e
                                Student Registration Number
                            </small>
                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="stkPhone">STK Paying Phone Number</label>
                                    <input type="text" class="form-control" id="stkPhone" name="stkPhone"
                                           aria-describedby="stkPhone"
                                           placeholder="Enter Phone number" required="required"
                                           value="<?= $realPhoneNumber ?>">
                                    <small id="phoneHelp" class="form-text text-muted">Enter phone number you'll be
                                        paying
                                        from using STK
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="c2bPhone">C2B Paying Phone Number</label>
                                    <input type="text" class="form-control" id="c2bPhone" name="c2bPhone"
                                           aria-describedby="c2bPhone"
                                           placeholder="Enter Phone number" required="required"
                                           value="<?= $c2bPhoneNumber ?>">
                                    <small id="phoneHelp" class="form-text text-muted">Enter phone number you'll be
                                        paying from using C2B
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount"
                                   aria-describedby="amountHelp"
                                   placeholder="Enter Amount" required="required" value="<?= $testAmount ?>">
                            <small id="amountHelp" class="form-text text-muted">Enter amount you want to pay</small>
                        </div>

                        <!-- callback urls section -->
                        <div class="form-group">
                            <label for="callbackURL">Callback URL</label>
                            <input type="text" class="form-control" id="callbackURL" name="callbackURL"
                                   aria-describedby="callbackURL" value="<?= $callbackURL ?>">
                        </div>

                        <div class="form-group">
                            <label for="confirmationURL">Confirmation URL</label>
                            <input type="text" class="form-control" id="confirmationURL" name="confirmationURL"
                                   aria-describedby="confirmationURL" value="<?= $confirmationURL ?>">
                        </div>

                        <div class="form-group">
                            <label for="validationURL">Validation URL</label>
                            <input type="text" class="form-control" id="validationURL" name="validationURL"
                                   aria-describedby="validationURL" value="<?= $validationURL ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-outline-danger btn-block btn-lg"
                                        id="register-button">
                                    Register URL
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary btn-block btn-lg" id="c2b-button">
                                    C2B Simulation
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-success btn-block btn-lg" id="stk-button">
                                    STK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- form -->
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="../vendor/bower-asset/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../vendor/bower-asset/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script type="text/javascript" src="../vendor/bower-asset/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="js/ajaxCalls.js"></script>
</html