<?php

namespace FileFinder;

use FileFinder\CriteriaSearchInterface;

/**
 * Allows to find files by name
 */
class NameCriteriaStrategy implements CriteriaSearchInterface {

    /**
     * 
     * @param SplFileObject $fileObject
     * @param array $criteriaParams
     * @return boolean
     * @throws \UnexpectedValueException
     */
    public function search($fileObject, $criteriaParams) {

        if (!isset($criteriaParams['pattern'])) {
            throw new \UnexpectedValueException('Pattern is not specified');
        }
        $pattern = $criteriaParams['pattern'];

        if (!preg_match($pattern, $fileObject->getFilename())) {
            return false;
        } else {
            return true;
        }
    }

}
