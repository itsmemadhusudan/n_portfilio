import { spawn } from 'node:child_process';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const vite = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '../node_modules/vite/bin/vite.js');
const child = spawn(process.execPath, [vite, 'build'], { stdio: 'inherit' });

child.on('exit', (code) => process.exit(code ?? 1));
