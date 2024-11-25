# Use a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Atualiza os pacotes e instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring gd zip

# Copia os arquivos do projeto para o diretório padrão do Apache
COPY ./ /var/www/html/

# Define as permissões corretas para o diretório web
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Habilita o módulo de reescrita do Apache
RUN a2enmod rewrite

# Exponha a porta 80 para acessar o servidor
EXPOSE 80

# Comando para iniciar o Apache no container
CMD ["apache2-foreground"]
