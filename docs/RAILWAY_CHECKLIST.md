# Railway Deployment Checklist

Use deze checklist om je Railway deployment te debuggen.

## Pre-Deployment (Local)

- [ ] Migrations run lokaal: `php artisan migrate:fresh --seed`
- [ ] App starts lokaal: `php artisan serve`
- [ ] Tests passeren: `php artisan test`
- [ ] PHPStan clean: `vendor/bin/phpstan analyse`
- [ ] Git is gecommit: `git status` (working tree clean)

## Railway Dashboard Verification

### Variables Tab
- [ ] `APP_KEY` = `base64:...` (from `php artisan key:generate --show`)
- [ ] `APP_ENV` = `production`
- [ ] `APP_DEBUG` = `false`
- [ ] `APP_URL` = `https://your-app.railway.app` (correct domain)
- [ ] `DB_CONNECTION` = `mysql`
- [ ] Either `DATABASE_URL=${{ MYSQL_URL }}` OR all `MYSQL_*` individual vars set
- [ ] **Recopied all MYSQL_* vars** from Railway's auto-generated ones

### Build & Deployment Settings
- [ ] **Build Command** is set:
  ```bash
  composer install && php artisan migrate --force
  ```
- [ ] **Start Command** is set:
  ```bash
  php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=$PORT
  ```
- [ ] **Deployment Trigger**: Manual redeploy after variable changes

## Deployment Steps

1. **Set all variables** in Railway Dashboard → Variables tab
2. **Redeploy manually**: Dashboard → Deployments → Trigger Deploy
3. **Watch logs**: Dashboard → Logs tab
4. **Look for**:
   - "Running migrations" → should show 4 migrations (users, cache, jobs, bios)
   - "Server running" → indicates successful start
   - "SQLSTATE" or "PDO" errors → database connection problem
   - "Unsupported cipher" → APP_KEY wrong

## Quick Debug

### If migrations didn't run:
```
# Local: Test with Railway's DB values
export DB_HOST=your-railway-mysql-host
export DB_PORT=3306
export DB_DATABASE=railway
export DB_USERNAME=root
export DB_PASSWORD=your-password
php artisan migrate --force
```

### If DATABASE_URL error:
- Verify format: `mysql://user:password@host:port/database`
- Or use individual `DB_*` variables instead (Optie B in RAILWAY.md)

### If 500 error on site:
- Check Rails logs for specific error (could be APP_KEY, DATABASE, or code error)
- Try: `curl https://your-app.railway.app/api/v1/portfolio`
- Check if tables exist: use Railway database console or `php artisan migrate:status`

## After Successful Deploy

- [ ] Homepage loads: `https://your-app.railway.app/`
- [ ] API responds: `https://your-app.railway.app/api/v1/portfolio`
- [ ] Database has tables: Check in Railway's database viewer
- [ ] No 500 errors in browser console

## Still Stuck?

1. Share your Railway **Logs** output (paste last 50 lines)
2. Confirm **Variables** are all set (don't share sensitive values like passwords)
3. Verify **Build Command** matches above exactly
