const $currencies = document.querySelectorAll('.valuta')

const numberFormat = new Intl.NumberFormat("ru-RU", {
  maximumFractionDigits: 2,
});

const precisionRound = (number, precision) => {
  var factor = Math.pow(10, precision);
  return Math.round(number * factor) / factor;
}

if ($currencies) {
  $currencies.forEach((currency) => {
    const nominal = currency.querySelector('.nominal')
    const nominalValue = currency.querySelector('.value')

    nominalValue.value = +nominalValue.dataset.value.replace(",", ".");
    nominal.value = +nominal.value.replace(",", ".");

    const updateSum = () => {
      const floatValue = +nominalValue.dataset.value.replace(",", ".");
      const floatValue2 = +nominal.value.replace(",", ".");

      nominalValue.value = (floatValue2 * floatValue).toFixed(4)
    }

    const updateNominal = () => {
      const valueOneNominal = +nominalValue.dataset.value.replace(",", ".");
      const currentValue = +nominalValue.value.replace(",", ".");

      nominal.value = (currentValue / valueOneNominal).toFixed(2)
    }

    nominal.addEventListener('input', updateSum)
    nominalValue.addEventListener('input', updateNominal)
  })
}

