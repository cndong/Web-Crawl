<?php
require 'functions.php';
require 'page.php';
require 'page_iterator.php';

$baseUrl = 'http://www.deep-books.co.uk/search_results.asp?search=mantak%20chia&order=Title';
echo urlBuilder($baseUrl, new Page('cp', 1));