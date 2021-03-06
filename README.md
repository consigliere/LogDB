# Log data into database for laravel

The logger provides the eight logging levels defined in RFC 5424: emergency, alert, critical, error, warning, notice, info and debug. Passing message into event and It will automatically detect request url, request method, client ip, browser, user os etc and save it into database. In event it failed it will simply log data into storage log. 

## Install

```bash
composer require consigliere/logdb
```

### Add into service provider array in ./config/app.php

```php
'providers' => [
        // ...
        App\Components\LogDB\Providers\LogDBServiceProvider::class,
        // ...
    ],
```

## Migration

```bash
php artisan migrate
```

## Publish config

```bash
php artisan vendor:publish --tag=config-logdb
```

## Fire events basic

### Emergency
```php
\Event::fire('event.emergency', [['message' => $message]]);
```

### Alert
```php
\Event::fire('event.alert', [['message' => $message]]);
```

### Critical
```php
\Event::fire('event.critical', [['message' => $message]]);
```

### Error
```php
\Event::fire('event.error', [['message' => $param['e']->getMessage()]]); // use try - catch to get error message
```

### Warning
```php
\Event::fire('event.warning', [['message' => $message]]);
```

### Notice
```php
\Event::fire('event.notice', [['message' => $message]]);
```

### Info
```php
\Event::fire('event.info', [['message' => $message]]);
```

### Debug
```php
\Event::fire('event.debug', [['message' => $message]]);
```

## Fire events using default config example
Event should be wrapped in an configuration array, example of firing events using default package config.

### Emergency
```php
if ((config('logdb.logActivity')) && (config('logdb.emergency'))) {
    \Event::fire('event.emergency', [['message' => $message]]);
}
```

### Alert
```php
if ((config('logdb.logActivity')) && (config('logdb.alert'))) {
    \Event::fire('event.alert', [['message' => $message]]);
}
```

### Critical
```php
if ((config('logdb.logActivity')) && (config('logdb.critical'))) {
    \Event::fire('event.critical', [['message' => $message]]);
}
```

### Error
```php
if ((config('logdb.logActivity')) && (config('logdb.error'))) {
    \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
}
```

### Warning
```php
if ((config('logdb.logActivity')) && (config('logdb.warning'))) {
    \Event::fire('event.warning', [['message' => $message]]);
}
```

### Notice
```php
if ((config('logdb.logActivity')) && (config('logdb.notice'))) {
    \Event::fire('event.notice', [['message' => $message]]);
}
```

### Info
```php
if ((config('logdb.logActivity')) && (config('logdb.info'))) {
    \Event::fire('event.info', [['message' => $message]]);
}
```

### Debug
```php
if ((config('logdb.logActivity')) && (config('logdb.debug'))) {
    if (isset($param['construct'])) {
        $query      = $construct->toSql();
        $queryCount = $construct->count();

        \Event::fire('event.debug', [
            ['message' => 'Success get data from ' . $table . ' table, count records "' . $queryCount . '", with query : "' . $query . '"']
        ]);
    } else {
        \Event::fire('event.debug', [['message' => $message]]);
    }
}
```

## Fire events using wrapper 

Example in model class

```php
use App\Components\LogDB\Traits\LogDB;

class BaseModel extends Model
{
    use LogDB;

    protected $fillable = [];
}
```

Event wrapper

```php
# Emergency
$this->fireLog('emergencyOrError', $message, ['somethingElse' => $something]);

# Alert
$this->fireLog('alertOrError', $message, []);

# Critical
$this->fireLog('criticalOrError', $message);

# Error
$this->fireLog('error', $e->getMessage());

# Warning
$this->fireLog('warningOrError', $message);

# Notice
$this->fireLog('noticeOrError', $message);

# Info
$this->fireLog('infoOrError', $message);

# Debug
$this->fireLog('debugOrError', $message);
```