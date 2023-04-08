import axios from "axios";

const formAuth = document.querySelector('.form-auth')

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