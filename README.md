# Typecho插件:根据时间自动切换主题

### 修改自:https://plugins.typecho.me/firstblood/plugins/theme-switcher.html

因为上面那个插件的原链接已经找不到了,之前这个插件是**根据设备来进行主题的切换**的,我也没学过php,比着稍微修改了一下代码,改成了根据时间来自动切换主题

## 使用方法

1. 下载后解压，将解压后的目录名改为 ThemeSwitcher
2. 上传到你的 Typecho 的 `/usr/plugins`，并在 Typecho 后台开启插件

```php
public static function switchTheme()
    {
        Typecho_Widget::widget('Widget_Options')->to($options); 
        date_default_timezone_set('PRC'); //设定时区，PRC就是天朝    
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

