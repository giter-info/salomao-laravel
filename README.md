# Salomão Laravel CMS

CMS em Laravel 12 + Filament para substituir o projeto anterior em Next.js (`salomao-site`).

## Docker (desenvolvimento)

1. Suba os containers:
```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build
```
2. Instale dependências PHP:
```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app composer install
```
3. Gere chave da aplicação:
```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app php artisan key:generate
```
4. Rode migrations e seeders:
```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app php artisan migrate --seed
```
5. Acesse:
- Site: `http://localhost:8000`
- Vite HMR: `http://localhost:5173`

## Docker (produção)

1. Revise variáveis em `.env.docker.prod`.
2. Suba:
```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build
```
3. Execute migrations (uma vez por deploy):
```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec app php artisan migrate --force
```
4. Acesse:
- Site: `http://localhost:8080` (ou porta em `NGINX_PORT`)

## Projeto de Dockerização

Roadmap/checklist em `docs/PROJECT_DOCKERIZACAO.md`.
