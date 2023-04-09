import axios from "axios";

const formAuth = document.querySelector('.form-auth')
const logout = document.querySelector('.logout')
let errorVisible = false

if (formAuth) {
  const error = formAuth.querySelector('.invalid-feedback')

  const authorization = async (e) => {
    e.preventDefault();

    const result = await axios.post('/api/authorization', new FormData(formAuth))
    if (result.data.success) {
      window.location.href = '/dashboard'
    } else {
      showError(result.data.error)
    }
  }
  formAuth.addEventListener('submit', async (e) => await authorization(e))

  const showError = (msg) => {
    errorVisible = true
    error.innerHTML = msg
    error.style.display = 'block'
  }
}

if (logout) {
  const logoutProfile = (e) => {
    e.preventDefault()

    axios.post('/api/logout').then(() => window.location.href = '/')
  }

  logout.addEventListener('submit', logoutProfile)
}