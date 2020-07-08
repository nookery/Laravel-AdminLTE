# Laravel-AdminLTE
 Easy AdminLTE integration with Laravel


## 部署
### 配置缓存

往生产环境部署应用时，为了将所有的配置文件缓存到单个文件中，让框架快速加载这个文件，执行以下 Artisan 命令：

`php artisan config:cache`

Artisan 命令 config:cache 会将所有的配置文件缓存到单个文件中，然后框架会快速加载这个文件。   
这个命令不应在本地开发环境下运行，因为配置选项在应用程序开发过程中是经常需要被更改的。

### 自动加载器改进

往生产环境部署应用时，为了使 Composer 可以很快的找到正确的加载文件去加载给定的类，执行以下操作：

`composer install --optimize-autoloader --no-dev`

### 优化路由加载

将所有路由注册缩减到一个缓存文件中的单个方法调用，在注册数百个路由时能提高性能，执行以下 Artisan 命令：

`php artisan route:cache`

注意：由于此功能使用 PHP 序列化，你仅能缓存专门使用基于控制器路由的应用程序路由。PHP 不能序列化闭包路由。

### 优化View加载

预编译所有的 Blade views，执行以下 Artisan 命令：

`php artisan view:cache`
