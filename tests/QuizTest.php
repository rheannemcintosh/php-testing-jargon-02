<?php

namespace Tests;

use App\Quiz;
use App\Question;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    /**
     * @test
     */
    public function it_consists_of_questions()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $this->assertCount(1, $quiz->questions());
    }

    /**
     * @test
     */
    public function it_grades_a_perfect_quiz()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $question = $quiz->nextQuestion();

        $question->answer(4);

        $this->assertEquals(100, $quiz->grade());
    }

    /**
     * @test
     */
    public function it_grades_a_failed_quiz()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $question = $quiz->nextQuestion();

        $question->answer('incorrect');

        $this->assertEquals(0, $quiz->grade());
    }

    /**
     * @test
     */
    public function it_correctly_tracks_the_next_question_in_the_queue()
    {
        $quiz = new Quiz();
        
        $quiz->addQuestion(new Question("What is 2 + 2?", 4));
        $quiz->addQuestion(new Question("What is 3 * 3?", 9));

        $questionOne = $quiz->nextQuestion();
        $questionTwo = $quiz->nextQuestion();

        $this->assertEquals($questionTwo, $quiz->getQuestion(1));
    }

    public function it_returns_false_if_there_are_no_remaining_next_questions()
    {
        $quiz = new Quiz();
        
        $quiz->addQuestion(new Question("What is 2 + 2?", 4));

        $quiz->nextQuestion();
        $this->assertFalse($quiz->nextQuestion());
    }

    /**
     * @test
     */
    public function it_cannot_be_graded_until_all_questions_have_been_answered()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2 + 2?", 4));
        $quiz->addQuestion(new Question("What is 3 * 3?", 9));
        $quiz->addQuestion(new Question("What is 7 - 3?", 4));
        $quiz->addQuestion(new Question("What is 81 / 9?", 9));

        $this->expectException(\Exception::class);

        $quiz->grade();
    }
}
