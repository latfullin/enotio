
import axios from "axios"

const $registration = document.querySelector('.form-registration')

if ($registration) {
  const errorLogin = $registration.querySelector('.error-login')
  const errorPassword = $registration.querySelector('.error-password')
  const errorConfrimPassword = $registration.querySelector('.error-confirm-password')

  const $fieldName = $registration.querySelector('input[name="login"]')
  const $fieldPassword = $registration.querySelector('input[name="password"]')
  const $fieldConfirmPassword = $registration.querySelector('input[name="confrim-password"]')


  const showErrorLogin = (msg) => {
    errorLogin.innerHTML = msg
    errorLogin.style.display = 'block'
  }

  const showErrorPassword = (msg) => {
    errorPassword.innerHTML = msg
    errorPassword.style.display = 'block'
  }
  const showErrorConfirmPassword = (msg) => {
    errorConfrimPassword.innerHTML = msg
    errorConfrimPassword.style.display = 'block'
  }

  const hiddenErrorLogin = () => {
    errorLogin.innerHTML = ''
    errorLogin.style.display = 'none'
  }

  const hiddenErrorPassword = () => {
    errorPassword.innerHTML = ''
    errorPassword.style.display = 'none'
  }
  const hiddenErrorConfirmPassword = () => {
    errorConfrimPassword.innerHTML = ''
    errorConfrimPassword.style.display = 'none'
  }

  const checkLogin = (field) => {
    if (field.value.length < 3) {
      return showErrorLogin('Минимум 3 символа')
    }
    hiddenErrorLogin()
  }

  const checkPassword = (field) => {
    if (field.value.length > 6) {
      return showErrorPassword('Превышена длина')
    }
    checkDoublePassword()
    hiddenErrorPassword()
  }

  const checkDoublePassword = () => {
    if ($fieldPassword.value !== $fieldConfirmPassword.value) {
      return showErrorConfirmPassword('Пароли не совпадают')
    }
    hiddenErrorConfirmPassword()
  }

  $fieldName.addEventListener('input', () => checkLogin($fieldName))
  $fieldPassword.addEventListener('input', () => checkPassword($fieldPassword))
  $fieldConfirmPassword.addEventListener('input', () => checkDoublePassword($fieldConfirmPassword))


  const viewError = (error) => {
    if (error.login) {
      showErrorLogin(error.login)
    }

    if (error.passoword) {
      showErrorPassword(error.passoword)
    }

    if (error.confirmPassword) {
      showErrorConfirmPassword(error.confirmPassword)
    }
  }


  const sendForm = async (e) => {
    e.preventDefault();

    const result = await axios.post('/api/registration',
      new FormData($registration)
    )

    if (result.data?.success) {
      window.location.href = '/autorization'
    } else {
      viewError(result.data.error)
    }
  }
  $registration.addEventListener('submit', sendForm)
}