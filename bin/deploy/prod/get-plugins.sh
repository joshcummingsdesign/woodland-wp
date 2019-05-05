#!/bin/bash

source bin/vars/variables.sh

echo "Getting plugins from staging..."
echo
rsync -azq --partial --delete \
  $STG_USER@$STG_IP:applications/$STG_DB/public_html/wp-content/plugins/ \
  ~/cache/plugins/
