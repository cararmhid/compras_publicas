#!/bin/bash
# Espera hasta que MySQL esté disponible
until nc -z -v -w30 mysql 3306
do
  echo "Esperando a MySQL..."
  sleep 5
done

# Ejecuta migraciones
php artisan migrate --force

# Inicia Apache
apache2-foreground
