#!/usr/bin/env bash

[[ -d vendor ]] && mv vendor vendor.tmp
[[ -f composer.lock ]] && mv composer.lock composer.lock.tmp

curl -sLO https://github.com/humbug/box/releases/download/3.8.4/box.phar

composer install \
    --no-ansi --no-dev --no-interaction \
    --no-progress --no-scripts --optimize-autoloader

cat >> box.json.dist <<'JSON'
{
  "chmod": "0755",
  "main": "bin/glossarize",
  "output": "dist/glossarize.phar",
  "directories": ["src"],
  "finder": [
    {
      "name": "*.php",
      "exclude": ["test", "tests"],
      "in": "vendor"
    }
  ],
  "stub": true
}
JSON

php box.phar build

[[ -d vendor.tmp ]] && mv vendor.tmp vendor
[[ -f composer.lock.tmp ]] && mv composer.lock.tmp composer.lock
[[ -f box.json.dist ]] && rm box.json.dist
[[ -f box.phar ]] && rm box.phar

version=$(cat composer.json | grep version | head -n 1 | sed 's/.*version//' | tr -d $'\n\r\t ,":=\'')

git add .
git commit -am "Release the new ${version}"
git push
