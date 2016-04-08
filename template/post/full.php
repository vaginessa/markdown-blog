<?php include __DIR__."/../includes/head.php"; ?>
    <div class="posts">
        <div class="wrapper">
            <article class="post" itemscope="" itemtype="http://schema.org/blogPosting">
                <?php if ($post->getMeta()->images[0] !== null) : ?>
                    <a href="<?= $post->getURI(); ?>" itemprop="url">
                        <img src="<?= $post->getMeta()->images[0]; ?>">
                    </a>
                <?php endif; ?>

                <div class="content">
                    <header>
                        <time datetime="<?= date('c', $post->getMeta()->date); ?>" itemprop="dateCreated">
                            <a href="<?= $post->getURI(); ?>" itemprop="url">
                                <?= date('d-m-y', $post->getMeta()->date); ?>
                            </a>
                        </time>
                        <h1 class="title" itemprop="name">
                            <a href="<?= $post->getURI(); ?>" itemprop="url">
                                <?= $post->getMeta()->title; ?>
                            </a>
                        </h1>
                    </header>
                    <div>
                        <?= $post->getHTML(); ?>
                    </div>
                    <footer>
                        <div class="tags">
                            <?php foreach ($post->getMeta()->tags as $tagName) : ?>
                                <a href="/tags/<?= $tagName; ?>" class="tag"><?= $tagName; ?></a>
                            <?php endforeach; ?>
                        </div>
                        <div>
                            <a href="<?= $post->getURI(); ?>" class="more">Read More</a>
                        </div>
                    </footer>
                </div>
            </article>        </div>
    </div>
<?php include __DIR__."/../tags.php"; ?>
<?php include __DIR__."/../includes/foot.php"; ?>