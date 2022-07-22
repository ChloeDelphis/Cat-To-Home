/** @type {import('vls').VeturConfig} */

module.exports = {
   projects: [
  './packages/repo2', // Shorthand for specifying only the project root location
  {
    // **required**
    // Where is your project?
    // It is relative to `vetur.config.js`.
    root: './frontend',
  }
]
}
