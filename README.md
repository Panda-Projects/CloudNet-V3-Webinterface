[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

<img width="100px" style="border-radius: 10px;" src="https://cdn.panda-studios.eu/logo-transparent.png" alt="Panda-Studios Logo">

# CloudNet V3 Webinterface

## Vorraussetzungen:

- CloudNet 3.x und das modifizierte Rest-Modul
- Webserver oder Webspace
  - PHP 8
  - PHP Curl

## Download

Das Module kannst du hier Herrunterladen ``https://files.panda-studios.eu/1/0.2/cloudnet-rest.jar``

## Installation

1. Lösche ```cloudnet-rest.jar in CloudNet``` aus dem Ordner Modul
2. Downloade die modifizierte ``cloudnet-rest.jar``
3. Starte CloudNet neu
4. Installieren Sie Apache2
5. Clonen Sie jetzt das Webinterface mit ``git clone https://github.com/Panda-Projects/CloudNet-V3-Webinterface.git``

Info: Das Webinterface funktioniert auch auf einen externen Server/Webspace!    

### Installation und Webserver Konfiguration

#### Apache2

1. Um Apche2 zu installieren benutzen Sie den folgenden Kommand:
```apt install apache2```
2. Danache benutzen Sie den Kommand um eine Apache2 config zu erstellen
```nano /etc/apache2/sites-available/webinterface.conf```
3. Danache kopieren Sie den folgenden Text
```
        <VirtualHost *:80>
            ServerName webinterface.example.com
            DocumentRoot "/var/www/webinterface/public"
            <Directory /var/www/webinterface/public>
                    AllowOverride All
            </Directory>
        </VirtualHost>
```
4. Verlassen Sie die Anwendung mit ``STRG+X`` und dann mit ``y`` und ``RETURN`` speichern
5. Atkivieren Sie die Seite nun mit den folgendem Befehl
```a2ensite webinterface.conf```
6. Starten Sie Apache2 neu
```service apache2 restart```



### Installation von Composer
#### Debian 11
1. Download von ``composer-setup.php`` 

        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

2. Installieren von Composer Global

        php composer-setup.php --install-dir=/usr/local/bin --filename=composer
        chmod +x /usr/local/bin/composer

## Support

- via Discord: https://discord.gg/rHD3CFB8x4
- via E-Mail: [info@panda-studios.eu](mailto:info@panda-studios.eu)

<a href="https://github.com/Panda-Projects/CloudNet-V3-Webinterface/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Panda-Projects/CloudNet-V3-Webinterface" alt="Contributors"/>
</a>
