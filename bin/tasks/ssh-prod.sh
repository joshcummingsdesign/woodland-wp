#!/bin/bash

source bin/vars/variables.sh

ssh -t $PROD_USER@$PROD_IP "cd applications/$PROD_DB/public_html; bash"
