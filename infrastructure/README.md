# SocialBooster infrastructure

SocialBooster の環境整備コード一式


## PreRequirements

- `Docker` installed.
- `Docker Compose` installed.
- [social-booster](https://github.com/syuumu200/social-booster) cloned.


## 操作方法

### local

#### 起動

```
cd /path/to/social-booster/infrastructure

cp -p .env.local .env

docker-compose up -d  

(・・・)

docker-compose exec app bash
```


(In container)

```
make vendor   # composer install ほか を実行

php artisan migrate
```


#### Vue.js ビルド

(起動されている前提)

``` 
cd /path/to/social-booster/infrastructure

docker-compose exec web ash
```


(In container)

```
npm i    # コンテナ作成直後の１回だけでOK

npm run dev
```

※ 12/19 時点ではビルド失敗しました


#### 画面表示

(Use your web browser)

``` 
open http://localhost:3080/
```




## Note
- Laravel のキャッシュ類をクリアする際は、appコンテナ内で  
  （docker-compose exec app bash）  
  `make clr` を行ってください
  
- この環境整備コード一式は、[最強のLaravel開発環境をDockerを使って構築する【新編集版】 - Qiita](https://qiita.com/ucan-lab/items/5fc1281cd8076c8ac9f4) を参考に整備しています
    - https://github.com/ucan-lab/docker-laravel
