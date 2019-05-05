#!/bin/bash

source bin/vars/variables.sh

echo "Deploying theme..."
echo
rsync -azq --partial --delete www/html/wp-content/themes/$THEME/ \
  $DEV_USER@$DEV_IP:applications/$DEV_DB/public_html/wp-content/themes/$THEME/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -azq --partial --delete www/html/wp-content/plugins/$PLUGIN/ \
  $DEV_USER@$DEV_IP:applications/$DEV_DB/public_html/wp-content/plugins/$PLUGIN/

echo
echo "==========================="
echo

echo "Deploying Pattern Lab..."
echo
rsync -azq --partial --delete www/html/patternlab/ \
  $DEV_USER@$DEV_IP:applications/$DEV_DB/public_html/patternlab/

echo
echo "==========================="
echo

# echo "Updating options..."
# echo "uninstall sensitive plugins"

