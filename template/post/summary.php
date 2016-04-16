<article class="post" itemscope="" itemtype="http://schema.org/blogPosting">
    <?php if ($post->hasBannerImage()) : ?>
        <a href="<?= $post->getURI(); ?>" itemprop="url">
            <div itemprop="image" itemscope itemtype="http://schema.org/imageObject">
                <img itemprop="contentUrl" src="<?= $post->getBannerImage(); ?>">
                <meta itemprop="representativeOfPage" content="true">
                <meta itemprop="contentSize" content="<?= round(filesize($post->getBannerFilePath())/1024, 1); ?>KB">
            </div>
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
            <?= $post->getAbstract(); ?>
        </div>
        <footer>
            <div class="tags">
                <?php foreach ($post->getMeta()->tags as $tagName) : ?>
                    <a href="/tags/<?= str_replace(' ', '-', $tagName); ?>" class="tag">
                        <?= $tagName; ?>
                    </a>
                <?php endforeach; ?>
                <meta itemprop="keywords" content="<?= implode(',', $post->getMeta()->tags); ?>"/>
            </div>
            <?php if ($post->hasMoreToRead()) : ?>
            <div>
                <a href="<?= $post->getURI(); ?>" class="more">Read More</a>
            </div>
            <?php endif; ?>
        </footer>
    </div>
</article>