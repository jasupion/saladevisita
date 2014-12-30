#!/usr/bin/env bash

# Moodle settings
MOODLE_ROOT=/var/www
MOODLE_PATH=${MOODLE_ROOT}/moodle
MOODLE_DATA_DIR=/var/moodledata
MOODLE_WEBROOT="http://localhost:8080/moodle"
MOODLE_PASSWORD="C1m@t3c!"

# DB settings
SQLUSER="root"
SQLPASSWORD="root"

# PHP settings
MEMORY_LIMIT="256M"
UPLOAD_MAX_FILESIZE="128M"
POST_MAX_SIZE="128M"

install_tools_linux() {
	apt-get -y install unzip
}

install_apache() {
 if [ ! -f /var/log/apache2 ]; then
  echo "Installing apache"
  sudo apt-get update
  sudo apt-get install -y apache2 libapache2-mod-php5 php-apc > /dev/null 2>&1
  if ! [ -L /var/www/html ]; then
  	  rm -rf /var/www/html/*
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

configure_php() {
	# Changing PHP settings
	echo "[vagrant provisioning] Configuring PHP5..."
	# Change settings for apache2 PHP
	sudo sed -i "s@memory_limit.*=.*@memory_limit=$MEMORY_LIMIT@g" /etc/php5/apache2/php.ini
	sudo sed -i "s@upload_max_filesize.*=.*@upload_max_filesize=$UPLOAD_MAX_FILESIZE@g" /etc/php5/apache2/php.ini
	sudo sed -i "s@post_max_size.*=.*@post_max_size=$POST_MAX_SIZE@g" /etc/php5/apache2/php.ini
	# Change settings for command line interface PHP (used by Drush)
	sudo sed -i "s@memory_limit.*=.*@memory_limit=$MEMORY_LIMIT@g" /etc/php5/cli/php.ini
	sudo sed -i "s@upload_max_filesize.*=.*@upload_max_filesize=$UPLOAD_MAX_FILESIZE@g" /etc/php5/cli/php.ini
	sudo sed -i "s@post_max_size.*=.*@post_max_size=$POST_MAX_SIZE@g" /etc/php5/cli/php.ini
	sudo service apache2 restart # restart apache so latest php config is picked up
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

		# Installing MySQL is even trickier, because the installation process will prompt you for the root password, but Vagrant needs to automate the installation and somehow fill in the password automatically.
		# For this we need to install a tool called debconf-utils. Go ahead and type in the following lines in setup.sh:
		apt-get install debconf-utils -y

		# Now, we can use this tool to tell the MySQL installation process to stop prompting for a password and use the password from the command line instead:
		debconf-set-selections <<< "mysql-server mysql-server/root_password password $SQLPASSWORD"
		debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $SQLPASSWORD"

		echo "Installing MySQL"

		# Now we can go ahead and install MySQL without getting the root password prompts:
		apt-get install mysql-server -y
	else
		echo "MySQL já estava instalado"
	fi
}

mysql_remote_external() {
	# echo "privilegios liberados para o MySQL"

	mysql -u$SQLUSER -p$SQLUSER -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION;"
	mysql -u$SQLUSER -p$SQLUSER -e "FLUSH PRIVILEGES;"

	echo "[mysqld]" > /etc/mysql/conf.d/network-access.cnf
	echo "bind-address = 0.0.0.0" >> /etc/mysql/conf.d/network-access.cnf
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

install_moodle() {
	#download moodle
	if [ ! -f /vagrant/moodle.tgz ]; then
		echo "Baixando o MOODLE"
   		wget -O /vagrant/moodle.tgz http://softlayer-dal.dl.sourceforge.net/project/moodle/Moodle/stable25/moodle-2.5.9.tgz
  	fi

  	#Cria banco moodle
  	echo "CREATE DATABASE moodle" | mysql -u$SQLUSER -p$SQLPASSWORD

   	echo "Extraindo o MOODLE"
   	tar -zxvf /vagrant/moodle.tgz -C $MOODLE_ROOT

   	#Configura o moodle
   	chown -R root $MOODLE_PATH
   	chmod -R 0755 $MOODLE_PATH
   	find $MOODLE_PATH -type f -exec chmod 0644 {} \;

   	mkdir $MOODLE_DATA_DIR
   	chmod 777 $MOODLE_DATA_DIR

 	sudo mkdir "${MOODLE_DATA_DIR}"
	sudo mkdir "${MOODLE_DATA_DIR}/lang"
	sudo mkdir "${MOODLE_DATA_DIR}/geoip"

	echo "Baixando o GeoLiteCity.dat.gz"
	wget -O /tmp/geoip.dat.gz "http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz"
	echo "Instalando o GeoLiteCity.dat.gz"
	sudo -u www-data gzip -cd /tmp/geoip.dat.gz > "${MOODLE_DATA_DIR}/geoip/GeoLiteCity.dat"

	echo "Baixando o pt_BR"
	wget -O "/tmp/pt_br.zip" "https://download.moodle.org/download.php/direct/langpack/2.5/pt_br.zip"
	echo "Instalando o pt_BR"
	sudo -u www-data unzip "/tmp/pt_br.zip" -d "${MOODLE_DATA_DIR}/lang"
	sudo chown -R www-data:www-data "${MOODLE_DATA_DIR}"
	sudo chmod -R 777 "${MOODLE_DATA_DIR}"

	echo "Instalando MOODLE"
	sudo -u www-data /usr/bin/php /var/www/moodle/admin/cli/install.php \
		--non-interactive \
		--lang="pt_br" \
		--wwwroot="${MOODLE_WEBROOT}" \
		--dataroot="${MOODLE_DATA_DIR}" \
		--dbtype="mysqli" \
		--dbuser="${SQLUSER}" \
		--dbpass="${SQLPASSWORD}" \
		--adminuser="admin" \
		--adminpass="C1m@t3c!" \
		--fullname="TestSite" \
		--shortname="test" \
		--agree-license
	chmod 644 /var/www/moodle/config.php
	sudo mkdir -p ${MOODLE_DATA_DIR}/geoip

 	echo "Removendo o tmp"
	sudo rm /tmp/pt_br.zip /tmp/geoip.dat.gz /tmp/moodle.tgz /vagrant/moodle.tgz
}

install_tools_linux
install_nodejs_express_nodemon
install_php
configure_php
install_apache
configure_apache
install_mysql
mysql_remote_external
install_git
install_gulp
install_moodle