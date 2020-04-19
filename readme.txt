1）该单点登陆使用到了curl，在window系统下因为php-fpm无法多进程，所以curl请求会异常。
所以可以通过cmd-》执行
D:\phpStudy\php\php-5.6.27-nts\php-cgi.exe -b 127.0.0.1:9001 -c D:\phpStudy\php\php-5.6.27-nts\php.ini 
打开多个进程实现

2）附带host配置和nginx虚拟主机配置

127.0.0.1 www.a.com
127.0.0.1 www.b.com
127.0.0.1 www.sso.com

server {
      server_name www.sso.com;
      listen 80 ;
        root D:\phpStudy\WWW\sso;
        index index.html index.htm index.php;
        
        
      location ~ \.php(/|$) {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        include        fastcgi.conf;
        set $fastcgi_script_name2 $fastcgi_script_name;
        if ($fastcgi_script_name ~ "^(.+\.php)(/.+)$") {
            set $fastcgi_script_name2 $1;
            set $path_info $2;
        }
        fastcgi_param   PATH_INFO $path_info;
        fastcgi_param   SCRIPT_FILENAME   $document_root$fastcgi_script_name2;
        fastcgi_param   SCRIPT_NAME   $fastcgi_script_name2;
    }
}

server {
      server_name www.a.com;
      listen 80 ;
        root D:\phpStudy\WWW\asite;
        index index.html index.htm index.php;
        
        
      location ~ \.php(/|$) {
        fastcgi_pass   127.0.0.1:9001;
        fastcgi_index  index.php;
        include        fastcgi.conf;
        set $fastcgi_script_name2 $fastcgi_script_name;
        if ($fastcgi_script_name ~ "^(.+\.php)(/.+)$") {
            set $fastcgi_script_name2 $1;
            set $path_info $2;
        }
        fastcgi_param   PATH_INFO $path_info;
        fastcgi_param   SCRIPT_FILENAME   $document_root$fastcgi_script_name2;
        fastcgi_param   SCRIPT_NAME   $fastcgi_script_name2;
    }
}

server {
      server_name www.b.com;
      listen 80 ;
        root D:\phpStudy\WWW\bsite;
        index index.html index.htm index.php;
        
        
      location ~ \.php(/|$) {
        fastcgi_pass   127.0.0.1:9002;
        fastcgi_index  index.php;
        include        fastcgi.conf;
        set $fastcgi_script_name2 $fastcgi_script_name;
        if ($fastcgi_script_name ~ "^(.+\.php)(/.+)$") {
            set $fastcgi_script_name2 $1;
            set $path_info $2;
        }
        fastcgi_param   PATH_INFO $path_info;
        fastcgi_param   SCRIPT_FILENAME   $document_root$fastcgi_script_name2;
        fastcgi_param   SCRIPT_NAME   $fastcgi_script_name2;
    }
}

