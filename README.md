# Lumen Log Viewer 
Save log file and store log data in database , along with Log Viewer view which can access directly through package's route.

# Installation
Use the composer require to install package
```
composer require quinn/logging
```

Add Service Provider to `bootstrap/app.php` in `providers` section
```
$app->register(Quinn\Logging\LoggingServiceProvider::class);
```

Uncomment `withFacade()` and `withEloquent()` in `bootstrap/app.php`
```
$app->withFacades();
$app->withEloquent();
```
Run package custom command for some auto-configuration
```
php artisan logging:activate
```

# Usage
- Add `use Quinn\Logging\BaseLogger;` in controller which require log viewer
- Create variable which inherit BaseLogger function, for example:
```
protected $baselogger;

    public function __construct(BaseLogger $baselogger){
        $this->baselogger = $baselogger;
    }
```
- Call function `init()` from BaseLogger inherited variable (Which will set log file's path)
```
$this->baselogger->init();
```
