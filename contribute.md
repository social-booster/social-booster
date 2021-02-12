# SocialBooster infrastructure

SocialBooster の環境整備コード一式

## PreRequirements

- `Docker` installed.
- `Docker Compose` installed.
- [social-booster](https://github.com/syuumu200/social-booster) cloned.

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
