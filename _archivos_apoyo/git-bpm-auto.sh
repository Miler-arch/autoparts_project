#!/bin/sh
DIRLOG=/home/gamcb/git-bpm-auto.log;
cd /srv/rmx-vys-gamc-22/;
if [ $(git rev-parse HEAD) = $(git ls-remote $(git rev-parse --abbrev-ref @{u} | sed 's/\// /g') | cut -f1) ]; then
        echo `date +%Y-%m-%d_%H:%M:%S` - Actualizado  >> $DIRLOG;
else
        echo `date +%Y-%m-%d_%H:%M:%S` - No esta actualizado >> $DIRLOG;
        echo "cargando.........." >> $DIRLOG;
        /usr/bin/git pull origin main >> $DIRLOG;
        cd /srv/rmx-vys-gamc-22/rmx_start_backend;
        docker-compose down;
        docker system prune --volumes -f;
        docker-compose up --build -d;
        echo `date +%Y-%m-%d_%H:%M:%S` - Ya esta actualizado >> $DIRLOG;
fi
