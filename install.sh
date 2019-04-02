
#!/bin/bash

echo -e "\n### Install App TPV Project ###"

echo -e "\n# Start services (Apache/MySQL)"
sudo service apache2 start
sudo service mysql start

echo -e "\n# Create database..."
echo -e "\n Enter user in mysql: "
read umysql
echo -e "\n Enter password in mysql:"
read pmysql
mysql -u $umysql -p$pmysql <<-EOF
	DROP DATABASE IF EXISTS app_tpv;
    CREATE DATABASE app_tpv;
EOF

echo -e "\n# Create file .env..."
cp .env.install .env

echo -e "\n# Write file .env..."
sed -i 's/##DBU##/'$umysql'/g' .env
sed -i 's/##DBP##/'$pmysql'/g' .env

echo -e "\n# Generate key..."
php artisan key:generate

echo -e "\n# Clear config..."
php artisan config:cache

echo -e "\n# Clear database..."
php artisan migrate:refresh

echo -e "\n# Make migrations..."
php artisan migrate

echo -e  "\n# Make seeds..."
php artisan db:seed

echo -e "\n# Execute feature and unit tests..."
phpunit --debug

echo -e "\n### Install Complete !!!\n"
