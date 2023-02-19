<?php 
/**
* 文章归档
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
	        <main class="p-12">
            <section class="px-6 max-w-prose mx-auto gap-12 grid grid-cols-1">
                <div class="flex flex-col h-48 items-center justify-center">
                    <h1 class="site-title text-4xl leading-relaxed"><?php $this->options->title(); ?></h1>
                    <p class="text-gray-500 mt-2"><?php $this->options->description() ?></p>
                </div>
				
                <div class="relative pointer-events-none">
				
                </div>
				
				<?php $this->widget('Widget_Contents_Post_Recent')->to($archives); while($archives->next()): ?>
                <a href="<?php $archives->permalink() ?>">
                    <header>
                        <h2 class="font-bold text-xl"><?php $archives->title(38,'...') ?></h2>
                    </header>
                    <section class="text-gray-400 my-1 text-sm time">
                        <p class="line-clamp-4"></p>
                        <p class="line-clamp-4"><?php $archives->date('M.d '); ?> · <?php echo t_ago($archives->created);?></p>
                    </section>
                </a>
					<?php endwhile; ?>
            </section>
			
        </main>
<section class="px-6 max-w-prose mx-auto gap-12 grid grid-cols-1">
			<div>
			<?php $archives->pageLink(' 上一页'); ?>
			<?php $archives->pageLink('下一页','next'); ?>
			</div>
			</section>
	<?php $this->need('footer.php'); ?>
