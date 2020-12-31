## 概要

- 勉強用のAPIサーバ
- M1（Apple Silicon）で動く、Laravel環境構築

## 起動

- 一旦、ビルドインサーバー使う

```
$ docker-compose exec web php artisan serve --host 0.0.0.0 --port 8081
```

URL: `http://localhost:8081` 

- PostgreSQL起動
```
$ docker-compose exec database psql -p 5432 -U postgres
```

## 環境

|  | version |
| ---- | ---- |
| PHP | 8.0.0 |
| Laravel | 8.20.1 |
| PostgreSQL | 11.10 |

## Swaggerの導入
https://github.com/DarkaOnLine/L5-Swagger

1. 導入
```
$ cd {pj dir}
$ docker-compose exec composer require "darkaonline/l5-swagger"
```

2. 環境設定
.envに以下を記載（SwaggerUIをロードするたびに、ドキュメントが更新されるようになる）
```.env
L5_SWAGGER_GENERATE_ALWAYS=true
```
