#!/bin/bash

if [ ! -e /opt/circleci/nodejs/v6.1.0/bin/npm-cache ]; then
  echo "Installing global node dependencies..."
  echo
  npm install --silent -g npm-cache gulp retire
  echo
  echo "==========================="
  echo
fi

echo "Setting up WordPress test environment..."
echo
./www/html/wp-content/plugins/$PLUGIN/tests/bin/install-wp-tests.sh wordpress_test ubuntu '' 127.0.0.1
echo
echo "==========================="
echo
echo "Configuring Pattern Lab Twig..."
echo
echo "phpBin: /opt/circleci/.phpenv/shims/php" >> ./www/patternlab-core/config/config.yml
echo "==========================="
echo
echo "Running npm-cache install..."
echo
cd www
npm-cache install --cacheDirectory ~/node-cache
echo
echo "==========================="
echo
echo "Running composer install..."
echo
cd html/wp-content/plugins/$PLUGIN
composer install -o
