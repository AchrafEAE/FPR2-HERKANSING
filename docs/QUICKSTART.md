# Quickstart — Volgende Stappen

## Status na Fase 1 (Foundation)

✅ Laravel 12 scaffold
✅ Quality tooling (PHPStan, PHPCS, Deptrac, CI)
✅ Role-based auth framework (owner/editor/visitor)
✅ First API endpoints: portfolio + bio
✅ All quality checks groen

## Fase 2 — Blog Publishing Workflow (Week 2)

### User Stories

1. **Eigenaar kan blog post aanmaken**
   - Gebruik: [USER_STORY_TEMPLATE.md](USER_STORY_TEMPLATE.md)
   - Locatie: `app/Domain/Blog/Entities/Post.php`
   - API: `POST /api/v1/posts` (owner/editor)
   - Tests: `tests/Feature/Blog/CreatePostTest.php`

2. **Eigenaar kan post publiceren/archiveren**
   - Status workflow: draft → published → archived
   - API: `PATCH /api/v1/posts/{id}/publish`, `PATCH /api/v1/posts/{id}/archive`

3. **Bezoekers kunnen posts lezen**
   - API: `GET /api/v1/posts?published=true`
   - Publieke weergave

4. **Commentaren op posts**
   - API: `POST /api/v1/posts/{id}/comments` (auth)
   - Moderation workflow

### Implementation Sequence

1. Domain entities: `BlogPost`, `Comment`, `PostStatus` enum
2. Repository interfaces: `BlogPostRepositoryInterface`
3. Application use cases: `CreatePostUseCase`, `PublishPostUseCase`
4. Infrastructure: Eloquent models, repositories
5. Presentation: Controllers, routes, validation
6. Tests: Unit → Integration → Feature
7. Documentation: Wiki user stories, API docs

### Files to Create

```
app/Domain/Blog/
├── Entities/
│   ├── Post.php
│   ├── Comment.php
│   └── PostStatus.php
├── ValueObjects/
│   └── PostId.php
├── Repositories/
│   ├── BlogPostRepositoryInterface.php
│   └── CommentRepositoryInterface.php
└── Services/
    └── PostPublishingService.php

app/Application/Blog/
├── DTOs/
│   ├── CreatePostRequest.php
│   └── PublishPostRequest.php
└── UseCases/
    ├── CreatePostUseCase.php
    ├── PublishPostUseCase.php
    └── ArchivePostUseCase.php

app/Infrastructure/Blog/
├── Eloquent/
│   ├── EloquentPost.php
│   ├── EloquentComment.php
│   ├── EloquentBlogPostRepository.php
│   └── EloquentCommentRepository.php

app/Http/Controllers/Api/V1/
├── BlogPostController.php
└── CommentController.php

tests/Feature/Blog/
├── CreatePostTest.php
├── PublishPostTest.php
├── ReadPostTest.php
└── CommentTest.php
```

## Fase 3 — Study Progress Feature (Week 2–3)

Vergelijkbare aanpak als Blog:

1. Domain: Course, Lesson, Progress, Certificate entities
2. Repositories: StudyProgressRepositoryInterface
3. Use cases: CompleteProgressUseCase, AwardCertificateUseCase
4. Infrastructure: Eloquent + repositories
5. API endpoints: progress tracking + certificate retrieval
6. Tests: ≥60% coverage

## Fase 4 — Usability Wireflows & Nielsen Heuristics (Week 3)

**Deliverable**: Volledige wireflow (Figma/Miro/Balsamiq export) met substantiatie van:
- Heuristic 1: Visibility of system status (feedback, status messages)
- Heuristic 5: Error prevention (validation, confirmations)
- Heuristic 9: Help & recovery (error messages, undo/rollback)

Aanpak:
1. Maak wireframes voor alle kritieke flows
2. Documenteer per scherm welke heuristic(s) erdoor geadresseerd worden
3. Link implementatie terug naar wireflow stappen

## Fase 5 — Security & Authorization (Week 3–4)

1. **Authentication**: Registration, login, password hashing, session hardening
2. **Authorization**: Policies per resource + ownership checks
3. **OWASP Mitigation**:
   - A01 Broken Access Control: route middleware + policies
   - A05 Injection: input validation + parameterized queries
   - A07 Authentication: brute-force throttling, session hardening

Implementatie:
- `app/Security/Policies/` - Laravel policies per model
- `app/Security/Guards/` - Custom auth guards (if needed)
- `app/Http/Middleware/` - Auth middleware
- Audit logging: `app/Models/AuditLog.php`

## Fase 6 — Testing & Coverage (Ongoing, Week 4–5)

Target: ≥60% app-level coverage

Run wekelijks:
```bash
composer run test:coverage
```

Prioriteer:
1. Domain services (90%)
2. Application use cases (85%)
3. Repositories (80%)
4. Controllers (70%)

## Fase 7 — Docker & Deployment (Week 5–6)

### Docker Milestone 1
- Single container (web + SQLite)
- Volumes for persistence
- Migration command

### Docker Milestone 2
- docker-compose.yml
- One-command startup

### Docker Milestone 3
- Separate MySQL container
- Network communication
- Repository pattern supports both SQLite & MySQL

### Production Deployment
- Choose host (PaaS/VPS/shared hosting) - WEEK 1 DECISION
- Write README release instructions
- GitHub Actions CI: PHPStan + PHPCS + Deptrac + tests

## Fase 8 — Innovation & Final Compliance (Week 6)

**Feature**: Visitor Analytics Dashboard
- API endpoint: `GET /api/v1/analytics` (visitor traffic, referrers, top pages)
- Frontend page: fetch()-driven rendering
- User story + technical design

**Easter Egg**: Include Marilyn Monroe reference in wiki (required by assignment)

## Weekly Verification Checklist

Every Friday 5pm:

- [ ] PHPStan level 8: `composer run analyse`
- [ ] PHPCS PSR-12: `composer run lint`
- [ ] Deptrac: `composer run arch`
- [ ] Tests + coverage: `composer run test:coverage`
- [ ] All rubric stories have code evidence
- [ ] Wiki updated with latest design decisions
- [ ] GitHub Actions CI all green
- [ ] Deployment runbook updated

## Assignment Deadline

**8 Juni 2026** — Final submission + presentation rehearsal week

Backup plan: If 60% coverage not achievable, focus on most critical contexts (Blog + Bio); defer study progress if necessary.

## Quick Commands

```bash
# Local setup
composer install
php artisan migrate
php artisan serve

# Quality checks
composer run quality    # All checks
composer run analyse    # PHPStan only
composer run lint       # PHPCS only
composer run arch       # Deptrac only

# Testing
composer test           # Run all tests
composer run test:coverage  # With coverage report

# Database
php artisan migrate:fresh  # Reset + migrate
php artisan tinker      # REPL

# Code generation (use as needed)
php artisan make:model Blog/Post --migration
php artisan make:controller Api/V1/PostController
php artisan make:request StorePostRequest
```

## Resources

- [Architecture Decision Record](ARCHITECTURE.md)
- [User Story Template](USER_STORY_TEMPLATE.md)
- [README](../README.md)
- Laravel Docs: https://laravel.com/docs/12
- PSR-12: https://www.php-fig.org/psr/psr-12/
