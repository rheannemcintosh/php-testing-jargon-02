<?php

namespace App;

class Quiz
{
    protected array $questions;
    protected int $questionPointer;

    public function __construct()
    {
        $this->questionPointer = 0;
    }

    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    public function nextQuestion()
    {
        $question = $this->questionPointer;
        $this->questionPointer++;
        return $this->questions[$question];
    }

    public function getQuestion(int $number)
    {
        return $this->questions[$number];
    }

    public function questions()
    {
        return $this->questions;
    }

    public function isComplete()
    {
        $answeredQuestions = count(
            array_filter(
                $this->questions,
                fn($question) => $question->answered()
            )
        );
        $totalQuestions = count($this->questions);

        return $answeredQuestions === $totalQuestions;
    }

    public function grade()
    {
        if (!$this->isComplete()) {
            throw new \Exception("This quiz has not yet been completed");
        }

        $correct = count($this->correctlyAnsweredQuestions());

        return ($correct / count($this->questions)) * 100;
    }

    protected function correctlyAnsweredQuestions()
    {
        return array_filter(
            $this->questions,
            fn($question) => $question->isCorrect()
        );
    }
}
