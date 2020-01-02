#!/bin/sh
set -e

XDEBUG_INI=/usr/local/etc/php/conf.d/xdebug.ini
if [[ "${MYTHERESA_XDEBUG_ENABLE}" != "1" ]]; then
    echo "Disabling XDebug Configuration"
    rm -f ${XDEBUG_INI}
fi

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

exec docker-php-entrypoint "$@"
