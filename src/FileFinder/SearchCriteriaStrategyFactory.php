<?php

namespace FileFinder;

use FileFinder\NameCriteriaStrategy;
use FileFinder\ContentCriteriaStrategy;

/**
 * Factory for creating the strategy to use for searching
 */
class SearchCriteriaStrategyFactory {

    /**
     * 
     * @param type $criteria
     * @return ContentCriteriaStrategy|NameCriteriaStrategy
     */
    public function create($criteria) {

        switch ($criteria) {
            case 'name':
                return new NameCriteriaStrategy();
            case 'content':
                return new ContentCriteriaStrategy();
            default:
                throw new \UnexpectedValueException('The given criteria is not implemented yet');
        }
    }

}
