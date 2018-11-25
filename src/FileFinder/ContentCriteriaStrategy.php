<?php

namespace FileFinder;

use FileFinder\CriteriaSearchInterface;

/**
 * Allows to find files which contains a given string in content
 */
class ContentCriteriaStrategy implements CriteriaSearchInterface {

    /**
     * 
     * @param SplFileObject $fileObject
     * @param array $criteriaParams
     * @return boolean
     * @throws \UnexpectedValueException
     */
    public function search($fileObject, $criteriaParams) {

        if (!isset($criteriaParams['searched'])) {
            throw new \UnexpectedValueException('Searched string is not specified');
        }
        $searched = $criteriaParams['searched'];
        $portionSize = isset($criteriaParams['portionSize']) ? $criteriaParams['portionSize'] : 1024;

        if (mb_strlen($searched) > $portionSize) {
            throw new \UnexpectedValueException('Size of searched string should not be bigger than the size of the portion');
        }

        $lastBuffer = '';
        while (!$fileObject->eof()) {
            $portion = $fileObject->fread($portionSize);
            $buffer = $lastBuffer . $portion;
            if (mb_strpos($buffer, $searched) !== false) {
                return true;
            }
            $lastBuffer = $portion;
        }
        return false;
    }

}
