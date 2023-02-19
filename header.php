<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php $this->header('generator=&template=&pingback=&xmlrpc=&commentReply='); ?>
		<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
        <link rel="icon" href="/favicon.png">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('source/css/main.css'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('source/lib/nprogress/nprogress.css'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('source/lib/fancybox/fancybox.min.css'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('source/lib/tocbot/tocbot.min.css'); ?>">
        <script src="<?php $this->options->themeUrl('source/lib/jquery.min.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('source/lib/iconify-icon.min.js'); ?>"></script>
        <script src="https://cdn.tailwindcss.com?plugins=typography,line-clamp"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>
        <script src="<?php $this->options->themeUrl('source/lib/nprogress/nprogress.js'); ?>"></script>
        <script>
            $(document).ready(()=>{
                NProgress.configure({
                    showSpinner: false,
                });
                NProgress.start();
                $("#nprogress .bar").css({
                    background: "#de7441",
                });
                $("#nprogress .peg").css({
                    "box-shadow": "0 0 2px #de7441, 0 0 4px #de7441",
                });
                $("#nprogress .spinner-icon").css({
                    "border-top-color": "#de7441",
                    "border-left-color": "#de7441",
                });
                setTimeout(function() {
                    NProgress.done();
                    $(".fade").removeClass("out");
                }, 800);
            }
            );
        </script>
        <script>
            (function() {
                const prefersDark = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
                const setting = localStorage.getItem("hexo-color-scheme") || "auto";
                if (setting === "dark" || (prefersDark && setting !== "light"))
                    document.documentElement.classList.toggle("dark", true);
            }
            )();
            window.onload = function() {
                // init iconify icon
                const isDark = document.documentElement.classList.contains("dark");
                if (isDark) {
                    $("#toggle-dark").attr("icon", "ri:moon-line");
                } else {
                    $("#toggle-dark").attr("icon", "ri:sun-line");
                }

                const toggleDark = ()=>{
                    console.log("toggle dark");
                    const darkMode = document.documentElement.classList.toggle("dark");
                    localStorage.setItem("hexo-color-scheme", darkMode ? "dark" : "light");
                    $("#toggle-dark").attr("icon", darkMode ? "ri:moon-line" : "ri:sun-line");
                }
                ;

                $("#toggle-dark").click(toggleDark);
            }
            ;
        </script>
    </head>
    <body class="font-sans bg-white dark:bg-zinc-900 text-gray-700 dark:text-gray-200">
        <header class="fixed w-full px-5 py-1 z-10 backdrop-blur-xl backdrop-saturate-150 border-b border-black/5">
            <div class="max-auto">
                <nav class="flex items-center text-base">
                    <a href="<?php $this->options->siteUrl();?>" class="group">
                        <h2 class="font-medium tracking-tighterp text-l p-2">
                            <img class="w-5 mr-2 inline-block transition-transform group-hover:rotate-[30deg]" src="<?php $this->options->themeUrl('source/images/logo.svg'); ?>" alt="<?php $this->options->title(); ?>"/><?php $this->options->title(); ?>
                        </h2>
                    </a>
		<div id="header-title" class="opacity-0 md:ml-2 md:mt-[0.1rem] text-xs font-medium whitespace-nowrap overflow-hidden overflow-ellipsis">Categories </div>
                    <div class="flex-1"></div>
                    <div class="flex items-center gap-3">
                        <a class="hidden sm:flex" href="/archives">Posts</a>
                        <a class="hidden sm:flex" href="/category">Categories</a>
                        <a class="hidden sm:flex" href="/tag">Tags</a>
                        <a class="w-5 h-5 hidden sm:flex" title="Github" target="_blank" rel="noopener" href="<?php if($this->options->github): ?><?php $this->options->github();?><?php endif; ?>">
                            <iconify-icon width="20" icon="ri:github-line"></iconify-icon>
                        </a>
                        <a class="w-5 h-5 hidden sm:flex" title="ZhiHu" target="_blank" rel="noopener" href="<?php if($this->options->zhihu): ?><?php $this->options->zhihu();?><?php endif; ?>">
                            <iconify-icon width="20" icon="ri:zhihu-line"></iconify-icon>
                        </a>
                        <a class="w-5 h-5 hidden sm:flex" title="Twitter" target="_blank" rel="noopener" href="<?php if($this->options->twitter): ?><?php $this->options->twitter();?><?php endif; ?>">
                            <iconify-icon width="20" icon="ri:twitter-line"></iconify-icon>
                        </a>
                        <a class="w-5 h-5 hidden sm:flex" title="Weibo" target="_blank" rel="noopener" href="<?php if($this->options->weibo): ?><?php $this->options->weibo();?><?php endif; ?>">
                            <iconify-icon width="20" icon="ri:weibo-line"></iconify-icon>
                        </a>
                        <a class="w-5 h-5" title="toggle theme">
                            <iconify-icon width="20" icon="ri:sun-line" id="toggle-dark"></iconify-icon>
                        </a>
                    </div>
                    <div class="flex items-center justify-center gap-3 ml-3 sm:hidden">
                        <span class="w-5 h-5" aria-hidden="true" role="img" id="open-menu">
                            <iconify-icon width="20" icon="carbon:menu"></iconify-icon>
                        </span>
                        <span class="w-5 h-5 hidden" aria-hidden="true" role="img" id="close-menu">
                            <iconify-icon width="20" icon="carbon:close"></iconify-icon>
                        </span>
                    </div>
                </nav>
            </div>
        </header>
        <div id="menu-panel" class="h-0 overflow-hidden sm:hidden fixed left-0 right-0 top-12 bottom-0 z-10">
            <div id="menu-content" class="relative z-20 bg-white/80 px-6 sm:px-8 py-2 backdrop-blur-xl -translate-y-full transition-transform duration-300">
                <ul class="nav flex flex-col sm:flex-row text-sm font-medium">
				<?php $this->widget('Widget_Contents_Page_List')->parse('<li class="nav-portfolio sm:mx-2 border-b sm:border-0 border-black/5 last:border-0 hover:text-main"><a href="{permalink}"  class="flex h-12 sm:h-auto items-center">{title}</a></li>'); ?>
                </ul>
            </div>
            <div class="mask bg-black/20 absolute inset-0"></div>
        </div>