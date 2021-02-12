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

Homebrewがインストール去れている前提です。

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

#### 起動

```[bash]
cd /path/to/social-booster
cp -p .env.docker .env

cd /path/to/social-booster/infrastructure
cp -p .env.local .env

docker-compose up -d  

(・・・)

docker-compose exec app bash
```

#### Vue.js ビルド

(起動: docker-compose up -d されている前提)

```[bash]
cd /path/to/social-booster/infrastructure

docker-compose exec web ash
```

(In container)

```[bash]
npm i    # コンテナ作成直後の１回だけでOK

npm run dev

# npm rebuild node-sass  # npm run dev が失敗した場合に試してみてください
```

#### 画面表示

(Use your web browser)

```[bash]
open http://localhost:3080/
```

## Note

- Laravel のキャッシュ類をクリアする際は、appコンテナ内で  
  （docker-compose exec app bash）  
  `make clr` を行ってください

- `No application encryption key has been specified.` が発生した場合の処置例  
  (localhost:3080 を起動できない場合)
  - コンテナを出て .env.local の APP_KEY_C= の右辺に  
    `base64:0s0V2Bu2AYo6MMRoyLcZlAw+5D6ZtzLOyvAgvFmqg5Q=` を設定
  - `docker-compose down; docker-compose up -d` を実行して環境一式を再起動
  - コンテナ内に入り `make clr` を実行してキャッシュをクリア
  - 再度、 ブラウザで localhost:3080 をリクエスト

- メール認証ができなくて困る場合は @syuumu200 さんに SMTP 設定を聞くなどしたうえで .env の MAIL_* を正しく設定して対処してください

- この環境整備コード一式は、[最強のLaravel開発環境をDockerを使って構築する【新編集版】 - Qiita](https://qiita.com/ucan-lab/items/5fc1281cd8076c8ac9f4) を参考に整備しています
  - [参考URL](https://github.com/ucan-lab/docker-laravel)

---

## 設定ファイルについて

### .envファイル

```[bash]

APP_NAME_C=SocialBooster
APP_ENV_C=local
APP_KEY_C=
APP_DEBUG_C=true
APP_URL_C=http://localhost:3080

WEB_PORT_C=3080

DATABASE_URL=127.0.0.1
DB_HOST_C=127.0.0.1
DB_PORT_C=3316
DB_NAME_C=social-booster_local
DB_USER_C=user
DB_PASS_C=pass
DB_ROOT_PASS_C=secret

MAIL_HOST_C=
MAIL_PORT_C=
MAIL_USERNAME_C=
MAIL_PASSWORD_C=
MAIL_ENCRYPTION_C=
MAIL_FROM_ADDRESS_C=

PUSHER_APP_ID_C=
PUSHER_APP_KEY_C=
PUSHER_APP_SECRET_C=
PUSHER_APP_CLUSTER_C=

RECAPTCHA_SITE_KEY_C=
RECAPTCHA_SECRET_KEY_C=

ADMIN_HTTPS_C=false

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

---

### .env.dockerについて(あんまり使わないかも)

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
