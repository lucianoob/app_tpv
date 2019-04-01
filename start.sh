
#!/bin/bash

echo -e "\n# Start services (Apache/MySQL)"
sudo service apache2 start
sudo service mysql start

echo -e "\n# Start API server (Laravel)"
php artisan serve