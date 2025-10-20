## Technologies used

- Docker
- WordPress
- MySQL
- Vite
- SASS
- ACF

## Project setup instructions

1. Clone the repository

```bash
git clone <repository-url>
cd Prueba-Tecnica-Filmpedia
```

2. Run the docker containers

```bash
docker-compose up -d
```

3. Install dependencies

```bash
npm install
```

4. Build assets

```bash
npm run build
```

5. Access WordPress at http://localhost:8080

6. Complete WordPress installation

   - Language: Select your language
   - Site Title: Filmpedia
   - Username: admin (or your choice)
   - Password: (set a strong password)
   - Email: your@email.com
   - Database Configuration:
     - Database Name: wordpress
     - Username: root
     - Password: test
     - Database Host: db
     - Table Prefix: wp\_

7. Activate Movie Theme

   - Go to Appearance → Themes
   - Activate "Movie Theme"

8. Activate ACF plugin

   - Go to Plugins
   - Activate "Advanced Custom Fields"

9. Import database (includes sample movies, ACF fields, and data)

```bash
docker-compose exec -T db mysql -u root -ptest filmpedia_database < backup.sql
```

10. Upload movie images

   - Go to Media → Add New
   - Drag and drop all movie images from your source
   - Edit each Película post and assign the corresponding image to the "imatge_de_fons" field

11. Go to WordPress Admin → Settings → Permalinks and click "Save Changes" without changing anything

12. View the movie archive page at http://localhost:8080/peliculas/

## ACF Configuration

Create a field group named "Movie Fields" assigned to post type "Peliculas":

**Fields:**

- `imatge_de_fons` (Image) - Background Image
- `edad` (Text) - Age Rating (e.g., "15+ anys")
- `descripcion` (Textarea) - Description
- `ludic` (Number) - Ludic rating (0-100)
- `cultural` (Number) - Cultural rating (0-100)
- `educatiu` (Number) - Educational rating (0-100)
- `artistic` (Number) - Artistic rating (0-100)
- `ambits` (Checkbox) - Ambits with choices:
  - sociologia : Sociologia
  - igualtat_genere : Igualtat de gènere
  - lgbtqi : LGBTQI+
  - desigualtat : Desigualtat
  - discriminacio_violencia : Discriminació i violència
  - mon_digital : Món digital
  - cultures_mon : Cultures del món
  - diversitat : Diversitat
  - identitat : Identitat

## Development

**Watch mode (auto-rebuild on changes):**

```bash
npm run dev
```

**Production build:**

```bash
npm run build
```

## Learnings and challenges

### WordPress Theme Development

- WordPress uses a template hierarchy system where specific file names (like `archive-{post-type}.php`) automatically control which template renders
- Custom post types and taxonomies must be registered in `functions.php` and flushed permalinks to work properly
- The WordPress Loop (`WP_Query`) is essential for querying and displaying custom content beyond standard posts

### ACF Integration

- ACF field groups are stored in the database and included in the database export for easy portability
- ACF fields are retrieved with `get_field()` which returns different data types based on field configuration (arrays, strings, URLs, etc.)
- Checkbox fields in ACF return arrays of selected values, requiring iteration in templates

### SCSS Architecture & Responsive Design

- Organizing styles into partials (`_variables.scss`, `_cards.scss`) improves maintainability and follows separation of concerns
- Media queries should be added at the end of stylesheets to avoid overriding desktop styles unintentionally
- SCSS interpolation `#{}` is required when using variable arithmetic in media queries: `@media (max-width: #{$tablet - 1})`

### Build Tools & Asset Pipeline

- Vite's build process generates hashed filenames for cache busting, requiring dynamic asset enqueuing in WordPress
- Using `glob()` in PHP to find versioned assets (like `main-*.css`) ensures the latest build is always loaded
- Separating development (`npm run dev`) and production (`npm run build`) builds optimizes for different use cases
