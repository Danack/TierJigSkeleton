set -eux -o pipefail

# Read environment from passed parameters

environment="centos_guest,dev"
if [ "$#" -ge 1 ]; then
    environment=$1
fi
echo "environment is ${environment}";

# Figure out if composer install should be run

if [[ "${environment}" == *"centos_guest"* ]]
then
 # We are on a guest environment. Don't do a composer install
 echo "Skipping composer"
else
    github_access_token=`php bin/info.php "github.access_token"`
    [ -z "${github_access_token}" ] && echo "Need to set github_access_token" && exit 1;
    composer config -g github-oauth.github.com ${github_access_token}
    #Run Composer install to get all the dependencies.
    php -d allow_url_fopen=1 /usr/sbin/composer install --no-interaction --prefer-dist
fi

# Make sure some directories exist
mkdir -p ./var/cache/less
mkdir -p autogen

#Generate the config files for nginx and PHP-FPM 
vendor/bin/configurate -p data/config.php data/config_template/nginx.conf.php autogen/nginx.conf $environment
vendor/bin/configurate -p data/config.php data/config_template/php-fpm.conf.php autogen/php-fpm.conf $environment
vendor/bin/configurate -p data/config.php data/config_template/php.ini.php autogen/php.ini $environment

# Generate a script to install the just generated file. The script is run later as a super-user
vendor/bin/configurate -p data/config.php data/config_template/addConfig.sh.php autogen/addConfig.sh $environment

# Generate the application config to be used for the current environment
vendor/bin/genenv -p data/config.php data/envRequired.php autogen/appEnv.php $environment

# Convert the ini file to PHP-FPM format
vendor/bin/fpmconv autogen/php.ini autogen/php.fpm.ini 

