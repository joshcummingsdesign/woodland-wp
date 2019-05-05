#!/bin/bash

# Pretty Print
source bin/vars/pretty-print.sh

# Variables
source bin/vars/variables.sh

# Get variables
pretty_read "${COL_BLUE}Branch Name: ${COL_RESET}" DEV_BRANCH
pretty_read "${COL_BLUE}IP Address: ${COL_RESET}" DEV_IP
pretty_read "${COL_BLUE}Domain: ${COL_RESET}" DEV_DOMAIN
pretty_read "${COL_BLUE}User: ${COL_RESET}" DEV_USER
pretty_read "${COL_BLUE}Database Name: ${COL_RESET}" DEV_DB

# Checkout branch
git checkout -b $DEV_BRANCH

# Check for dev branch
BRANCH=$(git branch | sed -n -e 's/^\* \(.*\)/\1/p')

if [[ $BRANCH == $DEV_BRANCH ]]; then

  # Add to variables.sh
  echo "DEV_IP=${DEV_IP}" >> bin/vars/variables.sh
  echo "DEV_DOMAIN=${DEV_DOMAIN}" >> bin/vars/variables.sh
  echo "DEV_USER=${DEV_USER}" >> bin/vars/variables.sh
  echo "DEV_DB=${DEV_DB}" >> bin/vars/variables.sh

  # Add to circle.yml
  sed -i -e $'s/  hosts:/  hosts:\\\n    dev-domain: dev-ip/g' circle.yml
  sed -i -e "s/dev-domain/$DEV_DOMAIN/g" circle.yml
  sed -i -e "s/dev-ip/$DEV_IP/g" circle.yml
  echo "  dev:" >> circle.yml
  echo "    branch: ${DEV_BRANCH}" >> circle.yml
  echo "    commands:" >> circle.yml
  echo "      - ./bin/deploy/dev/deploy-code.sh" >> circle.yml

fi
