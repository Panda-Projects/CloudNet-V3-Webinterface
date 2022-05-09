[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

<img width="100px" style="border-radius: 10px;" src="https://cdn.panda-studios.eu/logo-transparent.png" alt="Panda-Studios Logo">

# CloudNet V3 Webinterface

## Vorraussetzungen:

- CloudNet 3.x und das modifizierte Rest-Modul
- Webserver oder Webspace
  - PHP 8
  - PHP Curl
  - Apache2 Mods: rewrite

## Download

Das Module kannst du hier Herrunterladen ``https://f64.workupload.com/download/3dV5dnADZ4x``

## Installation

1. Lösche ```cloudnet-rest.jar in CloudNet``` aus dem Ordner Modul
2. Downloade die modifizierte ``cloudnet-rest.jar``
3. Starte CloudNet neu
4. Installieren Sie Apache2
5. Clonen Sie jetzt das Webinterface mit ``git clone https://github.com/Panda-Projects/CloudNet-V3-Webinterface.git``

Info: Das Webinterface funktioniert auch auf einen externen Server/Webspace!    

### Webserver Configuration

#### Apache2

1. Gehe zu /etc/apache2/sites-available
2. Erstelle eine Datei mit der Endung .conf
   (Beispiel: webinterface.conf)
3. Füge das folgende ein und füge deine Daten ein

        <VirtualHost *:80>
            ServerName webinterface.domain.com
            DocumentRoot "/var/www/webinterface/public"

            <Directory /var/www/webinterface/public>
                    AllowOverride All
            </Directory>


        </VirtualHost>

4. Aktiviere die Seite mit

        a2ensite webinterface.conf

5. Starte Apache2 neu

        service apache2 restart

6. Sollte der Kommand nicht funktionieren, führe "a2enmod rewrite" aus

7. Installier ein SSL-Zertifikat mit https://certbot.eff.org/

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

## License
```
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```

<a href="https://github.com/Panda-Projects/CloudNet-V3-Webinterface/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Panda-Projects/CloudNet-V3-Webinterface" alt="Contributors"/>
</a>
