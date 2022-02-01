## Documentation

Voit luoda ja poistaa asiakkaita tässä sovelluksessa.

Customers.vue viewi tarjoaa yksinkertaisen käyttöliittymän toiminnoille. Sieltä kutsutaan api.php sijaitsevia rajapintoja axios pyynnöillä ja ne kulkeutuvat CustomerControlleriin jossa on metodeilla esitetty toiminnat luonnille, poistamiselle ja hakemiselle.

.env tiedostoon pitää setupata tietokanta-asetukset kuntoon.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=harjoitus
DB_USERNAME=root
DB_PASSWORD=

## Komennot

composer install
npm install
php artisan migrate