<?php

namespace DevCommunityDE\CodeFormatter\Traits;

use DevCommunityDE\CodeFormatter\CodeFormatter;

/**
 * Class FormatsCode
 *
 * @package DevCommunityDE\CodeFormatter\Traits
 */
trait FormatsCode
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
