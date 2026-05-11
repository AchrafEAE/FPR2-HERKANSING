# Architectuur — Portfolio Application

## Overzicht

De applicatie volgt een **gelaagde hexagonale architectuur** (Ports & Adapters) met strikte scheiding van concerns. Dit zorgt ervoor dat:
- Business logic onafhankelijk is van framework keuzes
- Database kan zonder grote refactoring vervangen worden (SQLite → MySQL → PostgreSQL)
- Testbaarheid maximaal is
- Dependencies eenrichtingsverkeer volgen

## Lagen

```
Presentation (HTTP/Web)
    ↓
Application (Use Cases, Orchestration)
    ↓
Domain (Business Logic, Entities)
    ↓
Infrastructure (Persistence, External Services)
```

### Domain Layer (app/Domain)

Puur bedrijfslogica zonder framework-afhankelijkheden.

- **Entities**: BlogPost, Course, Bio, User (value objects + business rules)
- **ValueObjects**: UserId, Email, ProgressPercentage
- **Repositories (Interfaces only)**: BlogPostRepositoryInterface, StudyProgressRepositoryInterface
- **Services**: ProgressCalculationService, CertificateAwardingService

**Karakteristieken:**
- Geen Laravel imports
- Geen database access
- Geen HTTP logic
- Pure PHP + interfaces

### Application Layer (app/Application)

Workflow-orkestratie en use case coordinatie.

- **DTOs**: CreateBlogPostRequest, UpdateBioRequest
- **UseCases**: CreatePostUseCase, CompleteProgressUseCase
- **Ports (Interfaces)**: AuthenticationPort, EmailNotificationPort

**Karakteristieken:**
- Orchestratie van Domain services
- Implementatie van Domain interfaces (strategieën)
- Geen direct database access

### Infrastructure Layer (app/Infrastructure)

Concrete implementaties van Domain/Application interfaces.

- **Persistence**: Eloquent implementations van repositories
- **Security**: HashingAdapter, JwtTokenProvider
- **External**: EmailAdapter

**Karakteristieken:**
- Eloquent models zijn intern (niet extern gepubliceerd)
- Nur concrete implementaties
- Framework-specifieke code centraal

### Presentation Layer (app/Http)

HTTP/Controller laag voor externe requests.

- **Controllers**: Dunne wrappers rond UseCases
- **Requests**: FormRequest validatie
- **Resources**: JSON response transformers
- **Middleware**: Auth, authorization, rate limiting

**Karakteristieken:**
- Delegatie naar Application/Domain
- Geen business logic
- Response formatting

## Bounded Contexts

De applicatie is onderverdeeld in vier onafhankelijke contexts:

### 1. Blog Context

```
Users kunnen blog posts schrijven, redigeren, publiceren en archiveren.
Comments kunnen door andere gebruikers toegevoegd en (gemodereerd) goedgekeurd worden.
```

**Entities:**
- Post (id, slug, title, content, status, published_at)
- Comment (id, post_id, content, status, approved_at)
- Tag (id, name)

**API:**
- POST /api/v1/posts (create, auth: owner|editor)
- GET /api/v1/posts (list published)
- PUT /api/v1/posts/{id} (edit, auth: owner|editor)
- DELETE /api/v1/posts/{id} (delete, auth: owner)

### 2. Study Progress Context

```
Gebruiker kan zijn studievoortgang bijhouden per course, les, en module.
Certificaten worden automatisch verleend op 100% completie per course.
```

**Entities:**
- Course (id, title, description, progress%, completed_at)
- Lesson (id, course_id, title, order, duration_hours)
- Progress (id, lesson_id, user_id, started_at, completed_at)
- Certificate (id, course_id, user_id, issued_at)

**API:**
- GET /api/v1/progress (user progress)
- PATCH /api/v1/progress/{lesson-id} (mark complete)
- GET /api/v1/certificates (user certificates)

### 3. Professional Bio Context

```
Gebruiker beheert zijn professionele profiel: headline, samenvatting,
ervaring, skills, social links.
```

**Entities:**
- Bio (id, user_id, headline, summary, location, availability)
- Experience (id, bio_id, title, company, start_date, end_date)
- Skill (id, bio_id, name, proficiency_level)
- SocialLink (id, bio_id, platform, url)

**API:**
- GET /api/v1/bio (auth: user)
- PUT /api/v1/bio (auth: user)

### 4. Visitor Context (Read-only)

```
Bezoekers zien een publieke weergave van de meest recente portfolio
van de eigenaar (bio + latest posts + certificates).
```

**API:**
- GET /api/v1/portfolio (public)

## Repository Pattern

Repositories abstraheren database access:

```php
// Domain interface
interface BlogPostRepositoryInterface
{
    public function save(BlogPost $post): void;
    public function findById(PostId $id): ?BlogPost;
    public function findPublished(): Collection;
}

// Infrastructure implementation
class EloquentBlogPostRepository implements BlogPostRepositoryInterface
{
    public function save(BlogPost $post): void
    {
        EloquentPost::query()->updateOrCreate(
            ['id' => $post->id->value],
            $post->toArray()
        );
    }
    // ...
}
```

Dit maakt het eenvoudig om van ORM te wisselen zonder domeincode aan te raken.

## Dependency Direction

```
         Presentation
               ↓
          Application
               ↓
             Domain
               ↑
          Infrastructure
```

- **Presentation depends on**: Application, Domain
- **Application depends on**: Domain
- **Domain depends on**: Nothing (zuiver)
- **Infrastructure depends on**: Domain (via interfaces)

## Configuration & Registration

Dependency injection en service registration via:
- `app/Providers/AppServiceProvider.php`: Core bindings
- `app/Providers/RepositoryServiceProvider.php`: Repository bindings (optional per context)

## Database Design

Geen cross-context foreign keys. Elke context eigent zijn tabellen.

```
users (global)
├── id (pk)
├── email
├── password
├── role
└── timestamps

bios (Professional Bio context)
├── id (pk)
├── user_id (fk, unique)
├── headline, summary, location
└── timestamps

posts (Blog context)
├── id (pk)
├── user_id (fk)
├── slug, title, content
├── status, published_at
└── timestamps

comments (Blog context)
├── id (pk)
├── post_id (fk)
├── user_id (fk)
├── content, status
└── timestamps

courses (Study Progress context)
├── id (pk)
├── title, description
└── timestamps

lessons (Study Progress context)
├── id (pk)
├── course_id (fk)
├── title, order
└── timestamps

progress (Study Progress context)
├── id (pk)
├── lesson_id (fk)
├── user_id (fk)
├── started_at, completed_at
└── timestamps

certificates (Study Progress context)
├── id (pk)
├── course_id (fk)
├── user_id (fk)
├── issued_at
└── timestamps
```

## Communication Across Contexts

Use cases kunnen elkaar aanroepen, maar via Domain interfaces:

```php
// Blog context calls Study Progress context
class PublishPostUseCase
{
    public function __construct(
        private StudyProgressNotificationPort $progressNotifier
    ) {}

    public function execute(PublishPostRequest $request): void
    {
        // ...
        $this->progressNotifier->notifyNewPost($post);
    }
}
```

Dit voorkomt tight coupling en maakt testing eenvoudiger.
