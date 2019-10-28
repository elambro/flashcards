
import axios from 'axios';
import * as utils from './../utils';

const DEFAULT_ERROR_MESSAGE   = 'Oops! Something went wrong.';

const DEBUG = true;

axios.interceptors.request.use( config => {
    // store.commit('LOADING',true);
    return config;
});

axios.interceptors.response.use( response => {
    // store.commit('LOADING',false);
    return response;
})

export default {

    DEBUG: DEBUG,

    /**
     * Get an axios cancel token
     * @type {Object}
     */
    CancelToken: axios.CancelToken,

    /**
     * Send a GET request via axios to the URL given
     * @param  {[type]} endpoint [description]
     * @param  {[type]} params   [description]
     * @param  {Object} options  [description]
     *
         * @param  {Object}  options.cancelToken
         * @param  {} [varname] [description]
     *
     * 
     * @return {[type]}          [description]
     */
    async all(endpoint, params, options={}) {
        params = (params||{});
        params.all = true;
        return this.get(endpoint,params,options);
    },

    /**
     * Send a GET request via axios to the URL given
     * @param  {[type]} endpoint [description]
     * @param  {[type]} params   [description]
     * @param  {Object} options  [description]
     *
         * @param  {Object}  options.cancelToken
         * @param  {} [varname] [description]
     *
     * 
     * @return {[type]}          [description]
     */
    async get(endpoint, params, options={}) {

        var defaults = {
            cancelToken: null,
            debug      : DEBUG
        };
        options = this.setDefaults(options,defaults);

        console.assert(endpoint,'An endpoint was not sent to the API GET request');
        var url = utils.url(endpoint);

        if ( (params||{}).params ) {
            console.warn('Params are double wrapped!');
        }

        // order the options correctly
        params = utils.undefToNull( utils.alphabetical(params));

        return axios.get(url, {
                params, 
                cancelToken: options.cancelToken
            })
            .then( response => {
                return Promise.resolve({
                    params: _.get(response,'config.params'),
                    ...response.data
                }); 
            })
            .catch( err => this.error(err))
    },

    /**
     * POST data to an endoint
     * @param  {String} endpoint [description]
     * @param  {Object} data     [description]
     * @return {Promise}         [description]
     */
    async post(endpoint, data, params, options={}) {
        console.assert(endpoint, 'No endpoint was given for API.post');
        return axios.post( utils.url(endpoint), utils.undefToNull(data), {params} )
            .then( response => response.data )
            .catch( err => this.error(err))
    },

    /**
     * PUT data to an endoint
     * @param  {String} endpoint [description]
     * @param  {Object} data     [description]
     * @return {Promise}         [description]
     */
    async put(endpoint, data, params, options={}) {
        console.assert(endpoint, 'No endpoint was given for API.put');
        return axios.put( utils.url(endpoint), utils.undefToNull(data), {params})
            .then( response => response.data )
            .catch( err => this.error(err))
    },

    /**
     * [delete description]
     * @param  {[type]} endpoint [description]
     * @return {[type]}          [description]
     */
    async delete(endpoint) {
        console.assert(endpoint, 'No endpoint was given for API.delete');
        return axios.delete( utils.url(endpoint) )
            .then( response => response.data )
            .catch( err => this.error(err) )
    },

    setDefaults(options, defaults){
        return _.defaults({}, _.clone(options), defaults);
    },

    error(error ) {
        // Vue.toasted.global.catch(error);
        return Promise.reject(error);
    },

/*
|--------------------------------------------------------------------------
| Auth Token
|--------------------------------------------------------------------------
| 
|   Add or remove the token from requests when loging in or out
|
*/

    // Log in using a token
    saveAuthToken( token ) {
        console.assert(token ? true : false );
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.trim();
    },

    removeAuthToken() {
        delete axios.defaults.headers.common['Authorization'];
    }

}