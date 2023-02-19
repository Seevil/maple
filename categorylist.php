<?php 
/**
* 分类列表
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
				<?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
    <?php while($categories->next()): ?>
    <li class="mt-2">
                        <a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a>
                        <span>(<?php echo $categories->count; ?>)</span>
                    </li>
                   <?php endwhile;?>
                </ul>
            </div>
        </main>
<?php $this->need('footer.php'); ?>
