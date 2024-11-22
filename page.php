<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="wrapper">

    <?php
    $hasImg = $this->fields->img ? true : false;
    ?>
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

            <!-- 大图样式 -->
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
                    <div class="inner-post-wrapper">
                        <div class="meta post-meta">
                            <a itemprop="datePublished" href="<?= $this->permalink() ?>"
                               class="icon-ui icon-ui-date meta-item meta-date">
                                <span class="meta-count"><?= $this->date(); ?></span>
                            </a>
                            <a href="<?= $this->permalink() ?>#comments"
                               class="icon-ui icon-ui-comment meta-item meta-comment">
                                <?= $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?>
                            </a>
                        </div>

                        <!-- 短代码解析 -->
                        <?= parseShortcodes($this->content); ?>

                    </div>
                </div>
            </section>

            <section class="post-item post-comments">
                <div class="wrapper post-wrapper">
                    <?php $this->need('comments.php'); ?>
                </div>
            </section>
        </div>
    </article>

</div>

<nav class="nav main-pager" role="navigation" aria-label="Pagination" data-js="pager">
    <div class="nav main-lastinfo">
        <span class="nav-item-alt">
            <?= !empty($this->options->footerInfo) ? $this->options->footerInfo : ''; ?>
        </span>
    </div>
</nav>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
