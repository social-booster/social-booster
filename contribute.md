# SocialBooster infrastructure

SocialBooster の環境整備コード一式

## 前提条件

- `Docker` および `docker-compose` インストール。
- [social-booster](https://github.com/syuumu200/social-booster) フォーク、およびクローン。

### Dockerのインストールについて

winの場合

WSL2の有効化

[Docker公式HP(アカウントの作成が必要かもしれません。)](https://www.docker.com/)

---

macの場合

Homebrewがインストールされている前提です。

```[bash]
brew install docker
brew cask install docker
```

---

Linuxの場合(Ubuntu20.04LTSの場合)

```[bash]
sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt update
apt-cache policy docker-ce
sudo apt install docker-ce
sudo systemctl status docker
sudo usermod -aG docker ${USER}
su - ${USER}
sudo usermod -aG docker username
```

---

## 操作方法

### local

#### 起動(ビルド)

```[bash]
docker-compose up -d
```

#### Vue.js ビルド

ビルド後

docker-compose exec nodejs bash

```[bash]
npm run dev

# npm rebuild node-sass  # npm run dev が失敗した場合に試してみてください
```

#### 画面表示

[開発画面](http://localhost:3080/)

## Note

- Laravel のキャッシュ類をクリアする際は、appコンテナ内で  
  docker-compose exec laravel bash

  `php artisan cache:clear` `composer dump-autoload` を行ってください

### No application encryption key has been specified. が発生した場合の処置例  

(localhost:3080 を起動できない場合)

- コンテナを出て .env の APP_KEY_C= の右辺に `base64:0s0V2Bu2AYo6MMRoyLcZlAw+5D6ZtzLOyvAgvFmqg5Q=` を設定
  - `docker-compose down`
  - `docker-compose up -d` を実行して環境一式を再起動
  - コンテナ内に入り `php artisan cache:clear` `composer dump-autoload` を実行してキャッシュをクリア
  - 再度、ブラウザで [開発画面](http://localhost:3080/) をリクエスト

- メール認証ができなくて困る場合は [syuumu200](https://github.com/syuumu200) さんに SMTP 設定を聞くなどしたうえで .env の MAIL_* を正しく設定して対処してください

### 参考文献

この環境整備コード一式は、[最強のLaravel開発環境をDockerを使って構築する【新編集版】 - Qiita](https://qiita.com/ucan-lab/items/5fc1281cd8076c8ac9f4) を参考に整備しています

[参考URL](https://github.com/ucan-lab/docker-laravel)

---

## 設定ファイルについて

### .envファイル

```[bash]

APP_NAME=SocialBooster
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:3080

WEB_PORT=3080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_USERNAME=user
DB_PASSWORD=pass
DB_DATABASE=social_booster_local

TZ=Asia/Tokyo
MYSQL_DATABASE="${DB_DATABASE}"
MYSQL_USER="${DB_USERNAME}"
MYSQL_PASSWORD="${DB_PASSWORD}"
MYSQL_ALLOW_EMPTY_PASSWORD=1
MYSQL_ROOT_PASSWORD=P@ssw0rd

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUEONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

TELESCOPE_ENABLED=true
LOG_CHANNEL=stack

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=

ADMIN_HTTPS=false

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

MIX_RECAPTCHA_SITE_KEY="${RECAPTCHA_SITE_KEY}"

MIX_APP_ENV="${APP_ENV}"

JWT_SECRET=

```

---

### .env.localについて

```[bash]
APP_NAME=${APP_NAME_C}
APP_ENV=${APP_ENV_C}
APP_KEY=${APP_KEY_C}
APP_DEBUG=${APP_DEBUG_C}
APP_URL=${APP_URL_C}

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=${DB_HOST_C}
DB_PORT=3306
DB_DATABASE=${DB_DATABASE_C}
DB_USERNAME=${DB_USERNAME_C}
DB_PASSWORD=${DB_PASSWORD_C}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=${MAIL_HOST_C}
MAIL_PORT=${MAIL_PORT_C}
MAIL_USERNAME=${MAIL_USERNAME_C}
MAIL_PASSWORD=${MAIL_PASSWORD_C}
MAIL_ENCRYPTION=${MAIL_ENCRYPTION_C}
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS_C}
MAIL_FROM_NAME="${APP_NAME_C}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET=

PUSHER_APP_ID=${PUSHER_APP_ID_C}
PUSHER_APP_KEY=${PUSHER_APP_KEY_C}
PUSHER_APP_SECRET=${PUSHER_APP_SECRET_C}
PUSHER_APP_CLUSTER=${PUSHER_APP_CLUSTER_C}

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY_C}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER_C}"

RECAPTCHA_SITE_KEY="${RECAPTCHA_SITE_KEY_C}"
RECAPTCHA_SECRET_KEY=${RECAPTCHA_SECRET_KEY_C}

MIX_RECAPTCHA_SITE_KEY="${RECAPTCHA_SITE_KEY_C}"
MIX_RECAPTCHA_SECRET_KEY=${RECAPTCHA_SECRET_KEY_C}

MIX_APP_ENV="${APP_ENV_C}"

ADMIN_HTTPS=${ADMIN_HTTPS_C}
```
