#!/bin/sh

echo 'Attempting to connect to elastic'
until $(docker-compose -f docker-compose.yml exec php curl -s http://elastic:9200 >> /dev/null); do
    printf '.'
    sleep 5
done
echo 'Connection to elastic is established'
