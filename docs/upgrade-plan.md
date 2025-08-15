# PHP & Laravel Upgrade Plan (From PHP 7.4 + Laravel 8 to Latest)

## 1. Scope & Goals
- Upgrade PHP 7.4 → 8.2/8.3
- Upgrade Laravel 8 → 9 → 10 → 11 (stepwise)
- Maintain zero-downtime deploys, full test coverage.

## 2. Inventory & Baseline
- Current PHP extensions, Composer deps (composer.lock audit).
- Framework features in use (queues, cache, mail, storage).
- CI/CD pipeline, environments.
- Test coverage report.

## 3. Risk Register
- Deprecated helpers (str_*/array_*), Flysystem 3 changes, Symfony 6 changes.
- Queue/schedule behaviors; auth/guard customizations; middleware changes.

## 4. Stepwise Plan
- Branch: feature/upgrade
- Introduce CI matrix for PHP 8.0/8.1/8.2
- L8 → L9:
  - Bump `laravel/framework:^9`, PHP >=8.0
  - Replace deprecated helpers with `Str::`/`Arr::`
  - Flysystem v3 adapter changes (S3/local)
- L9 → L10:
  - PHP >=8.1
  - Replace `dispatchNow()` → `dispatchSync()`
  - Remove deprecated APIs; fix typed enums/casts
- L10 → L11:
  - PHP >=8.2
  - Minimal app structure; remove unused config stubs; align RouteServiceProvider
- Composer update after each bump; fix conflicts.

## 5. Tooling
- larastan/phpstan (static analysis level ↑ gradually)
- rector (optional) for automated upgrades
- pest/phpunit for tests
- laravel/pint for style
- composer outdated / audit; roave/security-advisories

## 6. Testing Strategy
- Unit + Feature + Smoke E2E (critical paths)
- Snapshot production config to staging
- Canary deploy & rollback plan
- Observability checks

## 7. Timeline & Deliverables
- Week-by-week with checkpoints and demo criteria.

## 8. Appendix
- Links to official upgrade guides per version
