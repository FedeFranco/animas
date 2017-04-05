#!/bin/sh

sudo -u postgres dropuser animas
sudo -u postgres dropdb animas
sudo -u postgres psql -c "create user animas password 'animas' superuser;"
sudo -u postgres createdb -O animas animas

