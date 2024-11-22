<div class="right-sidebar" id="right-sidebar">

    <!-- 搜索功能 -->
    <?php if ($this->options->showSearch === '1'): ?>
        <div class="search-section">
            <header class="section-header">
                <span class="icon-search"></span>
                <span class="title">搜索</span>
            </header>
            <section class="section-body">
                <form method="get" action="<?= $this->options->siteUrl(); ?>" class="search-container" role="search">
                    <input type="text" name="s" class="search-input" placeholder="输入关键字搜索" aria-label="输入关键字进行搜索">
                    <button type="submit" class="search-button" aria-label="搜索">
                        <span class="icon-search"></span>
                    </button>
                </form>
            </section>
        </div>
    <?php endif; ?>

    <!-- 分类模块 -->
    <?php if ($this->options->showCategory === '1'): ?>
        <div class="category-section">
            <header class="section-header">
                <span class="icon-emo-wink"></span>
                <span class="title">分类</span>
            </header>
            <section class="section-body">
                <div class="category-cloud">
                    <?php 
                    $this->widget('Widget_Metas_Category_List')->to($categories); 
                    if ($categories->have()): 
                        while ($categories->next()): 
                    ?>
                            <a href="<?= $categories->permalink(); ?>" class="category"><?= $categories->name(); ?></a>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <p>没有任何分类</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    <?php endif; ?>

    <!-- 标签模块 -->
    <?php if ($this->options->showTag === '1'): ?>
        <div class="tag-section">
            <header class="section-header">
                <span class="icon-hashtag"></span>
                <span class="title">标签</span>
            </header>
            <section class="section-body">
                <div class="tag-cloud">
                    <?php 
                    $this->widget('Widget_Metas_Tag_Cloud')->to($tags); 
                    if ($tags->have()): 
                        while ($tags->next()): 
                    ?>
                            <a href="<?= $tags->permalink(); ?>" class="tag"><?= $tags->name(); ?></a>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <p>没有任何标签</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    <?php endif; ?>

    <!-- 文章目录 -->
    <?php if ($this->options->showTOC === '1' && ($this->is('post') || $this->is('page') || $this->is('archives'))): ?>
        <div class="toc-section" id="toc-section">
            <header class="section-header">
                <span class="icon-article"></span>
                <span class="title">文章目录</span>
            </header>
            <section class="section-body">
                <div class="toc"></div>
            </section>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                initializeStickyTOC(); // 初始化文章目录
            });
        </script>
    <?php endif; ?>

</div>
