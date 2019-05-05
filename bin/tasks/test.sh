#!/bin/bash

# Variables
source bin/vars/variables.sh

docker exec -it $WP_CONTAINER bash -c "source ~/.bashrc \
  && echo \
  && echo 'Checking for vulnerabilities...' \
  && echo \
  && retire -n -p \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Validating JavaScript...' \
  && echo \
  && gulp scripts-lint \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Running JavaScript unit tests...' \
  && npm test \
  && echo '===========================' \
  && echo \
  && echo 'Running PHP unit tests...' \
  && echo \
  && phpunit \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Testing PHP coding standards...' \
  && echo \
  && phpcs --standard=phpcs.xml \
  && echo"
