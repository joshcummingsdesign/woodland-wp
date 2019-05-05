#!/bin/bash

cd www

echo "Checking for vulnerabilities..."
echo
retire -n -p
echo
echo "==========================="
echo
echo "Testing PHP coding standards..."
echo
phpcs --standard=phpcs.xml
