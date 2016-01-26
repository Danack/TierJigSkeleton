
# Tier Jig skeleton application

This is a very simple skeleton application to show how both [Tier](https://github.com/Danack/Tier) and [Jig](https://github.com/Danack/Jig) work in a simple application.

## How to run

You can run this either with the PHP built in web-server, or through nginx.

### PHP built-in server

```

git clone https://github.com/Danack/TierJigSkeleton
cd TierJigSkeleton/
composer install
php -S localhost:8000 -t public

```

### Nginx

The deployment scripts will generated the config files appropriate for Nginx + PHP-FPM.

```
git clone https://github.com/Danack/TierJigSkeleton
cd TierJigSkeleton/
composer install
sh scripts/deploy.sh
nginx -s reload
/etc/init.d/php-fpm restart
```

Or

```
sh scripts/deploy.sh custom_environment,separated,with_commas
```

YMMV if you are not using Centos.


## Documentation

The documentation for Jig is online at [phpjig.com](http://phpjig.com)

The documentation for Tier is being worked on.