<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
   <footer class="flex flex-col h-40 items-center justify-center text-gray-400 text-sm">
            <!-- busuanzi -->
            <script async src="//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js"></script>
            <!-- Busuanzi Analytics -->
            <div class="flex items-center gap-2">
                <span>Visitor Count</span>
                <span id="busuanzi_value_site_uv"></span>
                <span>Totalview</span>
                <span id="busuanzi_value_site_pv"></span>
            </div>
            <!-- End Busuanzi Analytics -->
            <!-- copyright -->
            <div class="flex items-center gap-2">
                <span>© <?php echo date('Y'); ?></span>
                <iconify-icon width="18" icon="emojione-monotone:maple-leaf"></iconify-icon>
                <a href="<?php $this->options->siteUrl();?>" target="_blank" rel="noopener noreferrer"><?php $this->options->title(); ?></a>
            </div>
            <!-- powered by -->
            <div class="flex items-center gap-2">
                <span>Powered by</span>
				<a href="http://typecho.org/" target="_blank" rel="noopener noreferrer">Typecho</a>
                <span>&</span>
                <a href="https://www.krsay.com/typecho/maple.html" target="_blank" rel="noopener noreferrer">Maple</a>
            </div>
        </footer>
        <iconify-icon class="fixed right-4 bottom-10 z-100 opacity-0" width="24" icon="ion:arrow-up-c" id="go-top"></iconify-icon>
        <script src="<?php $this->options->themeUrl('source/lib/clipboard.min.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('source/js/main.js'); ?>"></script>
		<?php if ($this->is('post') || $this->is('page') ): ?>
        <script async src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
        <script type="text/x-mathjax-config">
            
  MathJax.Hub.Config({
    "HTML-CSS": {
        preferredFont: "TeX",
        availableFonts: ["STIX","TeX"],
        linebreaks: { automatic:true },
        EqnChunk: (MathJax.Hub.Browser.isMobile ? 10 : 50)
    },
    tex2jax: {
        inlineMath: [ ["$", "$"], ["\\(","\\)"] ],
        processEscapes: true,
        ignoreClass: "tex2jax_ignore|dno",
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code']
    },
    TeX: {
        equationNumbers: { autoNumber: "AMS" },
        noUndefined: { attributes: { mathcolor: "red", mathbackground: "#FFEEEE", mathsize: "90%" } },
        Macros: { href: "{}" }
    },
    messageStyle: "none"
  });

        </script>
        <script type="text/x-mathjax-config">
            
  MathJax.Hub.Queue(function() {
      var all = MathJax.Hub.getAllJax(), i;
      for (i=0; i < all.length; i += 1) {
          all[i].SourceElement().parentNode.className += ' has-jax';
      }
  });

        </script>
        <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
        <script>
            $(document).ready(()=>{
                const maraidConfig = {
                    theme: "default",
                    logLevel: 3,
                    flowchart: {
                        curve: "linear"
                    },
                    gantt: {
                        axisFormat: "%m/%d/%Y"
                    },
                    sequence: {
                        actorMargin: 50
                    },
                };
                mermaid.initialize(maraidConfig);
            }
            );
        </script>
        <script src="<?php $this->options->themeUrl('source/lib/fancybox/fancybox.umd.min.js'); ?>"></script>
        <script>
            $(document).ready(()=>{
                $('.post-content').each(function(i) {
                    $(this).find('img').each(function() {
                        if ($(this).parent().hasClass('fancybox') || $(this).parent().is('a'))
                            return;
                        var alt = this.alt;
                        if (alt)
                            $(this).after('<span class="fancybox-alt">' + alt + '</span>');
                        $(this).wrap('<a class="fancybox-img" href="' + this.src + '" data-fancybox=\"gallery\" data-caption="' + alt + '"></a>')
                    });
                    $(this).find('.fancybox').each(function() {
                        $(this).attr('rel', 'article' + i);
                    });
                });

                Fancybox.bind('[data-fancybox="gallery"]', {// options
                })
            }
            )
        </script>
        <!-- tocbot begin -->
        <script src="<?php $this->options->themeUrl('source/lib/tocbot/tocbot.min.js'); ?>"></script>
        <script>
            $(document).ready(()=>{
                tocbot.init({
                    // Where to render the table of contents.
                    tocSelector: '.post-toc',
                    // Where to grab the headings to build the table of contents.
                    contentSelector: '.post-content',
                    // Which headings to grab inside of the contentSelector element.
                    headingSelector: 'h1, h2, h3',
                    // For headings inside relative or absolute positioned containers within content.
                    hasInnerContainers: true,
                });
            }
            )
        </script>
        <!-- tocbot end -->
		<?php endif; ?>
<?php $this->footer(); ?>
</body>
</html>

