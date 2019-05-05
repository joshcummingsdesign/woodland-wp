#!/bin/bash

echo "Removing unused images..."
docker image prune -f
echo "Removing unused networks..."
docker network prune -f
echo "Removing unused volumes..."
docker volume prune -f
