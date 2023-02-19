<?php 
/**
* 标签列表
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="p-12">
            <div class="px-6 max-w-prose mx-auto md:px-0 mt-6">
                <h2 class="font-bold text-2xl">Categories</h2>
                <ul class="mt-2">
				<?php Typecho_Widget::widget('Widget_Metas_Tag_Cloud')->to($tags); ?>
				<?php if($tags->have()): ?>
    <?php while($tags->next()): ?>
    <li class="mt-2">
       <a href="<?php $tags->permalink();?>"><?php $tags->name(); ?></a>
                        <span>(<?php echo $tags->count; ?>)</span>
                    </li>
                   <?php endwhile;?>
				   <?php endif; ?>
                </ul>
            </div>
        </main>

<?php $this->need('footer.php'); ?>
