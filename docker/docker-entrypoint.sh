#!/bin/bash
set -eu

# Start SSH
service ssh start

exec "$@"
