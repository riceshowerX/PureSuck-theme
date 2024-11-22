<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * Archive Page Template
 *
 * @package custom
 */
$this->need('header.php');
?>

<div class="wrapper">

    <?php
    // Check if an image exists for the post
    $hasImg = $this->fields->img ? true : false;
    ?>
    <article class="post <?= $hasImg ? 'post--photo post--cover' : 'post--text'; ?> post--index main-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="post-inner">
            <header class="post-item post-header <?= $hasImg ? 'no-bg' : ''; ?>">
                <div class="wrapper post-wrapper">
                    <div class="avatar post-author">
                        <img src="<?= $this->options->authorAvatar ?: $this->options->themeUrl('images/avatar.png'); ?>" alt="Author Avatar" class="avatar-item avatar-img">
                        <span class="avatar-item"><?= $this->author(); ?></span>
                    </div>
                </div>
            </header>

            <!-- Displaying Featured Image -->
            <?php if ($hasImg): ?>
                <figure class="post-media <?= $this->is('post') ? 'single' : ''; ?>">
                    <img itemprop="image" src="<?= $this->fields->img(); ?>" alt="Featured Image" width="2000" height="800" loading="lazy">
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
                            <!-- Display Total Posts and Characters -->
                            <p>这里会归档一切文章</p>
                            <p>共创作了 <?= getTotalPostsCount(); ?> 篇文章，合 <?= allOfCharacters(); ?> 字</p>
                        </div>

                        <?php
                        // Fetch all posts for archiving
                        $this->widget('Widget_Contents_Post_Recent', 'pageSize=100')->to($posts);
                        $archives = [];

                        // Group posts by year and month
                        while ($posts->next()) {
                            $date = $posts->date; // Get post date
                            $year = $date->format('Y'); // Get year
                            $monthDay = $date->format('m-d'); // Get month and day
                            $archives[$year][$monthDay][] = clone $posts; // Group posts by year and month
                        }

                        // Output archives
                        foreach ($archives as $year => $items) {
                            echo '<h2 class="timeline-year">' . $year . '</h2>'; // Display year
                            echo '<div id="timeline">'; // Start timeline
                            foreach ($items as $monthDay => $posts) {
                                foreach ($posts as $item) {
                                    echo '<div class="timeline-item">';
                                    echo '<div class="timeline-dot"></div>';
                                    echo '<div class="timeline-content">';
                                    echo '<div class="timeline-date">' . $monthDay . '</div>'; // Display month and day
                                    echo '<div class="timeline-title"><a href="' . $item->permalink . '">' . $item->title . '</a></div>';
                                    echo '</div>'; // Close timeline content
                                    echo '</div>'; // Close timeline item
                                }
                            }
                            echo '</div>'; // End timeline
                        }
                        ?>
                    </div>
                </div>
            </section>

        </div>
    </article>

</div>

<nav class="nav main-pager" role="navigation" aria-label="Pagination" data-js="pager">
    <div class="nav main-lastinfo">
        <span class="nav-item-alt">
            <?php
            // Display footer information
            $options = Typecho_Widget::widget('Widget_Options');
            if (!empty($options->footerInfo)) {
                echo $options->footerInfo;
            }
            ?>
        </span>
    </div>
</nav>
</main>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
