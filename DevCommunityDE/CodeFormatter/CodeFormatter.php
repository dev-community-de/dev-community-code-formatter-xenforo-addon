<?php

namespace DevCommunityDE\CodeFormatter;

use DevCommunityDE\CodeFormatter\Preparer\PreparerInterface;
use \GuzzleHttp\Client as Guzzle;

/**
 * Class CodeFormatter
 *
 * @package DevCommunityDE\CodeFormatter
 */
class CodeFormatter
{

    /**
     * @var PreparerInterface
     */
    protected $preparer;

    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * @var string
     */
    protected $api_base_url;

    /**
     * @var string
     */
    protected $api_key;

    /**
     * @param Preparer $preparer
     */
    public function __construct(PreparerInterface $preparer)
    {
        $this->preparer = $preparer;
        $this->guzzle = new Guzzle;

        $this->api_base_url = \XF::options()->devcommunitydeCodeFormatterApiBaseUrl;
        $this->api_key = \XF::options()->devcommunitydeCodeFormatterApiKey;
    }

    /**
     *
     */
    public function run()
    {
        if (!$this->contentContainsCodeBlock()) {
            return;
        }

        $content = $this->getEntityContentWithFormattedCode();

        if (!$content) {
            return;
        }

        $this->setEntityContent($content);
        $this->saveEntity();
    }

    /**
     * @return bool
     */
    protected function contentContainsCodeBlock()
    {
        return stripos($this->preparer->getContent(), '[CODE') !== false;
    }

    /**
     * @return string|null
     */
    protected function getEntityContentWithFormattedCode() : ?string
    {
        $res = $this->guzzle->post(
            $this->populateApiUrlWithApiKey($this->api_base_url, $this->api_key),
            [
                'body' => $this->preparer->getContent(),
            ]
        );

        if ($res->getStatusCode() === 200) {
            return $res->getBody();
        }

        return null;
    }

    /**
     * @param string $api_url
     * @param string $api_key
     * @return string
     */
    protected function populateApiUrlWithApiKey(string $api_url, string $api_key) : string
    {
        return $api_url . '?api_key=' . $api_key;
    }

    /**
     * @param string $content
     */
    protected function setEntityContent(string $content)
    {
        $this->preparer->setContent($content);
    }

    /**
     *
     */
    protected function saveEntity()
    {
        $this->preparer->getEntity()->save();
    }

}
