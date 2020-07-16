# Typecho插件:根据时间自动切换主题

## 修改自:https://plugins.typecho.me/firstblood/plugins/theme-switcher.html


因为上面那个插件的原链接已经找不到了,之前这个插件是**根据设备来进行主题的切换**的,我也没学过php,比着稍微修改了一下代码,改成了根据时间来自动切换主题

## 使用方法

1. 下载后解压，将解压后的目录名改为 ThemeSwitcher
2. 上传到你的 Typecho 的 `/usr/plugins`，并在 Typecho 后台开启插件

### 根据时间自动切换主题 可以更改下面这段代码自行设置

```php
public static function switchTheme()
    {
        Typecho_Widget::widget('Widget_Options')->to($options); 
        date_default_timezone_set('PRC'); //设定时区，PRC Primary Reference Clock 基准参bai考时钟（主参考时钟）我国的数字同步网采用主从同步方式，即北京建立基准时钟（PRC）  
        $hour = date('H');
        //根据时间切换主题 可以自己根据需要进行修改
        if ($hour <= 18 && $hour > 6) {
            $options->theme=$options->plugin('ThemeSwitcher')->day;
            return;
        }
        else{
            $options->theme=$options->plugin('ThemeSwitcher')->night;
            return;
        }
    }
```



博客地址:[raindecloud](http://raindecloud.top)

之前没使用过Typecho 使用的是wordpress 搞来搞去弄的很臃肿,打开慢的一B...所以直接重新搭建了. 

因为比较喜欢ios13黑色主题  但是目前还没能力自己搞定在一个主题下切换颜色,所以就忽然想到试一下自动切换主题试试.搞了一会就改出来个这样的小东西 可能对部分人能有帮助
