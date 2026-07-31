const path = require('path');
const os = require('os');

// Soketi / uWebSockets.js only supports Node 14, 16, 18 — not 20+.
const node18 = path.join(
  os.homedir(),
  '.nvm/versions/node/v18.20.8/bin/node'
);

module.exports = {
  apps: [
    {
      name: 'sport-soketi',
      script: 'node_modules/@soketi/soketi/bin/server.js',
      args: 'start --config=./soketi.json',
      cwd: __dirname,
      interpreter: node18,
      instances: 1,
      exec_mode: 'fork',
      autorestart: true,
      watch: false,
      max_memory_restart: '256M',
      env: {
        NODE_ENV: 'production',
      },
    },
  ],
};
