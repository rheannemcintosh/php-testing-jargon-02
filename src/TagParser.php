<?php

namespace App;

class TagParser
{
    public function parse(string $tags)
    {
        return preg_split('/ ?[,|] ?/', $tags);
    }
}