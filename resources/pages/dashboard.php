<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Authorization</title>
  <link rel="stylesheet" href="/css/app.css" />
  <script defer src="/js/app.js"></script>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
</head>

<body>
  <header class="pb-3">
    <div class="container">

      <form action="/api/logout" method="post">
        <button class="btn btn-outline-primary" type="submit">Выйти</button>
      </form>
    </div>

  </header>

  <main>
    <div class="container">
      <div class="row">
        <? foreach ($currencies as $currency) : ?>
          <div class="col-6 border-bottom py-3 valuta">
            <div class="row h-100">
              <div class="col-6 d-flex flex-column justify-content-between">
                <label for="">
                  <?= $currency['title'] ?>
                </label>
                <input type="number" class="form-control nominal" data-nominal="<?= $currency['nominal'] ?>" value="<?= $currency['nominal'] ?>">
              </div>

              <div class="col-6 d-flex flex-column justify-content-between">
                <label for="">
                  Российский рубль
                </label>
                <input type="number" class="form-control value" data-value="<?= $currency['value'] ?>" value="">
              </div>

            </div>
          </div>
        <? endforeach ?>
      </div>
    </div>
</body>

</html>