<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
	$github = new Typecho_Widget_Helper_Form_Element_Text('github', NULL, NULL, _t('Github主页地址'), _t('一般为https://github.com/Seevil ,留空则不设置Github地址'));
    $form->addInput($github->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$twitter = new Typecho_Widget_Helper_Form_Element_Text('twitter', NULL, NULL, _t('twitter主页地址'), _t('一般为https://twitter.com/skyurl ,留空则不设置twitter地址'));
    $form->addInput($twitter->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$zhihu = new Typecho_Widget_Helper_Form_Element_Text('zhihu', NULL, NULL, _t('zhihu主页地址'), _t('一般为https://www.zhihu.com/xxx ,留空则不设置Weibo地址'));
    $form->addInput($zhihu->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$weibo = new Typecho_Widget_Helper_Form_Element_Text('weibo', NULL, NULL, _t('Weibo主页地址'), _t('一般为http://www.weibo.com/xxx ,留空则不设置Weibo地址'));
    $form->addInput($weibo->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
	$sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL,NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔'));
    $form->addInput($sticky);
	$Emoji = new Typecho_Widget_Helper_Form_Element_Radio('Emoji',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('Emoji表情设置'), _t('默认显示Emoji表情，如果你的数据库charset配置不是utf8mb4请禁用'));
    $form->addInput($Emoji);
}

/**
 * 输出评论回复内容，配合 commentAtContent($coid)一起使用
 * <?php showCommentContent($comments->coid); ?>
 */
function showCommentContent($coid)
{
    $db = Typecho_Db::get();
    $result = $db->fetchRow($db->select('text')->from('table.comments')->where('coid = ? AND (status = ? OR status = ?)', $coid, 'approved','waiting'));
    $text = $result['text'];
    $atStr = commentAtContent($coid);
    $_content = Markdown::convert($text);
    //<p>
    if ($atStr !== '') {
        $content = substr_replace($_content, $atStr, 0, 3);
    } else {
        $content = $_content;
    }

    echo $content;
}

/**
 * 评论回复加@ 
 */
function commentAtContent($coid)
{
    $db = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ? AND (status = ? OR status = ?)', $coid, 'approved','waiting'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
            ->where('coid = ? AND (status = ? OR status = ?)', $parent, 'approved','waiting'));
        $author = $arow['author'];
        $href = '<p><a  href="#comment-' . $parent . '">@' . $author . '</a> ';
        return $href;
    } else {
        return '';
    }
}

/** 获取浏览器信息 <?php echo getBrowser($comments->agent); ?> */
function getBrowser($agent)
{ $outputer = false;
    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
        $outputer = 'IE Browser';
    } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
      $str1 = explode('Firefox/', $regs[0]);
$FireFox_vern = explode('.', $str1[1]);
        $outputer = 'Firefox Browser '. $FireFox_vern[0];
    } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
      $str1 = explode('Maxthon/', $agent);
$Maxthon_vern = explode('.', $str1[1]);
        $outputer = 'Maxthon Browser '.$Maxthon_vern[0];
    } else if (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $agent, $regs)) {
        $outputer = 'Sogo Browser';
    } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
$outputer = '360 Browser';
    } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Edge/', $regs[0]);
$Edge_vern = explode('.', $str1[1]);
        $outputer = 'Edge '.$Edge_vern[0];
    } else if (preg_match('/EdgiOS([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('EdgiOS/', $regs[0]);
        $outputer = 'Edge';
    } else if (preg_match('/UC/i', $agent)) {
              $str1 = explode('rowser/',  $agent);
$UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser '.$UCBrowser_vern[0];
    }else if (preg_match('/OPR/i', $agent)) {
              $str1 = explode('OPR/',  $agent);
$opr_vern = explode('.', $str1[1]);
        $outputer = 'Open Browser '.$opr_vern[0];
    } else if (preg_match('/MicroMesseng/i', $agent, $regs)) {
        $outputer = 'Weixin Browser';
    }  else if (preg_match('/WeiBo/i', $agent, $regs)) {
        $outputer = 'WeiBo Browser';
    }  else if (preg_match('/QQ/i', $agent, $regs)||preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
                  $str1 = explode('rowser/',  $agent);
$QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ Browser '.$QQ_vern[0];
    } else if (preg_match('/MQBHD/i', $agent, $regs)) {
                  $str1 = explode('MQBHD/',  $agent);
$QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ Browser '.$QQ_vern[0];
    } else if (preg_match('/BIDU/i', $agent, $regs)) {
        $outputer = 'Baidu Browser';
    } else if (preg_match('/LBBROWSER/i', $agent, $regs)) {
        $outputer = 'KS Browser';
    } else if (preg_match('/TheWorld/i', $agent, $regs)) {
        $outputer = 'TheWorld Browser';
    } else if (preg_match('/XiaoMi/i', $agent, $regs)) {
        $outputer = 'XiaoMi Browser';
    } else if (preg_match('/UBrowser/i', $agent, $regs)) {
              $str1 = explode('rowser/',  $agent);
$UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UCBrowser '.$UCBrowser_vern[0];
    } else if (preg_match('/mailapp/i', $agent, $regs)) {
        $outputer = 'Email Browser';
    } else if (preg_match('/2345Explorer/i', $agent, $regs)) {
        $outputer = '2345 Browser';
    } else if (preg_match('/Sleipnir/i', $agent, $regs)) {
        $outputer = 'Sleipnir Browser';
    } else if (preg_match('/YaBrowser/i', $agent, $regs)) {
        $outputer = 'Yandex Browser';
    }  else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
        $outputer = 'Opera Browser';
    } else if (preg_match('/MZBrowser/i', $agent, $regs)) {
        $outputer = 'MZ Browser';
    } else if (preg_match('/VivoBrowser/i', $agent, $regs)) {
        $outputer = 'Vivo Browser';
    } else if (preg_match('/Quark/i', $agent, $regs)) {
        $outputer = 'Quark Browser';
    } else if (preg_match('/mixia/i', $agent, $regs)) {
        $outputer = 'Mixia Browser';
    }else if (preg_match('/fusion/i', $agent, $regs)) {
        $outputer = 'Fusion';
    } else if (preg_match('/CoolMarket/i', $agent, $regs)) {
        $outputer = 'CoolMarket Browser';
    } else if (preg_match('/Thunder/i', $agent, $regs)) {
        $outputer = 'Thunder Browser';
    } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
$str1 = explode('Chrome/', $agent);
$chrome_vern = explode('.', $str1[1]);
        $outputer = 'Chrome '.$chrome_vern[0];
    } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
         $str1 = explode('Version/',  $agent);
$safari_vern = explode('.', $str1[1]);
        $outputer = 'Safari '.$safari_vern[0];
    } else{
        return false;
    }
   return $outputer;
}

/** 获取操作系统信息 <?php echo getOs($comments->agent); ?>*/
function getOs($agent)
{
    $os = false;
 
    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 10.0/i', $agent)) {
            $os = 'Windows 10';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = 'Windows 7';
        } else if (preg_match('/nt 6.2/i', $agent)) {
            $os = 'Windows 8';
        } else if(preg_match('/nt 6.3/i', $agent)) {
            $os = 'Windows 8.1';
        } else if(preg_match('/nt 5.1/i', $agent)) {
            $os = 'Windows XP';
        } else if (preg_match('/nt 6.0/i', $agent)) {
            $os = 'Windows Vista';
        } else{
            $os = 'Windows 11';
        }
    } else if (preg_match('/android/i', $agent)) {
    if (preg_match('/android 11/i', $agent)) {
            $os = 'Android R';
        }
    else if (preg_match('/android 12/i', $agent)) {
            $os = 'Android 12';
        }
    else if (preg_match('/android 10/i', $agent)) {
            $os = 'Android Q';
        }
    else if (preg_match('/android 9/i', $agent)) {
            $os = 'Android P';
        }
    else if (preg_match('/android 8/i', $agent)) {
            $os = 'Android O';
        }
    else{
            $os = 'Android';
    }
    }
 else if (preg_match('/ubuntu/i', $agent)) {
        $os = 'ubuntu';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/iPhone/i', $agent)) {
        $os = 'iPhone';
    } else if (preg_match('/iPad/i', $agent)) {
        $os = 'iPad';
    } else if (preg_match('/mac/i', $agent)) {
        $os = 'OSX';
    }else if (preg_match('/cros/i', $agent)) {
        $os = 'Chrome os';
    }else {
 return false;
    }
   return $os;
}

//为文章标题添加锚点
function createCatalog($obj) {    
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count ++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h'.$obj[1].$obj[2].'><a name="cl-'.$catalog_count.'"></a>'.$obj[3].'</h'.$obj[1].'>';
    }, $obj);
    return $obj;
}

//输出文章目录容器
function getCatalog() {    
    global $catalog;
    $index = '';
    if ($catalog) {
        
        $prev_depth = '';
        $to_depth = 0;
        foreach($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>';
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                   
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i=0; $i<$to_depth2; $i++) {
                            $index .= '</li>';
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li><a href="#cl-'.$catalog_item['count'].'">'.$catalog_item['text'].'</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i=0; $i<=$to_depth; $i++) {
            $index .= '</li>';
        }
    }
    echo $index;
}

/**
* 显示下一篇
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function theNext($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created > ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_ASC)
->limit(1);
$content = $db->fetchRow($sql);
 
if ($content) {
$content = $widget->filter($content);
 $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" class="text-sm text-gray-400 hover:text-gray-500 flex justify-center">'.$content['title'].'<iconify-icon width="20" icon="ri:arrow-right-s-line" data-inline="false"></iconify-icon></a>';
echo $link;
} else {
echo $default;
}
}
 
/**
* 显示上一篇
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created < ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_DESC)
->limit(1);
$content = $db->fetchRow($sql);
if ($content) {
$content = $widget->filter($content);
 $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" class="text-sm text-gray-400 hover:text-gray-500 flex justify-center"><iconify-icon width="20" icon="ri:arrow-left-s-line" data-inline="false"></iconify-icon>'.$content['title'].'</a>';
echo $link;
} else {
echo $default;
}
}


function t_count($cid) {
    $db = Typecho_Db::get();
    $row = $db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = $row['text'];
    $text = mb_convert_encoding($text, 'UTF-8', 'auto');
    $text = str_replace('/(&nbsp;|\s|\r\n|\n|\r)+/u', '', $text);
    $text = preg_replace('/[^\x{4e00}-\x{9fa5}]/u', '', $text);
    $count = mb_strlen($text, 'UTF-8');
    return $count;
}


function t_ago($v) {
	$t = time() - $v;
    if ($t < 60) {
        return $t . ' seconds ago';
    } elseif ($t < 3600) {
        return floor($t / 60) .' minutes ago';
    } elseif ($t < 86400) {
        return floor($t / 3670) .' hours ago';
    } elseif ($t < 604800) {
        return floor($t / 86400) .' days ago';
    } elseif ($t < 2419200) {
        return floor($t / 604800) .' weeks ago';
    } elseif ($t < 31536000 ) {
        return floor($t / 2592000 ).' months ago';
    } 
    return floor($t / 31536000 ).' years ago';
}