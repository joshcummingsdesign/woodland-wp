#!/bin/bash

source bin/vars/variables.sh

docker exec -it $WP_CONTAINER bash -c "source ~/.bashrc \
  && echo \
  && echo 'Building the project with the --production flag...' \
  && echo \
  && gulp --production"
