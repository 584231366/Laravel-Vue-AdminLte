## 介绍
- 基于laravel5.8+vuejs+adminlte构建的后台管理系统

## 安装
- composer install
- php artisan migrate
- php artisan db:seed
- npm install (linux) | npm install --no-bin-links (windows)
- npm install cross-env (如果npm run dev 无法执行的话)

## 集成项
- passport: https://laravelacademy.org/post/19485.html
- 图片验证码: https://blog.csdn.net/Eric_Alive/article/details/83274143
- 二维码: https://laravelacademy.org/post/2605.html
- 图片处理: 
	https://learnku.com/articles/14292/laravel-uses-interventionimage-to-process-pictures
	http://image.intervention.io/api
- 阿里云短信服务: https://github.com/flc1125/dysms

## 更新
- 1.0.0
   - 后台功能：用户管理
   - 后台功能：菜单管理
   - 后台功能：角色管理
   - 后台功能：权限组管理
- 1.0.1
   - 后台登录添加图片验证码
- 1.0.2
   - 修复bug后台页面跳转cotent-wrapper的min-height计算没有触发的问题
   - 修复bug后台页面跳转左边菜单不可点击问题
