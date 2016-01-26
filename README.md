
# Tier Jig skeleton application

This is a very simple skeleton application to show how both [Tier](https://github.com/Danack/Tier) and [Jig](https://github.com/Danack/Jig) work in an actual application.

## How to run

You can run this either with the PHP built in web-server, or through nginx.

### PHP built-in server

```
php -S localhost:8000 -t public
```


### Nginx

The deployment scripts will generated the config files appropriate for Nginx + PHP-FPM.

```
sh scripts/deploy.sh
```

Or

```
sh scripts/deploy.sh custom_environment,separated,with_commas
```


YMMV if you are not using Centos.
