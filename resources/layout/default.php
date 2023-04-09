<!DOCTYPE html>
<html lang="en">

<?= component('head') ?>

<body class="py-3">
  <header class="pb-3">
    <div class="container">
      <? if (auth()) : ?>
        <form class="logout">
          <button class="btn btn-outline-primary " type="submit">Выйти</button>
        </form>
      <? else : ?>
        <?= component('nav') ?>
      <? endif ?>
    </div>
  </header>

  <main>
    <?= $content ?>
  </main>
</body>

</html>