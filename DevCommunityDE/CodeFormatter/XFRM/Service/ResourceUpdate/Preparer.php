<?php

namespace DevCommunityDE\CodeFormatter\XFRM\Service\ResourceUpdate;

use DevCommunityDE\CodeFormatter\Preparer\PreparerInterface;
use DevCommunityDE\CodeFormatter\Traits\FormatsCode;
use XFRM\Entity\ResourceUpdate;
use XFRM\Service\ResourceUpdate\Preparer as BasePreparer;

/**
 * Class Preparer
 *
 * @package DevCommunityDE\CodeFormatter\XFRM\Service\ResourceUpdate
 */
class Preparer extends BasePreparer implements PreparerInterface
{
    use FormatsCode;

    /**
     * @return ResourceUpdate
     */
    public function getEntity() : ResourceUpdate
    {
        return $this->getUpdate();
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->getEntity()->message;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->setMessage($content);
    }

}
