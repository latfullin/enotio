<?php
$response = '';

function view(string $page, array $data = [])
{
  extract($data, EXTR_SKIP);

  include "../resources/pages/{$page}";
}

function response($response, $status = 200)
{
  http_response_code($status);

  return json_encode($response, JSON_UNESCAPED_UNICODE);
}
