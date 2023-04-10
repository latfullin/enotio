<?php

namespace App\Service;

use App\Models\Currency;

class ExchangeRatesService
{
  protected ?Currency $currency = null;
  protected string $data;
  protected \SimpleXMLElement $xml;
  const UrlBank = "http://www.cbr.ru/scripts/XML_daily.asp";

  public function __construct()
  {
    $this->currency = new Currency();
  }

  public function checkExchangeRate()
  {
    $this->getTheExchangeRate();
    $this->readXmlElement();
    $this->updateExchangeRate();
  }

  protected function getTheExchangeRate()
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, self::UrlBank);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    $this->data = curl_exec($ch);
    curl_close($ch);
  }

  protected function readXmlElement()
  {
    $this->xml =  new \SimpleXMLElement($this->data);
  }

  protected function updateExchangeRate()
  {
    foreach ($this->xml->Valute as $xml) {
      if (!$this->currency->getCurrency($xml->NumCode)) {
        $this->currency->insertCurrency([
          'num_code' => $xml->NumCode,
          'char_code' => $xml->CharCode,
          'nominal' => $xml->Nominal,
          'title' => $xml->Name,
          'value' =>  str_replace(',', '.', $xml->Value)
        ]);
      } else {
        $this->currency->update($xml);
      }
    }
  }
}
