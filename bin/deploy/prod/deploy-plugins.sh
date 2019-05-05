#!/bin/bash

source bin/vars/variables.sh

echo "Deploying plugins to production..."
echo
rsync -azq --partial --delete --omit-dir-times \
  ~/cache/plugins/ \
  $PROD_USER@$PROD_IP:applications/$PROD_DB/public_html/wp-content/plugins/

echo
echo "==========================="
echo

echo "Updating options..."
echo
ssh $PROD_USER@$PROD_IP "cd applications/$PROD_DB/public_html; \
  wp plugin uninstall --deactivate grizzly-deploy; \
  wp option set blog_public 1;"
