sudo apt-get update && 
sudo apt-get install realpath curl apache2 php5 php5-cli mysql-client mysql-server php5-mysql php5-gd && 
printf "\n\nmysql:" &&
mysql -u root -p < createdb.sql && 
mysql -u root -p chat < db.sql && 
cd ~ &&
if [ ! -f composer.phar ]; then 
    curl -sS https://getcomposer.org/installer | php
fi && 
cd - &&
sudo chmod -R 777 .
curdir=`pwd` &&
php ~/composer.phar update && 
while [ `pwd` != '/' ]; do
    sudo chmod 777 . &&
    cd ..
done &&
cd $curdir &&
sudo mkdir -p /var/www/html/cgi/ && 
if [ ! -L /var/www/html/cgi/ajax_chat ]; then
    sudo ln -s `realpath .` /var/www/html/cgi/ajax_chat
fi &&
sudo /etc/init.d/apache2 restart && 
gnome-open http://localhost/cgi/ajax_chat/
