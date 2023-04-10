<div class="container">
  <div class="row justify-content-between">
    <? foreach ($currencies as $currency) : ?>
      <div class="col-5 border-bottom py-3 valuta">
        <div class="row h-100">
          <h5>
            <?= $currency['title'] ?>
          </h5>
          <div class="col-6 d-flex flex-column justify-content-between">
            <label for="">
              <?= $currency['title'] ?>
            </label>
            <input type="number" class="form-control nominal" min="<?= $currency['nominal'] ?>" step="<?= $currency['nominal'] ?>" data-nominal="<?= $currency['nominal'] ?>" value="<?= $currency['nominal'] ?>">
          </div>

          <div class="col-6 d-flex flex-column justify-content-between">
            <label for="">
              Российский рубль
            </label>
            <input type="number" class="form-control value" min="<?= $currency['value'] ?>" step="<?= $currency['value'] ?>" data-value="<?= $currency['value'] ?>" value="">
          </div>
        </div>
      </div>
    <? endforeach ?>
  </div>
</div>