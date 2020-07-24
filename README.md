# Laravel-AdminLTE
 Easy AdminLTE integration with Laravel


## 使用

如果你是本项目的开发者，请按以下流程开始：
- 以合理的方式克隆本项目的代码
- 安装组件：
    ```$xslt
    composer install
    ```
- 配置 `.env` 文件
- 启动 `HTTP SERVER` （切记仅在开发环境使用）：
    ```$xslt
    php artian serve
    ```
- 如遇到疑似缓存导致的问题，请首先执行这个 `Artisan` 命令：
    ```bash
    php artisan optimize:clear
    ```
  
- 在提交代码前，务必进行一轮单元测试：
    ```bash
    php artisan test
    ```

## 部署
### 配置缓存

往预览环境或生产环境部署应用时，为了将所有的配置文件缓存到单个文件中，让框架快速加载这个文件，执行以下 `Artisan` 命令：

`php artisan config:cache`
  
这个命令不应在开发环境下运行，因为配置选项在开发过程中是经常被更改的。

注意：确保只从配置文件内部调用 `env` 函数，一旦配置被缓存，`.env` 文件将不再被加载，所有对 `env` 函数的调用都将返回 null。

### 自动加载器改进

往预览环境或生产环境部署应用时，为了使 `Composer` 可以快速找到正确的加载文件去加载给定的类，执行以下操作：

`composer install --optimize-autoloader --no-dev`

### 优化路由加载

将所有路由注册缩减到一个缓存文件中的单个方法调用能提高性能，执行以下 `Artisan` 命令：

`php artisan route:cache`

注意：由于此功能使用 `PHP` 序列化，你仅能缓存专门使用基于控制器路由的应用程序路由。`PHP` 不能序列化闭包路由。

### 优化View加载

预编译所有的 `Blade views`，执行以下 `Artisan` 命令：

`php artisan view:cache`

### `Nginx` 配置

参考代码：
```$xslt
server {
    listen 80;
    server_name example.com;
    root /example.com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```
