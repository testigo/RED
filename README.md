# RED
Test app for Vostok Games

----- SET UP VIRTUAL HOST ----
<VirtualHost *:80>

   DocumentRoot "/var/www/vostok/public"
   ServerName vostok

   SetEnv APPLICATION_ENV development

   <Directory "/var/www/vostok/public">
    DirectoryIndex index.php
    Options All
    AllowOverride All
    Order Allow,Deny
    Allow from all
    Require all granted
   </Directory>
  ErrorLog "/var/logs/vostok-error.log"
</VirtualHost>
