<?php
class Page {
    private $mName;
    private $mPageNumber;

    function __construct($name, $pageNumber) {
        $this->mName = $name;
        $this->mPageNumber = $pageNumber;
    }

    public function getPageNumber() {
        return $this->mPageNumber;
    }

    public function getName() {
        return $this->mName;
    }

    public function __toString() {
        return sprintf('%s=%s', $this->getName(), $this->getPageNumber());
    }
}
