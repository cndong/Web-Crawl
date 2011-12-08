<?php
class PageIterator implements Iterator {
    private $mtotalPages;
    private $mCurrentPage;
    private $mName;

    function __construct(array $params) {
        $this->mCurrentPage = 1;
        if (isset($params['totalPages'])) {
            $this->mtotalPages = $params['totalPages'];
        } elseif (isset($params['itemsPerPage']) && isset($params['totalItems'])) {
            $this->mtotalPages = ceil($params['totalItems'] / $params['itemsPerPage']);
        } else {
            throw new Exception('invalid parameters');
        }
        if (isset($params['name'])) {
            $this->mName = $params['name'];
        } else {
            $this->mName = 'page';
        }
    }

    public function rewind() {
        $this->mCurrentPage = 1;
    }

    public function current() {
        return new Page($this->mName, $this->mCurrentPage);
    }

    public function key() {
        return $this->mCurrentPage;
    }

    public function next() {
        ++$this->mCurrentPage;
    }

    public function valid() {
        return $this->mCurrentPage <= $this->mtotalPages;
    }
}
