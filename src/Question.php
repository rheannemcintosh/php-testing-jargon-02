<?php

namespace App;

class Question
{
    protected $body;
    protected $solution;
    protected $answer;
    protected $solved;

    public function __construct($body, $solution)
    {
        $this->body = $body;
        $this->solution = $solution;
    }

    public function answered()
    {
        return isset($this->answer);
    }

    public function answer($answer)
    {
        $this->answer = $answer;

        return $this->solved();
    }

    public function solved()
    {
        return $this->answer ===  $this->solution;
    }
}
