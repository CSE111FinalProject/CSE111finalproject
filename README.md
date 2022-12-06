# CSE111finalproject

Installation
Download PHP
Link: https://www.php.net/downloads.php

Download 8.1 version

In file, rename php.ini-development to php.ini

Uncomment the following in the php.ini by deleting ";":
extension=bz2

extension=curl

;extension=ffi

;extension=ftp

extension=fileinfo

extension=gd

extension=gettext

extension=gmp

extension=intl

extension=imap

extension=ldap

extension=mbstring

extension=exif      ; Must be after mbstring as it depends on it

extension=mysqli

;extension=oci8_12c  ; Use with Oracle Database 12c Instant Client

;extension=oci8_19  ; Use with Oracle Database 19 Instant Client

extension=odbc

extension=openssl

;extension=pdo_firebird

extension=pdo_mysql

;extension=pdo_oci

;extension=pdo_odbc

extension=pdo_pgsql

extension=pdo_sqlite

;extension=pgsql

;extension=shmop

extension=soap

extension=sockets

;extension=sodium

extension=sqlite3

;extension=tidy

extension=xsl

date.timezone ="UTC"

To run a development test server, run the following command: php -S localhost:80 -t .

In the web browser, enter localhost/index.php
