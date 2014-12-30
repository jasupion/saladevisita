#!/usr/bin/env bash

install_apache() {
 if [ ! -f /var/log/apache2 ]; then
  echo "Installing apache"
  sudo apt-get update
  sudo apt-get install -y apache2 libapache2-mod-php5 php-apc > /dev/null 2>&1
  if ! [ -L /var/www ]; then
	  rm -rf /var/www/*
  fi
 else
  echo "Apache estava instalado"
 fi
}

configure_apache() {
 # Cuidado pra não apagar tudo através do comando abaixo
 	#rm -rf /var/www 
    #ln -fs /vagrant/www /var/www

    # Add ServerName to httpd.conf
	echo "ServerName localhost" > /etc/apache2/httpd.conf
	# Setup hosts file
	# setup hosts file
	VHOST=$(cat <<-EOF
	<VirtualHost *:80>
	    DocumentRoot "/var/www"
	    <Directory "/var/www">
	        AllowOverride All
	        Require all granted
	    </Directory>
	</VirtualHost>
	EOF
		)
	echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf
	
	
	
    # Disable the default apache sites
    #a2dissite 000-default
 	#a2dissite default-ssl

	 # Enable SSL
	 #make-ssl-cert generate-default-snakeoil --force-overwrite
	 #a2enmod ssl

	 # Enable rewrite
	a2enmod rewrite

	sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default

 	service apache2 restart 
}

install_php() {
	if [ ! -f /var/log/php ]; then
		echo "Updating PHP repository"
		apt-get install python-software-properties build-essential -y 
		add-apt-repository ppa:ondrej/php5 -y
		apt-get update

		echo "Installing PHP"
		apt-get install php5-common php5-dev php5-cli php5-fpm -y

		echo "Installing PHP extensions"
		apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql -y

		echo "Installing PHP extensions for moodle"
		apt-get install graphviz aspell php5-pspell php5-intl php5-xmlrpc php5-ldap

		touch /var/log/php # registra arquivo para informar que já foi instalado
	else
		echo "PHP estava instalado"
	fi
}

config_php(){
	#Php Configuration
	sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 50M/" /etc/php5/apache2/php.ini
	sed -i "s/post_max_size = 8M/post_max_size = 50M/" /etc/php5/apache2/php.ini
	#sed -i "s/;date.timezone =/date.timezone = Europe\/London/" /etc/php5/apache2/php.ini
	#sed -i "s/memory_limit = 128M/memory_limit = 1024M/" /etc/php5/apache2/php.ini
	#sed -i "s/_errors = Off/_errors = On/" /etc/php5/apache2/php.ini,
	
	service apache2 restart 

	echo "PHP configurado"
}

install_git() {
	if [ ! -f /var/log/git ]; then
		echo "Installing Git"
		apt-get install git -y 

		# Permite baixar arquivos com tamanho maiores que o padrão
		git config --global http.postBuffer 524288000
	else
		echo "Git já estava instalado"
	fi
}


install_mysql() {
	if [ ! -f /var/log/mysql ]; then
		echo "Installing MySQL"
		echo "Preparing MySQL"

		apt-get install debconf-utils -y

		debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
		debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"

		echo "Installing MySQL"

		apt-get install mysql-server -y
	else
		echo "MySQL já estava instalado"
	fi
}

mysql_remote_external() {
	# echo "privilegios liberados para o MySQL"
	DBPASSWD=root
	DBNAME=moodle

	mysql -uroot -p$DBPASSWD -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION;"
	mysql -uroot -p$DBPASSWD -e "FLUSH PRIVILEGES;"

	echo "[mysqld]" > /etc/mysql/conf.d/network-access.cnf
	echo "bind-address = 0.0.0.0" >> /etc/mysql/conf.d/network-access.cnf
	sudo service mysql restart

	# echo "CREATE DATABASE moodle" | mysql -uroot -proot

	echo -e "\n--- Setting up our MySQL user and db ---\n"
	mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
	mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to 'root'@'localhost' identified by '$DBPASSWD'"

	sudo service mysql restart
 
}

install_nodejs_express_nodemon() {
	if [ ! -f /var/log/nodejs ]; then
		echo "Installing Node.js"

		# Add Node.js repo.
		sudo apt-get install python-software-properties -y
		sudo apt-add-repository ppa:chris-lea/node.js -y
		sudo apt-get update

		sudo apt-get install nodejs -y
		sudo apt-get install npm -y

		sudo npm install -g express -y
		sudo npm install -g express-generator -y
		sudo npm install -g nodemon -y

		touch /var/log/nodejs # registra arquivo para informar que já foi instalado
	else
		echo "Nodejs estava instalado"
	fi
}

install_gulp() {
	# tenta instalar o nodejs antes, como pre requisito
	install_nodejs_express_nodemon

	if [ ! -f /var/log/gulp ]; 
	then
		echo "Installing Grunt CLI"
		sudo npm install -g gulp 
		
	else
		echo "Grunt estava instalado"
		# sudo npm update -g gulp -y
	fi
}


#install_php
config_php
#install_apache
#configure_apache
#install_mysql
#mysql_remote_external
#install_git
#install_nodejs_express_nodemon
#install_gulp
