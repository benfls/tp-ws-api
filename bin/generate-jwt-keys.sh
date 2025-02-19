#!/bin/bash

CURDIR=`dirname $0`
mkdir -p ${CURDIR}/../config/jwt
openssl genrsa -out ${CURDIR}/../config/jwt/private.pem -passout pass:$1 -aes256 4096
openssl rsa -pubout -in ${CURDIR}/../config/jwt/private.pem -out ${CURDIR}/../config/jwt/public.pem -passin pass:$2
chown -R www-data:www-data ${CURDIR}/../config/jwt