# GuildQuality Surveys

A Laravel application for managing surveys and questions.

## Setup Instructions

1. Clone the repository
```bash
git clone https://github.com/edwinhnandez/guildquality-surveys
cd guildquality-surveys
```

2. Install PHP dependencies
```bash
composer install
```

3. Copy environment file and generate key
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:
```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=guildquality_surveys
DB_USERNAME=root
DB_PASSWORD=
```

5. Create database
```bash
mysql -u root -p
CREATE DATABASE guildquality_surveys;
```

6. Run migrations and seeders
```bash
php artisan migrate --seed
```

7. Start the development server
```bash
php artisan serve
```

## Testing

Run the test suite:
```bash
php artisan test
```

Run specific tests:
```bash
php artisan test --filter=SurveyFeatureTest
```

## Environment Requirements

- PHP 8.1+
- MariaDB 10.5+
- Composer
- Node.js & NPM

##  Database design

IDs: use BIGINT UNSIGNED for all PKs. (1 billion fits in INT UNSIGNED, but BIGINT keeps headroom for growth.)

Naming: keep columns short; add composite PK/unique where it helps.

Pivot table: survey_question with composite PK (survey_id, question_id); add a secondary index on (question_id, survey_id) for reverse lookups.

Engine/charset: InnoDB, utf8mb4.

Partitioning (optional, advanced): If you truly expect ultra-high scale now, you can partition survey_question by HASH(survey_id) in MySQL. Laravel migrations can issue raw SQL for partitioning (see note in migration). We’ll keep it optional and discuss it during the interview (as the exercise suggests DB optimization will be reviewed). 