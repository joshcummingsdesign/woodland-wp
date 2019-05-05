#!/bin/bash

source bin/vars/variables.sh

docker exec -it $WP_CONTAINER bash -c "\
  echo \
  && cd html \
  && echo 'Downloading WordPress...' \
  && echo \
  && wp core download --force --skip-content \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Configuring WordPress...' \
  && echo \
  && wp core config --force \
    --dbname=wp \
    --dbuser=root \
    --dbhost=mysql \
    --skip-check \
    --extra-php='define(\"WP_DEBUG\", true);' \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Creating database...' \
  && echo \
  && wp db create || true \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Installing WordPress...' \
  && echo \
  && wp core install \
    --url=https://localhost \
    --title=Sitename \
    --admin_user=admin \
    --admin_password=admin \
    --admin_email=hello@domain.com \
    --skip-email \
  && echo \
  && echo '===========================' \
  && echo \
  && echo 'Setting up WordPress test environment...' \
  && echo \
  && if [ ! -e /tmp/wordpress-tests-lib/wp-tests-config.php ]; then ./wp-content/plugins/$PLUGIN/tests/bin/install-wp-tests.sh wordpress_test root '' mysql latest; else echo 'WordPress test environment already configured.'; fi \
  && echo"
