<?php
/**
 * 基于<a href="https://github.com/imsun/gitment">Gitment</a>开发的评论/留言系统。
 *
 * @package Gitment4typecho
 * @author Taskeren
 * @version 1.2
 * @license WTFPL
 * @link https://gitment.targ.top
 */
class Gitment4typecho_Plugin implements Typecho_Plugin_Interface
{

    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array(
            'Gitment4typecho_Plugin',
            'style'
        );
        Typecho_Plugin::factory('Widget_Archive')->footer = array(
            'Gitment4typecho_Plugin',
            'render'
        );
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {}

    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $id = new Typecho_Widget_Helper_Form_Element_Text('id', NULL, NULL, _t('id'), _t('页面ID。默认为 location.href'));
        $owner = new Typecho_Widget_Helper_Form_Element_Text('owner', NULL, NULL, _t('owner'), _t('您的 GitHub id'));
        $repo = new Typecho_Widget_Helper_Form_Element_Text('repo', NULL, NULL, _t('repo'), _t('存储评论的项目名称'));
        $client_id = new Typecho_Widget_Helper_Form_Element_Text('cid', NULL, NULL, _t('client id'), _t('您的 client id'));
        $client_secret = new Typecho_Widget_Helper_Form_Element_Text('cse', NULL, NULL, _t('client secret'), _t('您的 client secret'));
        $comment_element = new Typecho_Widget_Helper_Form_Element_Text('ce', NULL, NULL, _t('原评论元素'), _t('您的 评论 元素（JQuery选择器）。用于清除原评论系统'));
        $comment_element2 = new Typecho_Widget_Helper_Form_Element_Text('ce2', NULL, NULL, _t('新评论DIV元素。必须为<em>div</em>元素！'));
        
        $form->addInput($id);
        $form->addInput($owner);
        $form->addInput($repo);
        $form->addInput($client_id);
        $form->addInput($client_secret);
        $form->addInput($comment_element);
        $form->addInput($comment_element2);
    }

    public static function deactivate()
    {}

    public static function style()
    {
        echo "<!-- Gitment4typecho -->";
        echo "<link rel='stylesheet' href='https://imsun.github.io/gitment/style/default.css'>";
    }

    public static function render()
    {
        $id = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->id;
        $owner = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->owner;
        $repo = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->repo;
        $client_id = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->cid;
        $client_secret = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->cse;
        $comment_element = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->ce;
        $comment_element2 = Typecho_Widget::widget('Widget_Options')->Plugin('Gitment4typecho')->ce2;
        
        echo "<!-- Gitment for Typecho -->\n";
        
        if ($id == null || $owner == null || $repo == null || $client_id == null || $client_secret == null) {
            echo "<!-- Wrong Agreement! -->\n";
        }
        
        echo "<script src='https://imsun.github.io/gitment/dist/gitment.browser.js'></script>\n";
        if (isset($comment_element) && $comment_element != "") {
            echo "<script>$('" . $comment_element . "').html('')</script>\n";
        } else {
            echo "<script>$('#comments').html('')</script>\n";
        }
        echo "<script>";
        echo "var gitment = new Gitment({" . "id: 'location.href'," . "owner: '" . $owner . "'," . "repo: '" . $repo . "'," . "oauth: {" . "client_id: '" . $client_id . "'," . "client_secret: '" . $client_secret . "'," . "},});\n";
        if (isset($comment_element2) && $comment_element2 != "") {
            echo "gitment.render('" . $comment_element . "')";
        } else {
            echo "gitment.render('comments')";
        }
        echo "</script>";
    }
}
?>