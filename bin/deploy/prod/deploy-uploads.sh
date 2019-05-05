#!/bin/bash

source bin/vars/variables.sh

echo "Deploying uploads to production..."
echo
rsync -azq --partial --delete --omit-dir-times \
  ~/cache/uploads/ \
  $PROD_USER@$PROD_IP:applications/$PROD_DB/public_html/wp-content/uploads/
