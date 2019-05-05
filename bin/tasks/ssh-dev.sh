#!/bin/bash

source bin/vars/variables.sh

ssh -t $DEV_USER@$DEV_IP "cd applications/$DEV_DB/public_html; bash"
