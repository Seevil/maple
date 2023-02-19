<?php
/**
 * Maple 一款简约而不简单的主题 
 * HEXO主题同名主题hexo-theme-maple移植。
 * 
 * @package Maple Theme
 * @author Xingr
 * @version 1.0.0
 * @link https://www.krsay.com/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
$sticky = $this->options->sticky; 
if($sticky && $this->is('index') || $this->is('front')){
    $sticky_cids = explode(',', strtr($sticky, ' ', ','));
    $sticky_html = "<span>[置顶] </span>";
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order('', "(case cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序
    if (($this->_currentPage || $this->currentPage) == 1) foreach($db->fetchAll($select1) as $sticky_post){ //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
    if($this->user->hasLogin()){
    $uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?', $uid, 'private');
    }
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
}
?>
        <main class="p-12">
            <section class="px-6 max-w-prose mx-auto gap-12 grid grid-cols-1">
                <div class="flex flex-col h-48 items-center justify-center">
                    <h1 class="site-title text-4xl leading-relaxed"><?php $this->options->title(); ?></h1>
                    <p class="text-gray-500 mt-2"><?php $this->options->description() ?></p>
                </div>
				<?php if ($this->is('index') ): ?>
                <div class="relative pointer-events-none">
				<?php $this->widget('Widget_Contents_Post_Recent','pageSize=1')->parse('<span class="text-9xl opacity-10 absolute -left-11 -top-6 font-bold">{year}</span>');?>
                </div>
				<?php endif; ?>
				<?php while($this->next()): ?>
                <a href="<?php $this->permalink() ?>">
                    <header>
                        <h2 class="font-bold text-xl"><?php $this->title();$this->sticky(38,'...') ?></h2>
                    </header>
                    <section class="text-gray-400 my-1 text-sm time">
                        <p class="line-clamp-4"></p>
                        <p class="line-clamp-4"><?php $this->date('M.d '); ?> · <?php echo t_ago($this->created);?></p>
                    </section>
                </a>
					<?php endwhile; ?>
            </section>
			
        </main>
<?php $this->need('footer.php'); ?>
