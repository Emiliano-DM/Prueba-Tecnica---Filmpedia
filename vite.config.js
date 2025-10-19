import path from 'path'
import { defineConfig } from 'vite'

export default defineConfig({
    build: {
      outDir: 'wp-content/themes/movie_theme/dist',
      rollupOptions: {
        input: path.resolve(__dirname, 'src/main.js')
      }
    }
})