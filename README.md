# ZhaketGuard
کتابخانه گارد ژاکت (لایسنس گذاری بر روی محصولات)

<a href="https://scrutinizer-ci.com/g/farhadhp/zhaket-guard"><img src="https://img.shields.io/scrutinizer/g/farhadhp/zhaket-guard.svg?style=round-square" alt="Quality Score"></img></a>
[![code coverage](https://codecov.io/gh/farhadhp/zhaket-guard/branch/master/graph/badge.svg)](https://codecov.io/gh/farhadhp/zhaket-guard)
[![Build Status](https://travis-ci.org/farhadhp/zhaket-guard.svg?branch=master)](https://travis-ci.org/farhadhp/zhaket-guard)
[![Latest Stable Version](https://poser.pugx.org/farhadhp/zhaket-guard/v/stable)](https://packagist.org/packages/farhadhp/zhaket-guard)
[![Daily Downloads](https://poser.pugx.org/farhadhp/zhaket-guard/d/daily)](https://packagist.org/packages/farhadhp/zhaket-guard)
[![Total Downloads](https://poser.pugx.org/farhadhp/zhaket-guard/downloads)](https://packagist.org/packages/farhadhp/zhaket-guard)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=round-square)](LICENSE.md)



## معرفی کتابخانه 
توسط این کتابخانه می‌توانید به راحتی سیستم لایسنس گارد ژاکت را به محصولات وردپرسی خود (قالب و افزونه) اضافه کنید.

## آموزش نصب 
برای نصب این کتابخانه کافیه به پوشه اصلی قالب یا افزونه خود بروید و توسط کامپوز و با دستور زیر این کتابخانه را نصب کنید.

```
composer require farhadhp/zhaket-guard
```

## آموزش استفاده 
در ابتدا باید فایل autoload کامپوزر رو به ابتدای کدهای خود اضافه کنید.

```
require_once 'vendor/autoload.php';
```

سپس با فراخوانی کتابخانه ZhaketGuard توسط کد زیر می‌توانید به متدهای آن دسترسی داشته باشید. توجه داشته باشید که این کلاس از نوع static می‌باشد و نیازی به ساخت آبجکت از روی آن ندارید.
 
```
use Farhadhp\ZhaketGuard\ZhaketGuard;
```

### نصب لایسنس
بعد از نصب افزونه یا قالب توسط کاربر می‌بایست در ابتدا لایسنس را از کاربر دریافت نمایید. این کار را می‌توانید در صفحه تنظیمات افزونه یا قالب انجام دهید.

پس از دریافت لایسنس از کاربر می‌توانید توسط کد زیر فرایند نصب لایسنس را انجام دهید:

```
$productToken = 'f2352e4a-4545-4c86-8790-454545'; // توکن محصول شما
$license = 'f2352e4a-82c8-4c86-8790-23234323'; // لایسنس وارد شده توسط کاربر

$res = ZhaketGuard::installLicense($productToken, $license);

if ($res->status=='successful') {
    // Lisence successfuly installed
    echo $res->message;
} else {
    // License not installed / show message
    if (!is_object($res->message)) {
        echo $res->message;
    } else {
        foreach ($res->message as $message) {
            foreach ($message as $msg) {
                echo $msg.'<br>';
            }
        }
    }
}
```
بهتر است در صورت موفقیت آمیز بودن، لایسنس کاربر را نیز در دیتابیس ذخیره کنید. و برای بررسی مجدد لایسنس در دسترس داشته باشید.

### بررسی معتبر بودن لایسنس 

برای بررسی معتبر بودن لایسنس می‌توانید از متد isValidLicense بصورت زیر استفاده کنید.

```
$license = 'f2352e4a-82c8-4c86-8790-23234323'; // لایسنس وارد شده توسط کاربر

$res = ZhaketGuard::isValidLicense($license);

if ($res->status=='successful') {
    // Lisence is valid
    echo $res->message;
} else {
    // License not valid
    // show errors
    if (!is_object($res->message)) {
        echo $res->message;
    } else {
        foreach ($res->message as $message) {
            foreach ($message as $msg) {
                echo $msg.'<br>';
            }
        }
    }
}
```
توسط متد مذکور می‌توانید فرایند بررسی لایسنس را در بازه‌های زمانی یا موارد دلخواه بررسی کنید. بهتره که توسط schedule وردپرس این فرایند را در بازه زمانی هر 24 ساعت بررسی کنید.





