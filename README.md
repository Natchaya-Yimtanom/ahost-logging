# Lumen Log Viewer 
Save log file and store log data in database , along with Log Viewer view which can access directly through package's route.

# Installation
- ใช้คำสั่ง compoer require ใน terminal เพื่อติดตั้ง package
```
composer require ahost/logging
```

- เพิ่ม Service Provider ในไฟล์ `bootstrap/app.php` ในส่วนของ `providers` 
```
$app->register(Ahost\Logging\LoggingServiceProvider::class);
```

- เปิดคอมเม้นท์ `withFacades()` และ `withEloquent()` ในไฟล์ `bootstrap/app.php`
```
$app->withFacades();
$app->withEloquent();
```
- รันคำสั่ง custom command ของ package เพื่อทำการตั้งค่าไฟล์ต่างๆโดยอัตโนมัติ ดังนี้
```
php artisan logging:activate
```

# Usage
- เพิ่มคำสั่ง `use Ahost\Logging\BaseLogger;` ในไฟล์ controller ที่ต้องการใช้งานฟังก์ชันของ package
- Create variable which inherit BaseLogger function, for example:
- สร้าง variable ที่สืบทอดฟังก์ชันของ class baselogger ในไฟล์ controller ที่ต้องการ ยกตัวอย่างเช่น
```
protected $baselogger;

    public function __construct(BaseLogger $baselogger){
        $this->baselogger = $baselogger;
    }
```
- Call function `init()` from BaseLogger inherited variable (Which will set log file's path)
- เรียกใช้ฟังก์ชัน init() ผ่าน variable ที่สืบทอด class baselogger (เพื่อทำการตั้งค่า path ของ log file)
```
$this->baselogger->init();
```
- Call log function through variable where log message is require, for example:
- เรียกใช้ฟังก์ชันของ baselogger ผ่าน variable ในส่วนที่ต้องการเก็บข้อความ log ยกตัวอย่างเช่น
```
$this->baselogger->info('Information Log Message');
```
- You can go to `http://.../log/view` for simple Log Viewer
- สามารถเข้าดูหน้า Log Viewer ได้ผ่าน `http://.../log/view`
