<?php

namespace App;

use Countable;

class Questions implements Countable
{
    protected array $questions;

    public function __construct(array $questions = [])
    {
        $this->questions = $questions;
    }

    public function add(Question $question)
    {
        $this->questions[] = $question;
    }

    public function next()
    {
        $question = current($this->questions);

        next($this->questions);

        return $question;
    }

    public function answered()
    {
        return array_filter(
            $this->questions,
            fn($question) => $question->answered()
        );
    }

    public function solved()
    {
        return array_filter(
            $this->questions,
            fn($question) => $question->solved()
        );
    }

    public function count(): int
    {
        return count($this->questions);
    }
}