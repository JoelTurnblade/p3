<?php
namespace Custom;

class Data
{
    // Internal Variables
    private $operation;
    private $firstNumDig;
    private $secondNumDig;
    private $firstNum;
    private $secondNum;
    private $userAnswer;
    private $preOpp;

    private $errors;

    // Set Internal Variables
    public function update($post)
    {
        $this->operation = null;
        if (isset($post['operation'])) {
            if ($post['operation'] != '') {
                $this->operation = $post['operation'];
            }
        }

        $this->firstNumDig = null;
        if (isset($post['firstNumDig'])) {
            if ($post['firstNumDig'] != '') {
                $this->firstNumDig = (int)$post['firstNumDig'];
            }
        }

        $this->secondNumDig = null;
        if (isset($post['secondNumDig'])) {
            if ($post['secondNumDig'] != '') {
                $this->secondNumDig = (int)$post['secondNumDig'];
            }
        }

        $this->firstNum = null;
        if (isset($post['firstNum'])) {
            if ($post['firstNum'] != '') {
                $this->firstNum = (int)$post['firstNum'];
            }
        }

        $this->secondNum = null;
        if (isset($post['secondNum'])) {
            if ($post['secondNum'] != '') {
                $this->secondNum = (int)$post['secondNum'];
            }
        }

        // This is the only input that needs to be sanitized
        $this->errors = null;
        $this->userAnswer = null;
        if (isset($post['userAnswer'])) {
            if ($post['userAnswer'] != '') {
                $this->userAnswer = htmlentities($post['userAnswer'], ENT_QUOTES, "UTF-8");
                //$this->userAnswer = convertHtmlEntities($post['userAnswer']);
                $this->errors = is_numeric($this->userAnswer) ? null : 'Please enter a number';
            }
        }

        $this->preOpp = null;
        if (isset($post['preOpp'])) {
            if ($post['preOpp'] != '') {
                $this->preOpp = $post['preOpp'];
            }
        }
    }

    // Get Internal Variable Values
    public function getOperation()
    {
        return $this->operation;
    }

    public function getFirstNumDig()
    {
        return $this->firstNumDig;
    }

    public function getSecondNumDig()
    {
        return $this->secondNumDig;
    }

    public function getFirstNum()
    {
        return $this->firstNum;
    }

    public function getSecondNum()
    {
        return $this->secondNum;
    }

    public function getUserAnswer()
    {
        return $this->userAnswer;
    }

    public function getPreOpp()
    {
        return $this->preOpp;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    // Re-Randomize Numbers
    public function randFirstNum()
    {
        if ($this->firstNumDig != null) {
            $this->firstNum = rand((int)10 ** ($this->firstNumDig - 1), ((int)10 ** $this->firstNumDig) - 1);
        }
    }

    public function randSecondNum()
    {
        if ($this->secondNumDig != null) {
            $this->secondNum = rand((int)10 ** ($this->secondNumDig - 1), ((int)10 ** $this->secondNumDig) - 1);
        }
    }

    // Determine if numbers are in bounds
    public function boundFirstNum()
    {
        $output = false;
        if ($this->firstNumDig != null && $this->firstNum != null) {
            if ($this->firstNum <= ((int)10 ** $this->firstNumDig - 1)) {
                if ((int)10 ** ($this->firstNumDig - 1) <= $this->firstNum) {
                    $output = true;
                }
            }
        }

        return $output;
    }

    public function boundSecondNum()
    {
        $output = false;
        if ($this->secondNumDig != null && $this->secondNum != null) {
            if ($this->secondNum <= ((int)10 ** $this->secondNumDig) - 1) {
                if ((int)10 ** ($this->secondNumDig - 1) <= $this->secondNum) {
                    $output = true;
                }
            }
        }

        return $output;
    }

    // Constructor Function
    public function __construct($post = null)
    {
        // gets and sanitizes all the variables
        $this->update($post);

        // If necessary, sets the numbers to appropriate random values
        if ($this->firstNumDig && !$this->firstNum) {
            $this->randFirstNum();
        }

        if ($this->secondNumDig && !$this->secondNum) {
            $this->randSecondNum();
        }
    }
}