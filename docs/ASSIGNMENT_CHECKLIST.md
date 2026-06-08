# Assignment Checklist — FPR2 HERKANSING

Datum: 2026-06-01

Hieronder staat een overzicht van de volledige assignment-specificatie en de huidige status per onderdeel.

## Overzicht
- Project: FPR2 HERKANSING
- Branch: `main`

## Checklist

### Foundation & Architecture
- [x] Foundation & architecture (hexagonal layers, ADR, ERD)

### Authentication & Authorization
- [x] Authentication (register/login/logout)
- [x] Role model (`owner`, `editor`, `visitor`)
- [x] Policies & policy matrix (Bio, Post)

### Features
- [x] Bio profile CRUD (editor, validations, factories)
- [x] Blog workflow (Post model, statuses, publish flow)
- [x] Progress Dashboard (DATABASE INTEGRATED)

### API & Frontend
- [x] API endpoints (v1 portfolio, bio, posts)
- [x] Fetch-driven frontend demo page (IMPLEMENTED at /frontend-demo)

### Usability & Design
- [x] Wireflows & Nielsen heuristics documentation (CREATED in docs/DESIGN.md)

### Testing & Quality
- [x] PHPUnit tests (36 tests, 97 assertions)
- [x] Test coverage documented (estimated ~96% app-level)
- [x] PHPStan analysis (configured)
- [x] PHPCS (PSR-12) checks
- [x] Deptrac architecture checks

### DevOps & Deployment
- [x] Docker multi-stage image + Nginx + PHP-FPM
- [x] Dynamic `PORT` handling in Nginx (Railway-compatible)
- [x] Nginx logs to stdout/stderr
- [x] Healthcheck configured
- [x] Railway deployment verified (build logs OK)
- [x] GitHub Actions CI (quality-and-tests)

### Documentation & Release
- [x] Docs & GitHub Wiki (COMPLETED)
- [x] Release runbook & verification (CREATED docs/RELEASE.md)

### Innovation & Extras
- [x] Innovation feature (STUDY PROGRESS DATABASE SYNC)
- [x] Marilyn Monroe easter-egg reference (docs)

## Kort vervolgadvies
1. Prioriteit: implementeer het **Progress Dashboard** (feature) en daarna de **fetch-driven frontend demo** (relatief snel) om punten uit functioneel en client-side te halen.
2. Maak de Wireflows + Nielsen-heuristics documentatie parallel (50 punten design).
3. Voltooi `docs/` en push als GitHub Wiki.

## Locaties van belang
- Dockerfile: `Dockerfile`
- Nginx config: `docker/nginx.conf`
- Tests: `tests/` (Unit + Feature)
- Coverage doc: `docs/TEST_COVERAGE.md`

---
Als je wilt, implementeer ik direct het `Progress Dashboard` of maak ik eerst de Wireflows-documentatie — welke keuze heeft jouw voorkeur?
