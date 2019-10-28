const DEFAULT_ERROR_MESSAGE   = 'Oops! Something went wrong.';
const SESSION_EXPIRED_MESSAGE = 'Your session expired. Please log in.';

function getErrorMessage(response) {

    var code = response.status || (response.data||{}).code;

    if ( code === 401 ) {
        return [SESSION_EXPIRED_MESSAGE];
    }

    if ( code === 500 ) {
        return [DEFAULT_ERROR_MESSAGE];
    }

    var errors;
    if ((response.data||{}).error) {
        errors = response.data.error;
    } else if ( response.data && typeof response.data === 'object' ) {
        errors = response.data;
    } else {
        console.error(response);
        return [DEFAULT_ERROR_MESSAGE];
    }

    var array = typeof errors === 'string' ? [errors] : _.values( _.flatten( _.toArray( errors )) );

    return array.filter(r => r && !Number.isInteger(r) && typeof r === 'string' );

}



Vue.mixin({
    methods: {
        $toastCatch(err) {

            var response = err && typeof err === 'object' ? err.response : false;
            var messages;

            if ( response ) {
                messages = getErrorMessage(response);
            } else if ( typeof err === 'string') {
                messages = [err];
            } else {
                console.error(err);
                messages = [DEFAULT_ERROR_MESSAGE];
            }
            messages.forEach(m => this.$toasted.error(m));
        }
    }
})