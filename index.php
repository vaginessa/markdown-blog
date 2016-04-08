<?php

use markdownBlog\Post;

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', true);

require 'vendor/autoload.php';
require 'Post.php';

$postPaths = glob('posts/*', GLOB_ONLYDIR);
$tags = [];
$postArray = [];
$HTMLPage = [];

foreach ($postPaths as $postPath) {

    $postName = str_replace('posts/', '', $postPath);

    $post = new Post($postName);

    // Add this post to the tag array
    foreach ($post->getMeta()->tags as $tag) {
        $tags[$tag][] = $post;
    }

    $postArray[$post->getMeta()->date] = $post;
}

// Sort tags by name
ksort($tags, SORT_NATURAL);

// Sort posts by date order
krsort($postArray, SORT_NUMERIC);

$pageLength = 5;
$pageCount = ceil(count($postArray)/$pageLength);

// Generate each of the page sets
for ($pageSet = 0; $pageSet < $pageCount; $pageSet++) {

    // Get the posts for this page
    $posts = array_slice($postArray, $pageSet*$pageLength, $pageLength);
    $pageURI = ($pageSet === 0) ? '/index':'/page/' . $pageSet;

    ob_start();
    include "template/posts.php";
    $HTMLPage[$pageURI] = ob_get_clean();

}

// Generate the post pages
foreach ($postArray as $postDate => $post) {

    $pageURI = $post->getURI().'/index';

    ob_start();
    include "template/post/full.php";
    $HTMLPage[$pageURI] = ob_get_clean();
}

// Write the HTML to files
foreach ($HTMLPage as $URI => $HTML) {

    $filePath = './docroot' . $URI . '.html';
    $fileDirectory = dirname($filePath);

    if (is_dir($fileDirectory) === false) {
        mkdir($fileDirectory, 0755, true);
    }

    echo 'WRITING '.mb_strlen($HTML).' bytes to: '.$filePath.'<br>';

    file_put_contents($filePath, $HTML);
}
