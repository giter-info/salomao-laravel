# Projeto: Dockerização Salomão Laravel

## Objetivo
Padronizar ambiente de desenvolvimento e produção com Docker, mantendo Laravel + Filament + MySQL + Redis.

## Escopo
- Ambiente de desenvolvimento com hot reload (Vite).
- Build de produção multi-stage.
- Serviços dedicados para queue e scheduler.
- Nginx como proxy/reverse para PHP-FPM.
- Documentação operacional.

## Entregáveis
- `Dockerfile` multi-stage (`dev` e `prod`).
- `docker-compose.yml` base (MySQL/Redis).
- `docker-compose.dev.yml` para desenvolvimento.
- `docker-compose.prod.yml` para produção.
- Configs de Nginx/PHP/entrypoint em `docker/`.
- Arquivos de ambiente Docker.
- README atualizado.

## Fases

### Fase 1: Base Docker
- [x] Criar `Dockerfile` com extensões PHP necessárias.
- [x] Criar entrypoint de bootstrap/cache.
- [x] Configurar PHP-FPM (`php.ini` e `www.conf`).

### Fase 2: Compose Dev
- [x] Estruturar compose base com MySQL e Redis.
- [x] Adicionar serviços `app`, `nginx`, `node`, `queue`, `scheduler`.
- [x] Definir volumes e portas para desenvolvimento.
- [x] Definir env dedicado (`.env.docker.dev`).

### Fase 3: Compose Prod
- [x] Ativar target `prod` no `Dockerfile`.
- [x] Configurar `app`, `nginx`, `queue`, `scheduler` para produção.
- [x] Definir env de produção (`.env.docker.prod` e `.env.docker.prod.example`).

### Fase 4: Operação e Qualidade
- [x] Atualizar `README.md` com comandos oficiais.
- [x] Documentar estratégia e checklist.
- [ ] Validar build completo em CI.
- [ ] Publicar imagem versionada em registry.
- [ ] Automatizar migration job no pipeline de deploy.

## Comandos de referência

### Desenvolvimento
```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app composer install
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app php artisan key:generate
docker compose -f docker-compose.yml -f docker-compose.dev.yml exec app php artisan migrate --seed
```

### Produção
```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec app php artisan migrate --force
```
