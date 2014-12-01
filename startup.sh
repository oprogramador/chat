sudo apt-get update && 
sudo apt-get install realpath curl apache2 php5 php5-cli mysql-client mysql-server php5-mysql php5-gd && 
mysql -u root -p < createdb.sql && 
mysql -u root -p chat < db.sql && 
cd ~ &&
if [ ! -f composer.phar ]; then 
    curl -sS https://getcomposer.org/installer | php
fi && 
cd - &&
php ~/composer.phar update && 
sudo chmod -R 777 . &&
sudo mkdir -p /var/www/html/cgi/ && 
if [ ! -L /var/www/html/cgi/ajax_chat ]; then
    echo 'if'
    sudo ln -s `realpath .` /var/www/html/cgi/ajax_chat
fi &&
sudo /etc/init.d/apache2 restart && 
gnome-open http://localhost/cgi/ajax_chat/
