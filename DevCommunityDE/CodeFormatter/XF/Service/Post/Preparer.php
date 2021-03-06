<?php

namespace DevCommunityDE\CodeFormatter\XF\Service\Post;

use DevCommunityDE\CodeFormatter\Preparer\PreparerInterface;
use DevCommunityDE\CodeFormatter\Traits\FormatsCode;
use XF\Entity\Post;
use XF\Service\Post\Preparer as BasePreparer;

/**
 * Class Preparer
 *
 * @package DevCommunityDE\CodeFormatter\XF\Service\Post
 */
class Preparer extends BasePreparer implements PreparerInterface
{
    use FormatsCode;

    /**
     * @return Post
     */
    public function getEntity() : Post
    {
        return $this->getPost();
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
