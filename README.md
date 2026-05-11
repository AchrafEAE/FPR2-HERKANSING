# IT Development Portfolio — Showcase Application++

Een moderne Laravel 12 web applicatie voor professioneel portfolio management, inclusief blog workflow, studievoortgang tracking en professionele biografie beheer.

## Vereisten

- PHP 8.2+
- Composer
- MySQL 8.0+ (of SQLite voor lokale dev)
- Docker (optioneel, voor geïsoleerde omgeving)

## Lokale opzet

### 1. Project klonen en dependencies installeren

```bash
git clone <repository-url> .
composer install
```

### 2. Configuratie

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` met je database credentials (default SQLite is OK voor development):

```env
DB_CONNECTION=sqlite
# of
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database migraties en seeding

```bash
php artisan migrate
php artisan seed:run
```

### 4. Development server starten

```bash
php artisan serve
```

Navigeer naar `http://localhost:8000/` om de applicatie te openen.

## Quality checks en testen

### Alle checks uitvoeren

```bash
composer run quality
```

Dit voert achtereenvolgens uit:
- PHPStan static analysis (level 8)
- PHPCS PSR-12 linting
- Deptrac architecture verification
- PHPUnit tests met minimaal 60% coverage

### Individuele checks

```bash
# Static analysis
composer run analyse

# Linting
composer run lint

# Architecture rules
composer run arch

# Tests met coverage
composer run test:coverage

# Tests enkel
composer test
```

## API endpoints

### Publieke endpoints

```
GET  /api/v1/portfolio
     Retourneert professionele biografie en portfolio-overzicht
```

### Geverifieerde endpoints

```
GET    /api/v1/bio         Haal huidige gebruiker bio op
PUT    /api/v1/bio         Update bio
```

## Architectuur

Het project volgt een **gelaagde hexagonale architectuur**:

- **Domain**: Zuivere business logic zonder framework-afhankelijkheden
- **Application**: Use cases en workflow-orkestratie
- **Infrastructure**: Concrete implementaties (Eloquent, externe services)
- **Presentation**: HTTP controllers en routes

Gedetailleerde architectuurinformatie zie de wiki.

## Documentatie

Zie de wiki voor uitgebreide documentatie.

## Licentie

MIT
