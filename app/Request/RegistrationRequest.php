<?

namespace App\Request;

class RegistrationRequest
{
  protected array $fields;
  protected array $errors;
  protected bool $error = true;

  public function __construct(array $fields)
  {
    $this->fields = $fields;
  }

  public function validateFields(): bool
  {
    $this->error = true;

    $this->login();
    $this->password();
    $this->confirmPassword();

    return $this->error;
  }

  public function getErrors()
  {
    return $this->errors;
  }

  protected function password()
  {
    if (strlen($this->fields['password']) > 11) {
      return $this->addError('password', 'Превыше длина');
    }

    if (strlen($this->fields['password'] < 3)) {
      return $this->addError('password', 'Минимум 3 символа');
    }
  }

  protected function confirmPassword()
  {
    if ($this->fields['password'] !== $this->fields["confrim-password"]) {
      $this->addError('confirmPassword', 'Парои не совпадают');
    }
  }

  protected function login()
  {
    if (strlen($this->fields['login'] < 3)) {
      $this->addError('login', 'Минимум 3 символа');
    }
  }

  protected function addError(string $key, string $msg): void
  {
    $this->error = false;
    $this->errors['errors'][$key] = $msg;
  }
}
