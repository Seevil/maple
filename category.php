<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
        <main class="p-12">
            <section class="px-6 max-w-prose mx-auto gap-12 grid grid-cols-1">
                <div class="flex flex-col h-48 items-center justify-center">
                    <h1 class="site-title text-4xl leading-relaxed"><?php $this->options->title(); ?></h1>
                    <p class="text-gray-500 mt-2"><?php $this->options->description() ?></p>
                </div>
				
                <div class="relative pointer-events-none">
				<?php $this->widget('Widget_Contents_Post_Recent','pageSize=1')->parse('<span class="text-9xl opacity-10 absolute -left-11 -top-6 font-bold">{year}</span>');?>
                </div>
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
		<section class="px-6 max-w-prose mx-auto gap-12 grid grid-cols-1">
			<div>
			<?php $this->pageLink(' 上一页'); ?>
			<?php $this->pageLink('下一页','next'); ?>
			</div>
			</section>

<?php $this->need('footer.php'); ?>