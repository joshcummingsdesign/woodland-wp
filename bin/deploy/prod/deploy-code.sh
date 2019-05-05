#!/bin/bash

source bin/vars/variables.sh

echo "Deploying theme..."
echo
rsync -azq --partial --delete www/html/wp-content/themes/$THEME/ \
  $PROD_USER@$PROD_IP:applications/$PROD_DB/public_html/wp-content/themes/$THEME/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -azq --partial --delete www/html/wp-content/plugins/$PLUGIN/ \
  $PROD_USER@$PROD_IP:applications/$PROD_DB/public_html/wp-content/plugins/$PLUGIN/
