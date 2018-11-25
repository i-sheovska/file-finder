<?php

namespace FileFinder;

use FileFinder\SearchCriteriaStrategyFactory;

/**
 * Provides basic functionality for finding files in a directory by given criteria
 */
class Finder {

    protected $startPath;
    protected $maxDepth;
    protected $criteriaFactory;

    public function __construct($startPath, $maxDepth = -1) {
        $this->setStartPath($startPath);
        $this->setMaxDepth($maxDepth);
        $this->setCriteriaFactory(new SearchCriteriaStrategyFactory());
    }

    public function setCriteriaFactory(SearchCriteriaStrategyFactory $criteriaFactory) {
        $this->criteriaFactory = $criteriaFactory;
    }

    public function setStartPath($startPath) {
        $this->startPath = realpath($startPath);
    }

    public function getStartPath() {
        return $this->startPath;
    }

    public function setMaxDepth($maxDepth) {
        $this->maxDepth = $maxDepth;
    }

    public function getMaxDepth() {
        return $this->maxDepth;
    }

    /**
     * 
     * @param array $params
     * @param string $criteria
     * @param boolean $firstMatchStop
     * @return array 
     */
    public function find($params, $criteria = 'content', $firstMatchStop = false) {
        $foundedFiles = [];

        $directory = new \RecursiveDirectoryIterator($this->startPath);
        $iterator = new \RecursiveIteratorIterator($directory, \RecursiveIteratorIterator::SELF_FIRST);
        if ($this->maxDepth > -1) {
            $iterator->setMaxDepth($this->maxDepth);
        }
        $iterator->rewind();
        foreach ($iterator as $path) {
            if ($path->isFile() && $path->isReadable()) {
                $fileObject = $path->openFile('r');

                //check if the file matches the given criteria
                $strategy = $this->criteriaFactory->create($criteria);
                if ($strategy->search($fileObject, $params)) {
                    $foundedFiles[] = $path->getRealPath();

                    if ($firstMatchStop) {
                        return $foundedFiles;
                    }
                }
            }
        }

        return $foundedFiles;
    }

}
