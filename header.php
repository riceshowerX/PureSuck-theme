<!DOCTYPE HTML>
<html lang="zh-CN">

<head>
    <meta charset="<?= $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->header(); ?>
    <title>
        <?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ], '', ' - '); ?>
        <?= $this->options->title(); ?>
    </title>

    <!-- 引入外部 CSS -->
    <link rel="stylesheet" href="<?= $this->options->themeUrl('css/PureSuck_Style.css'); ?>">
    <link rel="stylesheet" href="<?= $this->options->themeUrl('/css/a11y-dark.min.css'); ?>">
    <link rel="stylesheet" href="<?= $this->options->themeUrl('/css/PureSuck_Module.css'); ?>">
    <link rel="stylesheet" href="<?= $this->options->themeUrl('/css/aos.css'); ?>">
    <link rel="stylesheet" href="<?= $this->options->themeUrl('/css/MoxDesign.css'); ?>">
    <link rel="icon" href="<?= isset($this->options->logoUrl) && $this->options->logoUrl ? $this->options->logoUrl : $this->options->themeUrl . '/images/avatar.ico'; ?>" type="image/x-icon">
    
    <!-- 引入外部 JS -->
    <script defer src="<?= $this->options->themeUrl('/js/medium-zoom.min.js'); ?>"></script>
    <script defer src="<?= $this->options->themeUrl('/js/highlight.min.js'); ?>"></script>
    <script defer src="<?= $this->options->themeUrl('/js/PureSuck_Module.js'); ?>"></script>
    <script defer src="<?= $this->options->themeUrl('/js/OwO.min.js'); ?>"></script>
    <script defer src="<?= $this->options->themeUrl('/js/MoxDesign.js'); ?>"></script>
    <script defer src="<?= $this->options->themeUrl('/js/pace.min.js'); ?>"></script>
    
    <!-- AOS -->
    <script defer src="<?php $this->options->themeUrl('/js/aos.js'); ?>"></script>

    <!-- 动态样式生成 -->
    <?php generateDynamicCSS(); ?>

    <!-- 主题切换相关 JS -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const initialTheme = savedTheme === 'auto' || !savedTheme ? systemTheme : savedTheme;
            document.documentElement.setAttribute('data-theme', initialTheme);
        })();

        function setTheme(theme) {
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            if (theme === 'auto') {
                document.documentElement.setAttribute('data-theme', systemTheme);
                localStorage.setItem('theme', 'auto');
            } else {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
            }
            updateIcon(theme);
        }

        function toggleTheme() {
            const currentTheme = localStorage.getItem('theme') || 'auto';
            let newTheme;

            if (currentTheme === 'light') {
                newTheme = 'dark';
                MoxToast({ message: "已切换至深色模式" });
            } else if (currentTheme === 'dark') {
                newTheme = 'auto';
                MoxToast({ message: "模式将跟随系统 ㆆᴗㆆ" });
            } else {
                newTheme = 'light';
                MoxToast({ message: "已切换至浅色模式" });
            }

            setTheme(newTheme);
        }

        function updateIcon(theme) {
            const iconElement = document.getElementById('theme-icon');
            if (iconElement) {
                iconElement.classList.remove('icon-sun-inv', 'icon-moon-inv', 'icon-auto');
                if (theme === 'light') {
                    iconElement.classList.add('icon-sun-inv');
                } else if (theme === 'dark') {
                    iconElement.classList.add('icon-moon-inv');
                } else {
                    iconElement.classList.add('icon-auto');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'auto';
            setTheme(savedTheme);
        });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if (localStorage.getItem('theme') === 'auto') {
                const newTheme = e.matches ? 'dark' : 'light';
                document.documentElement.setAttribute('data-theme', newTheme);
                updateIcon('auto');
            }
        });
    </script>

    <!-- 标题下方线条样式 -->
    <?php if ($this->options->postTitleAfter != 'off'): ?>
        <style>
            .post-title::after {
                bottom: <?= $this->options->postTitleAfter == 'wavyLine' ? '-5px' : '5px'; ?>;
                left: 0;
                <?php if ($this->options->postTitleAfter == 'boldLine'): ?>
                    width: 58px;
                    height: 13px;
                <?php elseif ($this->options->postTitleAfter == 'wavyLine'): ?>
                    width: 80px;
                    height: 12px;
                    mask: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="40" height="10" viewBox="0 0 40 10" preserveAspectRatio="none"><path d="M0 5 Q 10 0, 20 5 T 40 5" stroke="black" stroke-width="2" fill="transparent"/></svg>') repeat-x;
                    mask-size: 40px 12px;
                <?php endif; ?>
            }
        </style>
    <?php endif; ?>
</head>

<body>
    <div class="wrapper">
        <header class="header" data-js="header">
            <div class="wrapper header-wrapper header-title">
                <span class="el-avatar el-avatar--circle">
                    <img src="<?= $this->options->logoIndex; ?>" style="object-fit:cover;" alt="博主头像" width="120" height="120">
                </span>
                <div class="header-title"><?= $this->options->titleIndex(); ?></div>
                <p itemprop="description" class="header-item header-about"><?= $this->options->customDescription ?: 'ワクワク'; ?></p>
                <div class="nav header-item left-side-custom-code"><?= $this->options->leftSideCustomCode ?: ''; ?></div>
                <div class="nav header-item header-credit">
                    Powered by Typecho<br>
                    <a href="https://github.com/MoXiaoXi233/PureSuck-theme">Theme PureSuck</a>
                </div>
                <nav class="nav header-item header-nav">
                    <span class="nav-item<?= $this->is('index') ? ' nav-item-current' : ''; ?>">
                        <a href="<?= $this->options->siteUrl(); ?>" title="首页">
                            <span itemprop="name">首页</span>
                        </a>
                    </span>
                    <!-- 循环显示页面 -->
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while ($pages->next()): ?>
                        <span class="nav-item<?= $this->is('page', $pages->slug) ? ' nav-item-current' : ''; ?>">
                            <a href="<?= $pages->permalink(); ?>" title="<?= $pages->title(); ?>">
                                <span><?= $pages->title(); ?></span>
                            </a>
                        </span>
                    <?php endwhile; ?>
                </nav>
                <div class="theme-toggle-container">
                    <button class="theme-toggle" onclick="toggleTheme()" aria-label="日夜切换">
                        <span id="theme-icon"></span>
                    </button>
                </div>
            </div>
        </header>
        <main class="main">
