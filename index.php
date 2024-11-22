<?php

/**
 * 干净，纯洁，淡雅朴素。
 * It's PureSuck For You.
 * 
 * @package PureSuck
 * @author MoXiify
 * @version 1.2.4
 * @link https://www.moxiify.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="wrapper">

    <?php while ($this->next()): ?>
        <?php 
        $hasImg = !empty($this->fields->img); // 简化图片检查逻辑
        ?>
        <article class="post <?= $hasImg ? 'post--photo post--cover' : 'post--text'; ?> post--index main-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="post-inner">
                <header class="post-item post-header <?= $hasImg ? 'no-bg' : ''; ?>">
                    <div class="wrapper post-wrapper">
                        <div class="avatar post-author">
                            <img src="<?= $this->options->authorAvatar ?: $this->options->themeUrl('images/avatar.png'); ?>" alt="作者头像" class="avatar-item avatar-img">
                            <span class="avatar-item">
                                <?php $this->author(); ?>
                            </span>
                        </div>
                    </div>
                </header>

                <!-- 大图样式 -->
                <?php if ($hasImg): ?>
                    <figure class="post-media <?= $this->is('post') ? 'single' : ''; ?>">
                        <img itemprop="image" src="<?= $this->fields->img(); ?>" alt="头图" width="2000" height="800">
                    </figure>
                <?php endif; ?>

                <!-- 文章内容 -->
                <section class="post-item post-body">
                    <div class="wrapper post-wrapper">
                        <h1 class="post-title">
                            <a href="<?= $this->permalink() ?>" title="<?= $this->title() ?>">
                                <?= $this->title() ?>
                            </a>
                        </h1>
                        <!-- 摘要 -->
                        <p class="post-excerpt">
                            <?= $this->fields->desc ?: $this->excerpt(200, ''); ?>
                        </p>
                    </div>
                </section>

                <footer class="post-item post-footer">
                    <div class="wrapper post-wrapper">
                        <div class="meta post-meta">
                            <a itemprop="datePublished" href="<?= $this->permalink() ?>" class="icon-ui icon-ui-date meta-item meta-date">
                                <span class="meta-count">
                                    <?= $this->date(); ?>
                                </span>
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
</div>

<nav class="nav main-pager" data-js="pager">
    <span class="nav-item-alt">
        第 <?= max($this->_currentPage, 1); ?> 页 / 共 <?= ceil($this->getTotal() / $this->parameter->pageSize); ?> 页
    </span>
    <div class="nav nav--pager">
        <?php $this->pageLink('上一页'); ?>
        <i class="icon-record-outline"></i>
        <?php $this->pageLink('下一页', 'next'); ?>
    </div>
</nav>

<div class="nav main-lastinfo">
    <span class="nav-item-alt">
        <?= !empty($this->options->footerInfo) ? $this->options->footerInfo : ''; ?>
    </span>
</div>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
