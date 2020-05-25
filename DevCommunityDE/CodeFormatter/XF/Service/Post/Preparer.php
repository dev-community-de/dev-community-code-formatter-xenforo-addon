<?php

namespace DevCommunityDE\CodeFormatter\XF\Service\Post;

use DevCommunityDE\CodeFormatter\CodeFormatter;
use XF\Service\Post\Preparer as BasePreparer;

/**
 * Class Preparer
 *
 * @package DevCommunityDE\CodeFormatter\XF\Service\Post
 */
class Preparer extends BasePreparer
{

    /**
     *
     */
    public function afterInsert()
    {
        parent::afterInsert();

        $this->formatCode();
    }

    /**
     *
     */
    public function afterUpdate()
    {
        parent::afterUpdate();

        $this->formatCode();
    }

    /**
     *
     */
    protected function formatCode()
    {
        (new CodeFormatter($this))->run();
    }

}
