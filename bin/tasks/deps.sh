#!/bin/bash

source bin/vars/variables.sh

docker exec -it $WP_CONTAINER bash -c "source ~/.bashrc \
  && echo \
  && echo 'Running npm-cache install...' \
  && echo \
  && npm-cache install \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Running composer install...' \
  && echo \
  && cd html/wp-content/plugins/$THEME \
  && COMPOSER_ALLOW_SUPERUSER=1 composer install -o \
  && echo"
