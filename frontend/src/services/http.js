import axios from 'redaxios'

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Content-type': 'application/json'
  }
})

export default axiosInstance
