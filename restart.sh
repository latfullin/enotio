#!/bin/sh

docker compose pull
docker compose up --build -d --remove-orphans
