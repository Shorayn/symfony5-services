<?php

namespace App\Service;

class MarkdownHelper {
    public function parse ($src) : string {

        return $cache->get('markdown_'.md5($src), function() use ($src, $markdownParser) {
            return $markdownParser->transformMarkdown($src);
        });
    }




}