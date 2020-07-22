<?php

namespace DevCommunityDE\CodeFormatter;

use DevCommunityDE\CodeFormatter\XF\Service\Post\Preparer;
use \GuzzleHttp\Client as Guzzle;

/**
 * Class CodeFormatter
 *
 * @package DevCommunityDE\CodeFormatter
 */
class CodeFormatter
{

    /**
     * @var Preparer
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
    public function __construct(Preparer $preparer)
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
        if (!$this->postContainsCodeBlock()) {
            return;
        }

        $post = $this->getPostWithFormattedCode();

        if (!$post) {
            return;
        }

        $this->setPost($post);
        $this->savePost();
    }

    /**
     * @return bool
     */
    protected function postContainsCodeBlock()
    {
        return stripos($this->preparer->getPost()->message, '[CODE') !== false;
    }

    /**
     * @return string|null
     */
    protected function getPostWithFormattedCode() : ?string
    {
        $res = $this->guzzle->post(
            $this->populateApiUrlWithApiKey($this->api_base_url, $this->api_key),
            [
                'body' => $this->preparer->getPost()->message,
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
     * @param string $post
     */
    protected function setPost(string $post)
    {
        $this->preparer->setMessage($post);
    }

    /**
     *
     */
    protected function savePost()
    {
        $this->preparer->getPost()->save();
    }

}
