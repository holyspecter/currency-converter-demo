<html>
    <head>
        <title>Currency converter demo app</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <p><?= $amount?> EUR = <?= $calculatedAmount ?> <?= $currencyTitle ?></p>
            <a href="/" class="btn btn-default">Back</a>
        </div>
    </body>
</html>
