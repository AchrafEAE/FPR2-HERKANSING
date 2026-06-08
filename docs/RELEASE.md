# Release Runbook

Dit document beschrijft de stappen om een nieuwe versie van het IT Development Portfolio te releasen.

## 1. Voorbereiding (Lokaal)
Voer de kwaliteitscontroles uit voordat je de code pusht:
```bash
# Draai alle tests
php artisan test

# Statische analyse
./vendor/bin/phpstan analyse

# Linting
./vendor/bin/phpcs
```

## 2. Versiebeheer
Zorg dat de `main` branch up-to-date is en dat alle wijzigingen zijn gecommit.
```bash
git checkout main
git pull origin main
```

## 3. GitHub Actions (CI)
Nadat de code naar GitHub is gepusht, controleer je de "Actions" tab. De workflow `quality-and-tests` moet volledig groen zijn. Als deze faalt, wordt de build op Railway niet automatisch doorgezet of is de kwaliteit niet gewaarborgd.

## 4. Railway Deployment (CD)
De applicatie wordt automatisch gedeployed via de Railway integratie.
*   **Database Migraties:** Railway voert automatisch `php artisan migrate --force` uit tijdens de build-fase (geconfigureerd in de build-pipeline).
*   **Static Assets:** Vite assets worden gebuild tijdens de Docker build-fase (`npm run build`).

### Handmatige Verificatie na Release
Controleer de volgende punten op de live URL:
1.  **Gezondheid:** Bezoek `/health` (indien aanwezig) of de homepage.
2.  **Dashboard:** Log in en verifieer of de studiepunten nog correct worden geladen uit de database.
3.  **API:** Bezoek `/frontend-demo` om te zien of de interne API correct functioneert in de live omgeving.

## 5. Rollback Procedure
Mocht de deployment falen:
1.  Ga naar het Railway Dashboard.
2.  Selecteer de vorige succesvolle deployment.
3.  Klik op "Redeploy" om direct terug te keren naar de werkende versie.
