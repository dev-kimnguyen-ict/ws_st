import axios from 'axios'

const grant_type = 'password'

export default {
    login({ email, password }) {
        return axios.post('/oauth/token', {
            grant_type,
            username: email,
            password,
        })
    }
}
