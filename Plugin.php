<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
//  原作者信息
// * @package SwitchTheme 
// * @author loftor
// * @version 1.0.0
// * @link http://loftor.com
/**
 * 主题自动根据时间切换
 * 
 * @package SwitchTheme 
 * @author rain
 * @version 1.0.0
 * @link http://raindecloud.top
 * 
 */

class ThemeSwitcher_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('index.php')->begin = array('ThemeSwitcher_Plugin', 'switchTheme');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        Typecho_Widget::widget('Widget_Options')->to($options); 
        Typecho_Widget::widget('Widget_Themes_List')->to($themes);
        $availableThemes = array();
        while($themes->next()){
            $availableThemes[$themes->name]=$themes->title;
        }


        $night =  new Typecho_Widget_Helper_Form_Element_Select(
          'night', $availableThemes, $options->theme,
          '夜晚主题', '夜晚看到的主题');
        $form->addInput($night);


        $day =  new Typecho_Widget_Helper_Form_Element_Select(
          'day', $availableThemes, $options->theme,
          '默认主题', '默认看到的主题');
        $form->addInput($day);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 切换主题
     * 
     * @access public
     * @return void
     */
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


}
