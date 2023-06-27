//?//?Instructions
//?Bob is a lackadaisical teenager. In conversation, his responses are very limited.
//?
//?Bob answers 'Sure.' if you ask him a question, such as "How are you?".
//?
//?He answers 'Whoa, chill out!' if you YELL AT HIM (in all capitals).
//?
//?He answers 'Calm down, I know what I'm doing!' if you yell a question at him.
//?
//?He says 'Fine. Be that way!' if you address him without actually saying anything.
//?
//?He answers 'Whatever.' to anything else.
//?
//?Bob's conversational partner is a purist when it comes to written communication and always follows normal rules regarding sentence punctuation in English.
//?
//?The commented tests at the bottom of the bob_test.php are Stretch Goals, they are optional. They may be easier to solve if you are using the mb_string functions, which aren't installed by default with every version of PHP.
<?php
    //values for example
    declare(strict_types=1);
    class Bob
{
    public function respondTo(string $str): string
    {
        $str = trim($str);

        if (empty($str)) {
            return "Fine. Be that way!";
        } elseif ($this->isQuestion($str) && $this->isYelling($str)) {
            return "Calm down, I know what I'm doing!";
        } elseif ($this->isQuestion($str)) {
            return "Sure.";
        } elseif ($this->isYelling($str)) {
            return "Whoa, chill out!";
        }

        return "Whatever.";
    }

    private function isQuestion(string $str): bool
    {
        return substr($str, -1) === "?";
    }

    private function isYelling(string $str): bool
    {
        return $str === strtoupper($str) && preg_match("/[a-zA-Z]/", $str);
    }
}
?>
