![git](https://github.com/orkhanshukurlu/laravel-git-artisan/assets/49713732/0b641ec1-7022-459d-9684-4f2c6e5fbe04)

# Laravel Git Artisan

[![Laravel 10](https://img.shields.io/badge/Laravel-10-red.svg)](http://laravel.com)
[![Latest Stable Version](https://img.shields.io/packagist/v/orkhanshukurlu/laravel-git-artisan.svg)](https://packagist.org/packages/orkhanshukurlu/laravel-git-artisan)
[![Total Downloads](http://poser.pugx.org/orkhanshukurlu/laravel-git-artisan/downloads)](https://packagist.org/packages/orkhanshukurlu/laravel-git-artisan)
[![License](http://poser.pugx.org/orkhanshukurlu/laravel-git-artisan/license)](https://packagist.org/packages/orkhanshukurlu/laravel-git-artisan)

## Quraşdırma

Composer vasitəsilə paketi quraşdırın

    composer require orkhanshukurlu/laravel-git-artisan --dev

## İstifadə

    php artisan git "commit message"

> Command run olduqda `git status` `git add .` `git commit -m "commit message"` `git pull origin master` `git push origin master` commandları ardıcıl run olacaq. Əgər hansısa bir commandda xəta baş verərsə digər commandlar icra olunmayacaq. İlkin olaraq `pull` və `push` edəcəyiniz branch `master` kimi təyin olunmuşdur

Əgər pull edəcəyiniz branch master deyilsə aşağıdakı kimi istifadə edin

    php artisan git "commit message" --pull=branch_name
    
Əgər push edəcəyiniz branch master deyilsə aşağıdakı kimi istifadə edin
 
    php artisan git "commit message" --push=branch_name
    
Əgər commandın pull etməyini istəmirsinizsə aşağıdakı kimi istifadə edin

    php artisan git "commit message" --no-pull
    
Əgər commandın push etməyini istəmirsinizsə aşağıdakı kimi istifadə edin    

    php artisan git "commit message" --no-push

### Lisenziya

Laravel Git Artisan [MIT lisenziyası](https://github.com/orkhanshukurlu/laravel-git-artisan/blob/master/LICENSE.md) altında buraxılıb

### Əlaqə

Telegram: [Orxan Şükürlü](https://t.me/orkhanshukurlu/)
