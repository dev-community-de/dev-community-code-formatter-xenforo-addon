<?php

namespace DevCommunityDE\CodeFormatter\Preparer;

use XF\Mvc\Entity\Entity;

/**
 * Class PreparerInterface
 *
 * @package DevCommunityDE\CodeFormatter\Preparer
 */
interface PreparerInterface
{

    /**
     * @return Entity
     */
    public function getEntity(): Entity;

    /**
     * @return string
     */
    public function getContent() : string;

    /**
     * @param string $content
     */
    public function setContent(string $content);

    /**
     *
     */
    public function afterInsert();

    /**
     *
     */
    public function afterUpdate();

}
