DBank使用API直链流程介绍（PHP）

1.初始化应用和权限 
  打开浏览器，输入http://login.dbank.com/loginauth.php?nsp_app=50601输入DBank账号登陆。登陆成功后，在你登陆的DBank账号中系统自动初始化直链目录："/我的网盘/我的应用/PublicFiles"文件夹，同时自动生成直链应用的APPID和APPSECRET。

2.下载安装程序nsp.zip。将zip解压拷贝到网站应用目录下。

3.修改config.php的APPID和APPSECRET。

4.将需要生成直链的文件上传到 "/我的网盘/我的应用/PublicFiles"目录中。

5.访问直链：直链地址http://{网站域名}/nsp/geturl.php?path=文件路径
  文件路径是相对路径，比如
    /我的网盘/我的应用/PublicFiles/Sunset.jpg         访问地址:http://{网站域名}/nsp/geturl.php?path=Sunset.jpg
    /我的网盘/我的应用/PublicFiles/images/Sunset.jpg  访问地址:http://{网站域名}/nsp/geturl.php?path=/images/Sunset.jpg

6.nsp.zip里面geturl.php只是最基本的直链API实现，开发者或者站长可以在此基础上做一些个性定制(如:防盗链,流量统计等)开发。
  API接口是基于标准HTTP协议实现，其它语言对接也比较容易。具体请参见open.dbank.com