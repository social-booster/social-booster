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

#### mountしてあるlogファイル等をlocalで生成する

---

##### windowsの方

docker_init.batを実行してください

文字化け及び改行コードエラーが発生する場合

- UTF-8 → shift-jis
- LF → CRLF

---

##### mac、linuxの方

```[bash]
chmod 771 docker_init.sh
sh docker_init.sh
```

---

##### 手動で作る場合

- mysqlのファイル
  - docker/mysqlの下に `db` という空のフォルダを作成する
  - docker/mysqlの下に `logs` というフォルダを作成し、 `mysqld.log` `mysql-error.log` という空のファイルを作成
- nginxのファイル
  - docker/nginxの下に `logs` というフォルダを作成し、 `access.log` `error.log` という空のファイルを作成

---

#### .envファイルの変更

`.env copy` を `.env` に変更する

#### ビルド

```[bash]
docker-compose up -d --build
```

初回起動時、npmとcomposerをbuild完了後実行されるので、localhost:3080にアクセスするのはlaravelがmigrateが終了し、php-fpmが実行されるまでは全く動けないので、

気長にビルドはお待ちください。

---

#### Vue.js ビルド

ビルド後、vue関連のファイルの変更を加える場合にはこちらの通りに行ってください。

`docker-compose exec nodejs bash`

```[bash]
npm run dev

# npm run dev が失敗した場合に試してみてください
npm rebuild node-sass
```

#### 画面表示

[開発画面](http://localhost:3080/)

---

## php周りについて

### Laravel のキャッシュ類をクリアする際は、appコンテナ内で

- `docker-compose exec laravel bash`

- `php artisan cache:clear` `composer dump-autoload` を行ってください

---

### Laravelがmigrate出来なくなったとき

bootstrap/cacheの中のphpファイルを全て消してもう一回ビルドする

---

### phpの設定クリアコマンド(bash内にて実行)

`docker-compose exec laravel bash`

```[bash]
composer clear-cache
php artisan view:clear
php artisan route:clear
php artisan clear-compiled
php artisan config:cache
```

---

### phpのキャッシュクリアコマンド(bash内にて実行)

`docker-compose exec laravel bash`

```[bash]
php artisan cache:clear
```

---

### phpのテストコマンド(bash内にて実行)

`docker-compose exec laravel bash`

```[bash]
vendor/bin/phpunit --configuration=phpunit.xml
```

---

## メール認証について

- メール認証ができなくて困る場合は [syuumu200](https://github.com/syuumu200) さんに SMTP 設定を聞くなどしたうえで .env の MAIL_* を正しく設定して対処してください

---

### 参考文献

この環境整備コード一式は、[最強のLaravel開発環境をDockerを使って構築する【新編集版】 - Qiita](https://qiita.com/ucan-lab/items/5fc1281cd8076c8ac9f4) を参考に整備しています

[参考URL](https://github.com/ucan-lab/docker-laravel)

このリポジトリを大幅に改造してます。

---
