#!/usr/bin/env bash
docker-compose --project-name stellar-crm --file docker-compose-production.yml up --build --detach --remove-orphans
