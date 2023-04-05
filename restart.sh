#!/bin/sh

USER="$(id -un)"
DOCKER_USER="$(id -un "$USER")"
DOCKER_UID="$(id -u "$USER")"
DOCKER_GROUP="$(id -gn "$USER")"
DOCKER_GID="$(id -g "$USER")"
export DOCKER_USER
export DOCKER_UID
export DOCKER_GROUP
export DOCKER_GID

docker compose pull
docker compose up --build -d --remove-orphans
