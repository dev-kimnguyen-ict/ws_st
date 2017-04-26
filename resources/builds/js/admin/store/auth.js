import axios from 'axios'
import { AuthenticationException } from 'lib/exceptions'
import authApi from '../api/auth'

const namespace = '/auth'

const state = {
    user: null,
    oauth: null
}

const getters = {
    userId: (state) => {
        return state.user ? state.user.id : null
    }
}

const actions = {
    login({ commit, dispatch }, credentials) {
        return authApi.login(credentials)
            .then(({ data }) => {
                commit('SET_OAUTH', data)
                return dispatch('fetchUser')
            }).catch((e) => {
                throw new AuthenticationException(e.message)
            })
    },
    logout({ commit }) {
        return axios.post('/logout').then(() => {
            commit('SET_USER', null)
        })
    },
    fetchUser({ commit }) {
        return axios.get('/api/user')
            .then(({ data }) => {
                commit('SET_USER', data)
                return data
            }).catch((e) => {
                commit('SET_USER', null)
                return null
            })
    }
}

const mutations = {
    SET_USER(state, user) {
        state.user = user
    },
    SET_OAUTH(state, oauth) {
        state.oauth = oauth
    }
}

export default {
    namespaced: true,
    namespace,
    state,
    actions,
    mutations,
    getters
}
