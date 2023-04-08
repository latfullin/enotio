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
  <header></header>

  <main>
    <? foreach ($items as $item) : ?>
      <?= $item ?>
    <? endforeach ?>
</body>

</html>