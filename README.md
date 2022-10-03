## Link Shortener

Girilen url yi kısaltmak için geliştirilmiş küçük bir uygulamadır.

- Login olan kullanıcılar içi daha önce ekledikleri linkleride gösterilir.
- Login olmamış kullanıcılar için sadece ilk oluşturlduğunda bir seferlik gösterilir ve bu gösterilme sadece 5 saniye rediste tutulur. Redisten silindiği için sayfa yenilenmelerinde tekrardan görünmez.

## Ubuntu sistem kurulumu

#### Sisteminizde olması gerekenler:
- mysql veya mariadb server
- git
- composer
- docker
- veritabanı editörü (tercihen dbeaver)
- redis gui (tercihen RESP.app)
- code editor (phpstorm veya vscode)

#### 1. Git klon
```bash
git clone link-shortener
cd link-shortener
```

#### 2. Env
```bash
sudo mv .env.example .env
```

#### 3. Docker build
```bash
sudo docker-compose up -d --build
```

#### 4. Composer update
```bash
composer update
```

#### 5. Composer update
```bash
sudo docker exec -it link_shortener_app bash
php artisan migrate:fresh --seed
```
