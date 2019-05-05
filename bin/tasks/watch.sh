#!/bin/bash

source bin/vars/variables.sh

docker exec -it $WP_CONTAINER bash -c "source ~/.bashrc \
  && echo \
  && echo 'Starting the project watcher...' \
  && echo \
  && gulp watch"
