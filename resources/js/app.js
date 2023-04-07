import axios from "axios"

const $registration = document.querySelector('.form-registration')

if ($registration) {
  const sendForm = (e) => {
    e.preventDefault();

    axios.post('/api/registration',
      new FormData($registration)
    ).then((e) => console.log(e.data))
  }

  const checkLength = (e) => {
    console.log(e.classList)
    if (e.value.length < 6) {
      e.classList.add('is-invalid')
    } else {
      e.classList.remove('is-invalid')
    }
  }

  const $fieldName = $registration.querySelectorAll('input[name="login"]')

  $fieldName.addEventListener('input', () => checkLength($fieldName))

  const $fieldPassword = $registration.querySelectorAll('input[type="password"]')

  $fieldPassword.forEach((field) => {

  })

  $registration.addEventListener('submit', sendForm)
}