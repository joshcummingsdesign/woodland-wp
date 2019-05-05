#!/bin/bash

source bin/vars/variables.sh

echo "Deploying theme..."
echo
rsync -azq --partial --delete www/html/wp-content/themes/$THEME/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/themes/$THEME/

echo
echo "==========================="
echo

echo "Deploying plugins..."
echo
rsync -azq --partial --delete www/html/wp-content/plugins/$THEME/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/plugins/$THEME/

echo
echo "==========================="
echo

echo "Deploying Pattern Lab..."
echo
rsync -azq --partial --delete www/html/patternlab/ \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/patternlab/
