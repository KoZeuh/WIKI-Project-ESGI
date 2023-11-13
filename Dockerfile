# Utilisez une image de base avec Apache et PHP
FROM php:7.4-fpm

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Installer MariaDB
RUN apt-get update && \
    apt-get install -y mariadb-server

RUN apt install apache2 -y
RUN apt install apache2-utils -y

# Configurer MariaDB (vous pouvez personnaliser le mot de passe et d'autres paramètres ici)
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=wiki_bdd
ENV MYSQL_USER=wiki_user
ENV MYSQL_PASSWORD=wiki_bdd

# Exposer le port HTTP et MySQL
EXPOSE 80
EXPOSE 3306

# Copier les fichiers de votre application dans le conteneur
COPY ./ /var/www/html

# Démarrer Apache et MariaDB au lancement du conteneur
CMD ["apachectl", "-D", "FOREGROUND"]
