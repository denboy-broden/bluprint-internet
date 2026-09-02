#!/bin/bash
# run-laravel.sh — Jalankan Laravel API di container Docker
set -e
echo "============================================"
echo " RT/RW Net API - Start Script"
echo "============================================"
echo ""
echo "[1/6] Menghapus container lama..."
docker rm -f rt-rw-api 2>/dev/null || true
echo "[2/6] Build image Laravel..."
cd "$(dirname "$0")"
docker-compose build --no-cache laravel
echo "[3/6] Menjalankan container rt-rw-api (sleep infinity)..."
docker run -d --name rt-rw-api --network blueprint_rt-rw-net -p 8001:8000 -v "$(pwd)/api:/var/www/html" -e DB_HOST=mariadb -e DB_PORT=3306 -e DB_DATABASE=rt_rw_net -e DB_USERNAME=root -e DB_PASSWORD=secret -e REDIS_HOST=redis rt-rw-api:latest sleep infinity
echo "[4/6] Install Composer dependencies..."
docker exec rt-rw-api sh -c "cd /var/www/html && composer install --no-dev --ignore-platform-reqs -q"
echo "[5/6] Generate APP_KEY..."
docker exec rt-rw-api sh -c "cd /var/www/html && php artisan key:generate -q"
echo "[6/6] Menjalankan php artisan serve..."
docker exec -d rt-rw-api sh -c "cd /var/www/html && nohup php artisan serve --host=0.0.0.0 --port=8000 > /tmp/serve.log 2>&1 & echo \$! > /tmp/serve.pid"
echo ""
echo "============================================"
echo " Selesai! API berjalan di http://localhost:8001"
echo "============================================"
echo ""
echo "Test endpoint:"
echo "  curl http://localhost:8001/api/health"
echo "  curl http://localhost:8001/api/customers"
echo ""
echo "Logs:"
echo "  docker exec rt-rw-api cat /tmp/serve.log"
echo "  docker logs rt-rw-api --tail 20"
echo ""
