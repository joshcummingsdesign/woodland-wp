#!/bin/bash

source bin/vars/variables.sh

ssh -t $STG_USER@$STG_IP "cd applications/$STG_DB/public_html; bash"
