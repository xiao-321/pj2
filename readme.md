姓名：李晓伟 学号：19302010006

PJ2的设计：
All：
       设计和配色参考了网站stockvault（https://www.stockvault.net/）
       配色以黑白灰蓝四色为主体
       所有的小图标均来自网站ICOOON MONO （https://icooon-mono.com/）

Home：
       First-screen处大图源自日本摄影师，微博上偷来的图
       设计参照b站首页 分为 header、first-screen、storey-box、footer
       在助教设计页面参考的基础上，在storey-box的下方增加了一栏“Discover more”用户点击可直接跳转到search页面

​		补全了description溢出的情况.....pj1这一部分忘记写了	

​		用户在未登陆情况下 只能访问details home browse 和 search页面

Browse：
       分为 header、browse-container、footer
       Browse-container又分为search-bar（左侧）和filter（右侧）
       部分元素：hover时变为蓝色
       在未进行browse时显示No uploaded photos. Go to the Upload page to upload some!

​		筛选后输出结果，若没有图片时也显示No uploaded photos. Go to the Upload page to upload some!

​		超过五页图片时 页码部分显示previous 12345......next 

Search：
       参考了助教给的设计页面
       分为header、search-container、footer
       Search-container又分为search-bar（上半部分）和search-result（下半部分）
       与browse类似未进行search或 搜索无结果 显示No search result. Go to the Upload page to upload some by yourself!

​		页码部分同browse

Upload：
       参考了助教给的设计页面
       分为header、form upload-bar、footer
       Form upload-bar内upload-container分为upload-photo和upload-detail

​		若从my——photo页面跳转过来则显示Modify 其他页面显示upload 

​		页码部分同browse

My favour&My photo（两个差不多 ，放在一起说）：
       左侧添加了分类（假的），点击弹出alert（没来得及继续做完）
       右侧图片展示部分 点击图片或者标题都可以跳转到details页面
       以favour为例 分为header、favour-container、footer
       Favour-container又分为favourite-category（左侧）和storey-box（右侧）

​		页码部分同browse

​		upload和modify处有一个小bug city和country好像上传和修改不了......

Sign_in&Register（两个差不多 ，放在一起说）：
      参考了助教的设计页面
      Index页面通过“Create a new account”跳转到Register页面
      以index为例 分为header、contents、footer

Detail:
      参考了pixiv（https://www.pixiv.net/）和stockvault的图片页详情
      左侧从上到下依次为图片、喜欢/添加到收藏（图标）、图片标题、图片描述
      右侧从上到下依次为作者名&作品名、订阅作者（弹出alert）、浏览&喜欢&收藏数（这三个里面只有收藏数是真的，浏览&喜欢未想好如何实现）、作品详情
      分为header、details-container、footer
      Details-container又分为photo（左侧）和info（右侧）两大部分

Bonus：
      就.....就这样吧555

PJ2：

pj2好难.................感觉时间比较紧 lab做到比较后面才有思路开始着手做 时间很紧张

在注册和登录界面setcookie时未设置路径 找不出来bug 但后来发现放到一个目录下就可以 之后在发现原因的时候 再改动实在是太多了...时间有点来不及导致文件比较乱 出大问题

