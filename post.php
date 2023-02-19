<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

        <main class="p-12">
            <!-- toc -->
			<nav class="post-toc toc text-sm w-48 relative top-32 right-0 opacity-70 hidden lg:block" style="position: fixed !important;"><?php getCatalog(); ?></nav>
            <section class="px-6 max-w-prose mx-auto md:px-0">
                <!-- header -->
                <header class="overflow-hidden pt-6 pb-6 md:pt-12">
                    <div class="pt-4 md:pt-6">
                        <h1 id="article-title" class="text-[2rem] font-bold leading-snug mb-4 md:mb-6 md:text-[2.6rem]"><?php $this->title() ?></h1>
                        <p class="mb-6"></p>
                        <div>
                            <section class="flex items-center gap-3 text-sm">
                                <time><?php $this->date('Y-m-d H:m:s'); ?></time><span class="text-gray-400">·</span>
                                <span><?php echo t_ago($this->created);?></span>
                                <span class="text-gray-400">·</span>
                                <span><?php echo t_count($this->cid); ?> words</span>
                            </section>
                        </div>
                    </div>
                </header>
                <!-- content -->
                <article class="post-content mt-10 prose dark:prose-invert post-content">
                     <?php $this->content(); ?> 
                </article>
                <!-- tag -->
                <div class="mt-12 pt-6 border-t border-gray-200">
				
                    <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 m-1 text-sm rounded-md transition-colors hover:bg-gray-200">
                      <?php $this->tags('</span><span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 m-1 text-sm rounded-md transition-colors hover:bg-gray-200">', true, 'none'); ?>
                    </span>
                  
                </div>
                <!-- prev and next -->
                <div class="flex justify-between mt-12 pt-6 border-t border-gray-200">
				  <div>
				  <?php thePrev($this); ?>
				</div>
				<div>
				<?php theNext($this); ?>
				</div>
				</div>
                <!-- comment -->
                <div class="article-comments mt-12">
                    <?php $this->need('vcomments.php'); ?>
                </div>
            </section>
        </main>
       
<?php $this->need('footer.php'); ?>