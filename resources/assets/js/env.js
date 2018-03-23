// =============================================================================
// Environment Settings
// =============================================================================
// Within Rollup we do a `replace()` on `ENV_LOCAL` to take a local `.env.js`
// file and merge it into the default `env` file. This means the live has
// consistant options with environment specifics if a file exisist.

let _ = require('lodash');

// Live settings
// =============================================================================

let env = {
    achiiverUrl: 'https://secure.achiive.com',
    apiUrl: '/api',
    authUrl: '/oauth',
    defaultState: 'dashboard'
};


// Local settings (based on .env.js)
// =============================================================================

if (window.location.hostname !== 'dashboard.achiive.com') {
    env = _.merge(env, false);
}


// Export
// =============================================================================

export default env;
