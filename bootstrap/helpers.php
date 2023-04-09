<?php
function view(string $page, array $data = [])
{
  extract($data, EXTR_SKIP);

  ob_start();

  include "../resources/pages/{$page}";

  $content = ob_get_clean();

  include "../resources/layout/default.php";
}

function response($response, $status = 200)
{
  http_response_code($status);

  return json_encode($response, JSON_UNESCAPED_UNICODE);
}

function includePage($page)
{
  include "../resources/pages/{$page}";
}

function auth()
{
  if ($_SESSION['auth'] ?? false) {
    return true;
  } else {
    return false;
  }
}


function component($component, $data = [])
{
  ob_start();

  include "../resources/components/{$component}.php";

  return ob_get_clean();
}
