# calendar
1. Для установки пакета выполняем команду 

```bash 
  composer require albinamkh/calendar-bundle:dev-main
```

2. В файл  `config/packages/doctrine_migrations.yaml`  в секцию `migrations_paths` добавляем строку
```yaml
  'albinamkh\CalendarBundle\DoctrineMigrations' : '%kernel.project_dir%/vendor/albinamkh/calendar-bundle/migrations'
```
3.Выполняем команду 

```bash
 php bin/console doctrine:migration:migrate
```