<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper {

    private $markdownParser;
    private $cache;
    private $isDebug;
    
    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, bool $isDebug)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        dump($isDebug);
    }


    public function parse (string $src) : string {

        if($this->isDebug){
            return $this->markdownParser->transformMarkdown($src);
        }

        return $this->cache->get('markdown_'.md5($src), function() use ($src) {
            return $this->markdownParser->transformMarkdown($src);
        });
    }




}