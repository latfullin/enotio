import axios from "axios"

const $registration = document.querySelector('.form-registration')

if ($registration) {
  let passwordField = [];
  const sendForm = (e) => {
    e.preventDefault();

    const result = axios.post('/api/registration',
      new FormData($registration)
    ).then((e) => console.log(e))

    if (result.status == 200) {
      console.log(result.data)
    } else {
      console.log(result.data)
    }
  }

  const checkLength = (e) => {
    console.log(e.classList)
    if (e.value.length < 6) {
      e.classList.add('is-invalid')
    } else {
      e.classList.remove('is-invalid')
    }
  }

  const $fieldName = $registration.querySelector('input[name="login"]')

  $fieldName.addEventListener('input', () => checkLength($fieldName))

  const $fieldPassword = $registration.querySelectorAll('input[type="password"]')

  const checkPassword = (field) => {
    checkLength(field)
    checkDoublePassword()
  }

  const checkDoublePassword = () => {
  }

  $fieldPassword.forEach((field) => {
    passwordField.push(field)
    field.addEventListener('input', () => checkPassword(field))
  })

  $registration.addEventListener('submit', sendForm)
}