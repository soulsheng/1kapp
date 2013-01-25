<?php	
/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-include/qa-lang-admin.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Language phrases for admin center
	
	--------------Translate to chiness-------------
	Author: tomheng 
	Created: 2012-02-07
	Blog: http://blog.webfuns.net
	Git: git@github.com:tomheng/Question2Answer_zh.git
	------------------------------------------------	

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

	return array(
		'active_widgets_explanation' => '正在使用的工具:',
		'add_category_button' => '添加分类',
		'add_field_button' => '添加字段',
		'add_link_button' => '添加链接',
		'add_link_link' => ' - ^1添加链接^2',
		'add_new_field' => '添加新字段',
		'add_new_title' => '添加新头衔',
		'add_page_button' => '添加页面',
		'add_title_button' => '添加标题',
		'add_widget_button' => '添加工具',
		'add_widget_link' => ' - ^1添加工具^2',
		'admin_title' => '管理中心',
		'after_footer' => '页脚链接之后',
		'after_main_menu' => '顶部所有选项卡之后',
		'after_x_tab' => '"^" 选项卡之后',
		'after_x' => '"^"之后',
		'moderate_title' => '审核',
		'basic_editor' => '初级编辑',
		'before_main_menu' => '顶部所有选项卡之前',
		'block_ips_note' => '用-表示范围，*表示任意数字。 示例: 192.168.0.4 , 192.168.0.0-192.168.0.31 , 192.168.0.*',
		'block_words_note' => '用*匹配任意字母。示例: doh (仅匹配单词 doh) , doh* (匹配 doh 或者dohno) , do*h (匹配 doh, dooh, dough)。',
		'cancel_mailing_button' => '取消邮件发送',
		'categories_introduction' => '使用分类, 点击 \'添加分类\' 按钮。',
		'categories_not_shown' => '隐藏分类的问题不会被显示。',
		'categories_title' => '分类',
		'categories' => '分类',
		'category_add_sub' => '添加子分类',
		'category_added' => '已经添加的分类',
		'category_already_used' => '已经被使用',
		'category_default_slug' => 'category-^',
		'category_description' => '可添加分类描述:',
		'category_max_depth_x' => '分类层次不能超过 ^ 层。',
		'category_move_parent' => '修改父级分类',
		'category_name_first' => '第一个分类名称:',
		'category_name' => '分类名称:',
		'category_no_add_subs_x' => '分类层次超过 ^ 层无法添加子分类。',
		'category_no_delete_subs' => '存在子分类无法删除',
		'category_no_sub_error' => '^q 问题没有设置子分类  - ^1设置子分类^2',
		'category_no_sub_to' => '移动没有子分类的问题 ^ 到 :',
		'category_no_subs' => '空',
		'category_none_error' => '^q 问题没有分类 - ^1设置分类^2',
		'category_none_to' => '移动未分类的问题到:',
		'category_parent' => '父级分类:',
		'category_saved' => '保存分类',
		'category_slug' => '分类别名（出现在链接中）:',
		'category_subs' => '子分类:',
		'category_top_level' => '无父级分类 (顶级)',
		'characters' => '字符',
		'check_language_suffix' => ' - ^1检查语言文件^2',
		'click_name_edit' => '自定义页面或链接:',
		'database_cleanup' => '清理数据库',
		'delete_category_reassign' => '删除该分类，并将该分类下所有问题转移至:',
		'delete_category' => '删除此分类',
		'delete_field' => '删除此字段',
		'delete_hidden_complete' => '所有隐藏的，并且没有关联的内容已被删除',
		'delete_hidden_note' => ' - 删除所有没有关联的隐藏问题、隐藏回复和隐藏评论',
		'delete_hidden' => '删除隐藏内容',
		'delete_link' => '删除此链接',
		'delete_page' => '删除此页面',
		'delete_stop' => '停止删除',
		'delete_title' => '删除该头衔',
		'delete_widget_position' => '删除在这的这个工具',
		'edit_custom_page' => '编辑自定义页面',
		'edit_field' => ' - ^1编辑字段^2',
		'edit_link' => ' - ^1编辑链接^2',
		'edit_page' => ' - ^1编辑页面^2',
		'edit_title' => ' - ^1编辑标题^2',
		'emails_per_minute' => '邮件发送频率',
		'emails_title' => '邮件',
		'feed_link_example' => '示例feed',
		'feed_link' => 'Feed',
		'feeds_title' => 'RSS订阅',
		'field_link_url' => '链接地址',
		'field_multi_line' => '多行文本',
		'field_name' => '字段名:',
		'field_single_line' => '单行文本',
		'field_type' => '字段类型:',
		'first' => '第一个',
		'flagged_title' => '举报',
		'from_anon' => '来自匿名用户:',
		'from_users' => '来自用户:',
		'general_title' => '基本设置',
		'hidden_answers_deleted' => '已删除^1 条，共 ^2 条隐藏回复...',
		'hidden_comments_deleted' => '已删除^1条，共 ^2 条隐藏评论...',
		'hidden_questions_deleted' => '已删除^1条，共 ^2 条无关连的隐藏提问...',
		'hotness_factors' => '问题热度评分:',
		'hidden_title' => '隐藏',
		'installed_plugins' => '已安装的插件:',
		'ip_address_pages' => 'IP 地址页面',
		'layout_title' => '布局',
		'link_name' => '链接文本:',
		'link_new_window' => '新窗口打开链接',
		'link_url' => '链接- 绝对地址或者相对根目录的地址:',
		'lists_title' => '列表',
		'mailing_complete' => '邮件已发送',
		'mailing_