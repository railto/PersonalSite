export default {
    namespaced: true,
    state: {
        message: {
            text: null,
            type: null
        }
    },
    getters: {
        message: state => {
            return state.message
        }
    },
    mutations: {
        SET_MESSAGE (state, message) {
            state.message = message;
        }
    },
    actions: {
        showMessage({commit, dispatch}, message) {
            commit('SET_MESSAGE', message)
            setTimeout(() => {
                dispatch('clearMessage');
            }, 5000);
        },
        clearMessage({commit}) {
            commit('SET_MESSAGE', {
                text: null,
                type: null,
            });
        },
    }
};
