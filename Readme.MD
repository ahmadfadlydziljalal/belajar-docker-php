# Sharing dengan teman-teman di team network untuk development app dengan docker on premise

- Perbedaan VM dengan Docker
- Perbedaan instalasi PHP environment diantara keduanya, <i>asumsi kita belum menggunakan database, dan menggunakan web server bawaan php </i>

## Local / VM way

Panduan lengkap memasang PHP Environtment langsung di dalam host Local Machine bisa dilihat di [Digital Ocean](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-22-04)

Namun untuk sharing ini, supaya simple, berikut caranya:

### Langkah 1, Instalasi PHP Environment

```
sudo apt install git
```

```
sudo apt install php php-cli php-mbstring unzip
```

### Langkah 2, Instalasi Composer as Dependency manager

```
cd ~
```

```
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
```

```
HASH=`curl -sS https://composer.github.io/installer.sig`
```

```
echo $HASH
```

```
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

```
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

```
composer
```

<hr/>

Kemudian clone project dari Github sebagai contoh project.
https://github.com/ahmadfadlydziljalal/belajar-docker-php

Setelah berhasil download, running project dengan cara:

1. `cd belajar-docker-php`
2. `composer install`
3. `composer serve`
4. `Running di browser, ketik url: http://localhost:8080`

Seharusnya seperti ini lah kita deploy php project di Server Ubuntu.

<hr/>

## Docker Way

- [Docker](https://docs.docker.com/get-started/#start-the-tutorial)
- [Docker Hub](https://hub.docker.com/_/php/tags)

Instalasi Docker

```
curl -fsSL https://get.docker.com -o get-docker.sh
```

```
sh get-docker.sh
```

```
docker --version
```

Instalasi docker compose

```
sudo curl -L "https://github.com/docker/compose/releases/download/1.25.3/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
```

```
sudo chmod +x /usr/local/bin/docker-compose
```

```
docker-compose -v
```

Running docker tanpa sudo

```
sudo usermod -aG docker ${USER}
```

```
su - ${USER}
```

```
id -nG
```

```
sudo usermod -aG docker ${USER}
```

Sampai sejauh ini docker environment sudah siap digunakan.
Sekarang mari kita konsentrasi ke file DockerFile, dan docker-compose.yml

- Untuk running menggunakan docker, berikut langkahnya

```
docker build -t belajar-docker-php .
```

- Docker akan membuat image dari aplikasi kita, Cek dengan perintah:

```
docker image ls | grep 'belajar-docker-php'
```

- Sekarang, kita akan running, aplikasi tersebut dengan perintah

```
docker run -it -p 8080:8080 --name=container-saya belajar-docker-php
```

- Cek dengan perintah

```
docker ps
```

- Sekarang kita akan running di browser, dengan mengetikkan [localhost:8080](http://localhost:8080)
