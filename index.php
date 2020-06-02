<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fees Payment Demo</title>
    <link rel="stylesheet" type="text/css" href="/vendor/bower-asset/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/vendor/bower-asset/font-awesome/css/font-awesome.css"/>
</head>

<body>
<div class="jumbotron text-center">
    <h1>Student FEES Payment</h1>
    <p>Please select your payment method</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-success text-white">MOBILE MONEY PAYMENTS</div>
                <div class="card-body">
                    <p>
                        Pay your school fees using MPesa
                    </p>
                    <p>
                        <i class="fa fa-mobile-phone fa-4x"></i>
                    </p>
                </div>
                <div class="card-footer"><a href="mobile/index.php" class="btn btn-outline-success btn-block btn-lg">MOBILE
                        MONEY</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-primary text-white">CARD PAYMENTS</div>
                <div class="card-body">
                    <p>
                        Pay your school fees using credit/debit card
                    </p>
                    <p>
                        <i class="fa fa-cc-mastercard fa-4x"></i>
                        <i class="fa fa-cc-visa fa-4x"></i>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="card/" class="btn btn-outline-primary btn-block btn-lg disabled">CARD</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="/vendor/bower-asset/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="/vendor/bower-asset/bootstrap/dist/js/bootstrap.js"></script>
</html>