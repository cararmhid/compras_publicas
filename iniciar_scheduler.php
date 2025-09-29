<?php
while (true) {
    exec('php artisan schedule:run');
    sleep(60); // Espera un minuto antes de volver a verificar
}
