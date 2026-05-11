# Deployment op Railway

Railway is een PaaS platform dat Laravel applicaties eenvoudig deploy en host met Docker, MySQL en automated CI/CD.

## Voorbereiding

1. **Zorg dat je project in Git staat** ✅ (reeds gedaan lokaal)
2. **GitHub account** (https://github.com)
3. **Railway account** (https://railway.app)

## Stap 1: GitHub Repository Aanmaken

1. Ga naar https://github.com/new
2. Geef het een naam (bijv. `portfolio-app`)
3. Beschrijving: "IT Development Portfolio - Laravel 12 Showcase Application"
4. Kies **Public** (Railway werkt beste met public repos)
5. Click "Create repository"

## Stap 2: Code naar GitHub Pushen

Na het aanmaken van de GitHub repo krijg je instructies. Voer dit uit in je terminal:

```bash
cd c:\Visual-studio-project-folder\FPR2\ HERKANSING

# Remote toevoegen aan je lokale repo
git remote add origin https://github.com/YOUR_USERNAME/portfolio-app.git

# Rename main branch (GitHub defaulted naar 'main')
git branch -M main

# Push naar GitHub
git push -u origin main
```

## Stap 3: Railway Project Aanmaken & Connecten

1. Ga naar https://railway.app → Sign up (via GitHub)
2. Click **"New Project"**
3. Kies **"Deploy from GitHub repo"**
4. Selecteer je `portfolio-app` repository
5. Click **"Deploy"**

Railway zal nu automatisch:
- Detecteren dat het een Laravel project is
- Build environment instellen
- Deployment starten

## Stap 4: MySQL Database Toevoegen

1. In je Railway project dashboard, click **"+ Add Service"**
2. Selecteer **"MySQL"**
3. Railway configureerde automatisch variables (MYSQL_* env vars)

## Stap 5: Environment Variables Instellen

Railway genereert automatisch sommige variabelen. Vul deze handmatig in:

1. In Railway dashboard → **"Variables"** tab
2. Voeg deze toe (de `DATABASE_URL` wordt automatisch door Railway gegenereerd na MySQL service toevoegen):

```
APP_NAME=Portfolio
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app
DB_CONNECTION=mysql
DATABASE_URL=${{ MYSQL_URL }}
```

**Of**, als je individual variables wilt:
```
DB_HOST=${{ MYSQL_HOST }}
DB_PORT=${{ MYSQL_PORT }}
DB_DATABASE=${{ MYSQL_DATABASE }}
DB_USERNAME=${{ MYSQL_USER }}
DB_PASSWORD=${{ MYSQL_PASSWORD }}
```

Railway substitueert `${{ MYSQL_* }}` automatisch.

3. **Generate APP_KEY**: 
   - Lokaal: `php artisan key:generate --show`
   - Copy de output
   - Paste in Railway variable `APP_KEY`

## Stap 6: Build en Start Commando's Instellen

Railway moet migraties uitvoeren en het app starten. Controleer deze instellingen:

1. Dashboard → je app → **"Deployment"** tab (of **"Settings"** → **"Build & Deploy"**)

2. **Build Command** (voer migraties uit):
   ```bash
   composer install && php artisan migrate --force
   ```

3. **Start Command** (cache en start server):
   ```bash
   php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

## Stap 7: Controleer DATABASE_URL / MYSQL_* Variabelen

Railway genereert automatisch `MYSQL_*` variabelen na MySQL service toevoegen. Controleer:

1. Dashboard → **"Variables"** tab
2. Je moet zien:
   - `MYSQL_HOST` (bijv. `containers-us-west-xyz.railway.app`)
   - `MYSQL_PORT` (bijv. `3306`)
   - `MYSQL_USER` (bijv. `root`)
   - `MYSQL_PASSWORD` (gegenereerde wachtwoord)
   - `MYSQL_DATABASE` (bijv. `railway`)

3. **Kies één aanpak** (niet allebei):
   - **Optie A: DATABASE_URL** (eenvoudiger):
     ```
     DATABASE_URL=${{ MYSQL_URL }}
     ```
     (Als `MYSQL_URL` niet beschikbaar is, voeg handmatig toe: `mysql://user:pass@host:port/database`)
   
   - **Optie B: Individuele variabelen**:
     ```
     DB_CONNECTION=mysql
     DB_HOST=${{ MYSQL_HOST }}
     DB_PORT=${{ MYSQL_PORT }}
     DB_DATABASE=${{ MYSQL_DATABASE }}
     DB_USERNAME=${{ MYSQL_USER }}
     DB_PASSWORD=${{ MYSQL_PASSWORD }}
     ```

4. Voeg ook toe:
   ```
   APP_NAME=Portfolio
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-app.railway.app (pas dit aan naar je echte domain)
   APP_KEY=base64:YOUR_KEY_HERE (zie Stap 5)
   ```

## Stap 5: Generate APP_KEY

Lokaal:
```bash
php artisan key:generate --show
```

Copy de hele output (inclusief `base64:` prefix) en plak in Railway variable `APP_KEY`.

## Stap 8: Deployment & Testen

1. **Manual redeploy** (na variabelen ingesteld):
   - Dashboard → **"Deployments"** → **"Trigger Deploy"** knop

2. **Check Logs** (voor migratie-fouten):
   - Dashboard → **"Logs"** tab
   - Zoek naar `Running migrations` of `SQLSTATE` errors

3. **Test** (na succesvol deploy):
   ```bash
   curl https://your-app.railway.app/
   curl https://your-app.railway.app/api/v1/portfolio
   ```

## Troubleshooting Railway

### 500 Error / Blank Page
- Check Logs tab voor PHP/Laravel errors
- Verify `DATABASE_URL` of `MYSQL_*` variabelen zijn gezet
- Verify `APP_KEY` is geldig (start met `base64:`)

### "Migrations not found" / "SQLSTATE" Errors
- Check of Build Command is ingesteld
- Controleer DATABASE_URL / MYSQL_* syntax
- Test lokaal: `php artisan migrate --force` met dezelfde DB credentials

### MySQL Geen Tabellen
- Redeploy met Build Command: `composer install && php artisan migrate --force`
- Check Logs durante deployment voor migration errors

### Deployment fails
1. Check logs: Railway Dashboard → Logs tab
2. Common issue: `APP_KEY` niet ingesteld → zie Stap 5
3. Database migration error → Check MySQL connection vars

### Site geeft 500 error
1. Railway Logs → Check error messages
2. Waarschijnlijk: `APP_DEBUG=false` en APP_KEY wrong
3. Fix vars en re-deploy via GitHub push

### Langsaam laden
1. Run in Railway terminal: `php artisan config:cache`
2. Zie Stap 6 Start Command — moet caching rules hebben

## GitHub Actions + Railway Auto-Deploy

Na dit alles:
1. **GitHub Actions** runs CI checks (PHPStan, PHPCS, tests)
2. Als checks slagen → Railway auto-deploys
3. Als checks falen → Deployment blocked

Dit is geconfigureerd in `.github/workflows/ci.yml`.

## Weekly Release Flow

Elke week:

```bash
# Local development
php artisan serve

# Quality checks
composer run quality

# If green, push to GitHub
git add .
git commit -m "Week 2: Blog feature complete"
git push origin main

# Railway auto-deploys
# Monitor: railway.app dashboard
```

## Monitoring

Railroad biedt:
- **Real-time logs**: Dashboard → Logs
- **Deployments history**: Dashboard → Deployments
- **Metrics**: CPU, Memory, Network (free plan beperkt)

## Kosten

- **Free tier**: ~18 hours/month (test projects)
- **Paid ($5/month)**: Unlimited hours
- **MySQL**: Included, 5GB storage

Voor production (jou geval) → upgrade naar $5/maand als nodig.

## Volgende Stappen

1. Create GitHub repo (link krijgen)
2. Local: `git remote add origin <url>` + `git push origin main`
3. Open https://railway.app → new project
4. Connect GitHub repo
5. Add MySQL
6. Set variables (APP_KEY, DB_*, APP_URL)
7. Deploy (wait 3-5 min)
8. Ga naar gegenereerde Railway URL → tadaa!

Vragen? Check Railway docs: https://docs.railway.app
