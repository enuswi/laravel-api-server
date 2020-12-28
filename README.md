## 概要

- M1で動く、Laravel環境構築

## 起動

- 一旦、ビルドインサーバー使う

```
docker-compose exec web php artisan serve --host 0.0.0.0 --port 8081
```

URL: `localhost:8081` 