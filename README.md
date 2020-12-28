## 概要

- 勉強用のAPIサーバ
- M1（Apple Silicon）で動く、Laravel環境構築

## 起動

- 一旦、ビルドインサーバー使う

```
docker-compose exec web php artisan serve --host 0.0.0.0 --port 8081
```

URL: `http://localhost:8081` 

## 環境

| | version |
| -- | -- |
| PHP | 8.0.0 |
| Laravel | 8.20.1 |
| PostgreSQL |  |