/* global Promise, _ */
var qs = require('qs');

// See https://stackoverflow.com/questions/39538473/using-settimeout-on-promise-chain
export function delay(t) {
   return new Promise(resolve => setTimeout(resolve, t));
}

/**
 * Format a URL correctly for an axios request. It should NOT have a trailing slash
 * @param  {String} string
 * @return {String}       
 */
export function url(string) {
    // The 'http://domains.com' is already in there. 
    // Take it out or axios will append the base twice
    if ( string && string.includes(window.Laravel.AppRoot) ) {
        string = string.replace(window.Laravel.AppRoot, '');
    }

    // Remove leading & trailing slashes
    var url = !string || string === '/' ? string : string.replace(/^\/|\/$/g, '');

    var subdir = window.Laravel.AppRoot.replace(/.*\/\/[^\/]*/, '');

    // Add a leading slash
    return url ? subdir + '/' + url : url;
}

/**
 * Get a random string of N chars which starts with a letter.
 * @param  {[type]} N
 * @return {[type]}  
 */
export function random(N) {
    let letter = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
    N -= 1;
    return letter + Array(N+1).join((Math.random().toString(36)+'00000000000000000').slice(2, 18)).slice(0, N);

    // lodash:  _.times(20, () => _.random(35).toString(36)).join(''),
};

export function randomInt(min=1, max=100) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}

/**
 * Sorts the given object in alphabetical order by keys in lower case
 * @param  {[type]} object
 * @return {[type]}       
 */
export function alphabetical(object) {
    if ( !object ) {
        return {};
    }
    var keys = Object.keys(object);//.map(i=>i.$lower());
    keys.sort();
    var obj = {};
    keys.forEach(key=>obj[key] = object[key]);
    return obj;
}

/**
 * Build a query string on the URL with the given object
 * @param  {[type]} url   
 * @param  {[type]} object
 * @return {[type]}       
 */
export function stringify(url,object) {
    return url + (object ? ( ( url && url.includes('?') ? '&' : '?' ) +  qs.stringify(alphabetical(object))) : '' );
}

/**
 * Parse a query string and get an object
 * @param  {[type]} str    
 * @param  {[type]} options
 * @return {[type]}        
 */
export function parse(str,options) {
    return _.isObject(str) ? str : qs.parse(str,options);
}

/**
 * Axios removes keys if the value is undefined. Change it to NULL
 * 
 * @param  {Object} obj
 * @return {Object}    
 */
export function undefToNull(obj) {
    if ( obj instanceof FormData ) {
        return obj;
    }
    var val = _.mapValues(obj,v=>v===undefined?null:v);

    if ( val && val.all ) {
        val = _.omit(val, ['per_page', 'limit']);
    }

    return val;
}

export function apply(item, mixed) {
    if ( mixed && _.isFunction(mixed) ) {
        return mixed(item);
    } else if ( !mixed || _.isString(item) ) {
        return item;
    } else {
        return _.get(item,mixed);
    }
}

export function isInteger(value) {
    return (_.isNumber(value) && value === parseInt(value,10) ) ? true : false;
}


/**
 * Wrap up something in an array if its not already. Similar to _.toArray but
 * strings and integers should result in a single element array rather than split
 * @param  {mixed} mixed [description]
 * @return {Array}       [description]
 */
export function arrayWrap(mixed) {
    if (_.isNil(mixed)) {
        return [];
    }
    if (_.isArray(mixed)) {
        return mixed;
    }
    if ( mixed && _.isObject(mixed) && !_.isFunction(mixed)) {
        return _.valuesIn(mixed);
    }
    return [mixed];
}

export function traceLog(title, var1, var2) {
    let a = [...arguments]||[];
    console.groupCollapsed(a.pop());    
    a.length && console.log.apply(null,a);
    console.trace(); // hidden in collapsed group
    console.groupEnd();
}