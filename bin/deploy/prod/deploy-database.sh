#!/bin/bash

source bin/vars/variables.sh

echo "Exporting database from staging..."
echo
ssh $STG_USER@$STG_IP "cd applications/$STG_DB/public_html; \
  wp db export prod.sql"

rsync -azq --partial $STG_USER@$STG_IP:applications/$STG_DB/public_html/prod.sql ./

ssh $STG_USER@$STG_IP "rm applications/$STG_DB/public_html/prod.sql"

rsync -azq --partial prod.sql \
  $PROD_USER@$PROD_IP:applications/$PROD_DB/public_html/prod.sql && \
  rm prod.sql

echo
echo "==========================="
echo

echo "Importing database to production..."
echo
ssh $PROD_USER@$PROD_IP "cd applications/$PROD_DB/public_html; \
  wp db reset --yes; \
  wp db import prod.sql; \
  wp search-replace $STG_DOMAIN $PROD_DOMAIN --all-tables; \
  rm prod.sql"
