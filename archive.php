<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="wrapper">

    <h3 class="archive-title">
        <?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ''); ?>
    </h3>

    <?php if ($this->have()): ?>
        <?php while ($this->next()): ?>
            <?php $hasImg = $this->fields->img ? true : false; ?>
            <article class="post <?= $hasImg ? 'post--photo post--cover' : 'post--text'; ?> post--index main-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="post-inner">
                    <header class="post-item post-header <?= $hasImg ? 'no-bg' : ''; ?>">
                        <div class="wrapper post-wrapper">
                            <div class="avatar post-author">
                                <img src="<?= $this->options->authorAvatar ?: $this->options->themeUrl('images/avatar.png'); ?>" alt="作者头像" class="avatar-item avatar-img">
                                <span class="avatar-item"><?= $this->author(); ?></span>
                            </div>
                        </div>
                    </header>

                    <?php if ($hasImg): ?>
                        <figure class="post-media <?= $this->is('post') ? 'single' : ''; ?>">
                            <img itemprop="image" src="<?= $this->fields->img(); ?>" alt="头图" width="2000" height="800" loading="lazy">
                        </figure>
                    <?php endif; ?>

                    <section class="post-item post-body">
                        <div class="wrapper post-wrapper">
                            <h1 class="post-title">
                                <a href="<?= $this->permalink() ?>" title="<?= $this->title() ?>">
                                    <?= $this->title() ?>
                                </a>
                            </h1>
                            <p class="post-excerpt">
                                <?= $this->fields->desc ?: $this->excerpt(200, ''); ?>
                            </p>
                        </div>
                    </section>

                    <footer class="post-item post-footer">
                        <div class="wrapper post-wrapper">
                            <div class="meta post-meta">
                                <a itemprop="datePublished" href="<?= $this->permalink() ?>" class="icon-ui icon-ui-date meta-item meta-date">
                                    <span class="meta-count"><?= $this->date(); ?></span>
                                </a>
                                <a href="<?= $this->permalink() ?>#comments" class="icon-ui icon-ui-comment meta-item meta-comment">
                                    <?= $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?>
                                </a>
                            </div>
                        </div>
                    </footer>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <article class="post post--text post--index main-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="post-inner">
                <section class="post-item post-body" style="margin-top: 0px;">
                    <div class="wrapper post-wrapper">
                        <p style="text-align: center;">
                            <img src="<?= $this->options->themeUrl('images/Zai_Cry.png'); ?>" id="ZaiJPG" alt="没有适合的结果" style="display: block; margin: 0 auto; max-height: 200px;">
                        </p>
                        <p style="text-align: center;"><?= _e('肥肠抱歉，没有找到适合的结果( ´ﾟДﾟ`)'); ?></p>
                        <p style="text-align: center;"><?= _e('不妨在本站到处逛逛？'); ?></p>
                    </div>
                </section>
            </div>
        </article>
    <?php endif; ?>

</div>

<nav class="nav main-pager" data-js="pager">
    <span class="nav-item-alt">
        第 <?= $this->_currentPage > 1 ? $this->_currentPage : 1; ?> 页 / 共 <?= ceil($this->getTotal() / $this->parameter->pageSize); ?> 页
    </span>
    <div class="nav nav--pager">
        <?php $this->pageLink('上一页', 'prev'); ?>
        <i class="icon-record-outline"></i>
        <?php $this->pageLink('下一页', 'next'); ?>
    </div>
</nav>

<div class="nav main-lastinfo">
    <span class="nav-item-alt">
        <?php if (!empty($this->options->footerInfo)) echo $this->options->footerInfo; ?>
    </span>
</div>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
