; These parameters can be imported into other config files
; by enclosing the key with % (like %database_user%)
; Comments start with ';', as in php.ini
[parameters]
    database_driver   = pdo_mysql
    database_host     = localhost
    database_port     =
    database_name     = admin_mio
    database_user     = root
    database_password = issues

    mailer_transport  = smtp
    mailer_host       = localhost
    mailer_user       =
    mailer_password   =

    locale            = en

    secret            = ThisTokenIsNotSoSecretChangeIt
