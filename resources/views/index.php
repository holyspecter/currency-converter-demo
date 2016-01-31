<html>
    <head>
        <title>Currency converter demo app</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <?php
            // @todo: fix getting error from session
            $flashError = $error; // ?? Session::get('error');
            if ($flashError) : ?>
                <p class="alert alert-danger"><?= $flashError ?></p>
            <?php endif ?>
            <form action="/calculate" method="post">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" />
                </div>
                <div class="form-group">
                    <label for="currency">Currency</label>
                    <select name="currency" id="currency">
                        <?php foreach ($currencies as $currency): ?>
                            <option value="<?= $currency->title ?>"><?= $currency->title ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
