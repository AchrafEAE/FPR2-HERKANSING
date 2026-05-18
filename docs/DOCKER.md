# Docker Setup & CI/CD Guide

This project uses multi-stage Docker builds for optimized production images and automated CI/CD via GitHub Actions.

## Architecture

### Dockerfile (Multi-stage)

**Stage 1: Builder**
- Base: `php:8.2-cli`
- Installs Composer and all dev dependencies
- Creates optimized autoloader
- ~600MB intermediate image (not in final build)

**Stage 2: Production**
- Base: `php:8.2-fpm`
- Includes Nginx reverse proxy
- Only runtime dependencies
- ~300MB final image
- Includes health checks

## Building Locally

### Option 1: Docker Compose (Development)

```bash
# Start MySQL dev environment
docker compose up -d

# Or use the existing setup with local PHP
php artisan serve
```

### Option 2: Production Build

```bash
# Build multi-stage image
docker build -t portfolio:latest .

# Or using docker-compose.prod.yml
docker compose -f docker-compose.prod.yml up -d
```

### Option 3: Build and Run

```bash
# Build and run together
docker compose -f docker-compose.prod.yml build
docker compose -f docker-compose.prod.yml up -d

# View logs
docker compose -f docker-compose.prod.yml logs -f app

# Run migrations in container
docker compose -f docker-compose.prod.yml exec app php artisan migrate
```

## CI/CD Pipeline (GitHub Actions)

Triggered on every push to `main` and pull requests.

### Jobs

1. **quality-and-tests**
   - Setup PHP 8.2 environment
   - Cache Composer dependencies
   - Runs migrations against test MySQL database
   - PHPStan analysis (level 8)
   - PHPCS code style check (PSR-12)
   - Deptrac architecture validation
   - Unit/Feature tests with coverage (min 60%)
   - ~3 minutes total

2. **docker-build** (only on main branch, after tests pass)
   - Builds multi-stage Docker image
   - Caches layers with GitHub Actions cache
   - Validates Dockerfile syntax

## Configuration

### Environment Variables (Production)

In `docker-compose.prod.yml` or your Docker environment:

```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=portfolio
DB_USERNAME=portfolio
DB_PASSWORD=secret
```

### PHP Configuration

Optimized in `docker/php.ini`:
- Error logging (not display errors in production)
- Memory limit: 256MB
- OPcache enabled for performance
- Timezone: Europe/Amsterdam

### Nginx Configuration

`docker/nginx.conf`:
- Gzip compression
- Security headers (X-Frame-Options, CSP, etc.)
- Static asset caching (1 year)
- Laravel routing support
- Health endpoint at `/api/v1/portfolio`

## Troubleshooting

### Build fails: "no space left on device"

```bash
# Clean up Docker
docker system prune -a
docker volume prune
```

### Container exits immediately

```bash
# Check logs
docker compose -f docker-compose.prod.yml logs app

# Verify migrations ran
docker compose -f docker-compose.prod.yml exec app php artisan migrate:status
```

### MySQL connection refused

```bash
# Verify MySQL is running
docker compose -f docker-compose.prod.yml ps

# Check MySQL logs
docker compose -f docker-compose.prod.yml logs mysql
```

## Performance Optimization

- **Multi-stage build**: Reduces final image size by ~50%
- **Composer cache**: GitHub Actions caches dependencies (~30s saved per run)
- **OPcache enabled**: PHP bytecode caching improves response times
- **Nginx caching**: Static assets cached for 1 year in browser
- **Gzip compression**: Text responses compressed by ~70%

## Security Best Practices

✅ Implemented:
- App runs as `www-data` user (not root)
- Security headers configured (X-Frame-Options, X-XSS-Protection, etc.)
- HTTPS ready (configure in Nginx/load balancer)
- Sensitive files denied (`.git`, `.env`)
- Production image doesn't include dev dependencies

## Deployment to Production

### Via Railway

Railway auto-detects the Dockerfile and builds from it.

```bash
# Push to main → Railway redeploys automatically
git push origin main
```

### Via Docker Registry

```bash
# Build and tag
docker build -t myregistry/portfolio:latest .

# Push to registry
docker push myregistry/portfolio:latest

# Pull and run anywhere
docker run -e DB_HOST=mysql.example.com -p 8080:8080 myregistry/portfolio:latest
```

## CI/CD Pipeline Diagram

```
┌─────────────┐
│ Push/PR     │
└────┬────────┘
     │
     ▼
┌─────────────────────────────────────────┐
│ GitHub Actions: quality-and-tests       │
│ ├─ Setup PHP 8.2 + MySQL               │
│ ├─ Install dependencies (cached)        │
│ ├─ Run migrations                       │
│ ├─ PHPStan (level 8)                   │
│ ├─ PHPCS (PSR-12)                      │
│ ├─ Deptrac (architecture)              │
│ └─ Tests with coverage (60% min)       │
└────┬────────────────────────────────────┘
     │
     ├─ ✅ Pass → proceed to docker-build (main branch only)
     │
     ├─ ❌ Fail → block merge
     │
     ▼ (main branch only)
┌─────────────────────────┐
│ docker-build            │
│ ├─ Build multi-stage    │
│ └─ Cache layers        │
└─────────────────────────┘
```

## Local Development vs Production

| Aspect | Local Dev | Production |
|--------|-----------|-----------|
| Base Image | `php:8.2-cli` | `php:8.2-fpm` + Nginx |
| Error Display | `APP_DEBUG=true` | `APP_DEBUG=false` |
| Log Level | `debug` | `warning` |
| Dependencies | All (dev + prod) | Runtime only |
| Size | N/A | ~300MB |
| Image Count | 1 | 2 (builder + prod) |

## Next Steps

1. Build locally: `docker compose -f docker-compose.prod.yml build`
2. Test: `docker compose -f docker-compose.prod.yml up -d`
3. Verify: `curl http://localhost:8080/api/v1/portfolio`
4. Push: `git push origin main` → GitHub Actions + Railway auto-deploy
