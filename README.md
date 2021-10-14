# tesdetik
Test Case Detik




Cara Setup 

1. git clone https://github.com/rozaqabdul656/tesdetik.git
2. jalankan composer install di directory
3. Buat Database dengan nama DB_DETIK (atau di sesuaikan dengan config .env) database menggunakan mysql
4. Lalu masuk ke directory lewat cmd masukan  -> vendor/bin/phinx migrate -e development   (untuk migration table ke database)
5. Lalu jalankan  ->  vendor/bin/phinx seed:run (untuk insert data example ke table)
6. Lalu untuk runing apps jalankan  -> php -S 127.0.0.1:8000
7. Import postman collection dengan nama = Detik.postman_collection.json
8. Hit Create Payment& GET payment Status
9. Untuk runing cli update status dengan command : php -f transaction-cli.php 16341424519066  PAID


