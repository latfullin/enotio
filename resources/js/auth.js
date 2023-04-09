import axios from "axios";

const formAuth = document.querySelector('.form-auth')
const logout = document.querySelector('.logout')

if (formAuth) {
  const authorization = async (e) => {
    e.preventDefault();

    const result = await axios.post('/api/authorization', new FormData(formAuth))
    if (result.status === 200) {
      window.location.href = '/dashboard'
    }
  }

  formAuth.addEventListener('submit', authorization)
}

if (logout) {
  const logoutProfile = (e) => {
    e.preventDefault()

    axios.post('/api/logout').then(() => window.location.href = '/')
  }

  logout.addEventListener('submit', logoutProfile)
}