<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
require 'functions.php';
require 'page_iterator.php';
require 'page.php';

$baseUrl = 'http://www.deep-books.co.uk/search_results.asp?search=mantak%20chia&order=Title';
$pageIterator = new PageIterator(array(
    'name' => 'cp', 'totalPages' => 2
));

class Book {
    private $mPrice;
    private $mTitle;
    private $mAuthor;

    function __construct(array $data) {
        $this->mPrice = $data[0];
        $this->mTitle = $data[1];
        $this->mAuthor = $data[2];
    }

    public function getPrice() {
        return $this->mPrice;
    }

    public function getTitle() {
        return $this->mTitle;
    }

    public function getAuthor() {
        return $this->mAuthor;
    }
}

$books = extractObjects($baseUrl, $pageIterator, '//div[@id="bookHolder"]//span[@class="price"] | //div[@id="bookHolder"]//span[@class="bookHeader"] | //div[@id="bookHolder"]//span[@class="author"]', 'Book');
foreach ($books as $book) {
    echo $book->getTitle() . "\n";
    echo $book->getAuthor() . "\n";
    echo $book->getPrice() . "\n";
    echo '=======================================' . "\n";
}
echo count($books);
echo 'done';
