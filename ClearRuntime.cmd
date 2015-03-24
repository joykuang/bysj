@echo off
cd
cls
if exist "F:\XAMPP\htdocs\_Yueruan\Runtime" (
    rd /s /q  "F:\XAMPP\htdocs\_Yueruan\Runtime" && echo 缓存清除成功！
) else (
    echo 未找到缓存文件（夹），无需清理！
）

