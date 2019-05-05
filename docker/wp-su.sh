#!/bin/bash

# Run wp-cli with proper permissions
/bin/wp-cli.phar --allow-root "$@"
