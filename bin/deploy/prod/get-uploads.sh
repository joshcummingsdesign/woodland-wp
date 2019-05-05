#!/bin/bash

source bin/vars/variables.sh

echo "Getting uploads from staging..."
echo
rsync -azq --partial --delete \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/uploads/ \
  ~/cache/uploads/
