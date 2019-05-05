## Dependencies

- Xcode Command Line Tools `xcode-select --install`
- Docker
- Node > 10.X.X < 10.15.3

---

## Start the project
```
chmod -R +x bin

chmod +x www/html/wp-content/plugins/woodland/tests/bin/install-wp-tests.sh

make coffee
```

Then take this time to prepare a coffee...

Then go to `https://localhost/wp-admin/`

```
user: admin
pasword: admin
```
Then active plugins: "Advanced Custom Fields PRO" and "woodland"

---

## Develop
```
make bw
```

https://localhost:3000/

https://localhost:3000/paternlab

---

## Important notes

Browser-sync version: v2.26.5

---

## Recomendatios for VSC
settings.json
```json
"files.exclude": {
  "**/.DS_Store": true,
  "www/node_modules": true,

  "www/patternlab-core": true,
  "www/html/patternlab/styleguide": true,
  "www/html/patternlab/favicon.ico": true,
  "www/html/patternlab/index.html": true,
  "www/html/patternlab/latest-change.txt": true,
  "www/html/patternlab/annotations": true,
  "www/html/patternlab/patternlab-components": true,

  "www/html/wp-admin": true,
  "www/html/wp-includes": true,
  "www/html/wp-content/plugins/advanced-custom-fields-pro": true,
  "www/html/wp-content/plugins/index.php": true,
  "www/html/wp-content/uploads": true,
  "www/html/wp-content/index.php": true,
  "www/html/wp-content/themes": true,
  "www/html/*.php": true,
  "www/html/*.html": true,
  "www/html/*.txt": true,
}
```
