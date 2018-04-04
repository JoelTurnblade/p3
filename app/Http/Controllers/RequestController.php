<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function submission(Request $request)
    {
        // # Retain Old Inputs
        $request->flash();


        // # Set Input Variables
        // ### Required Variables
        // These variables must be properly defined.  The form.blade will ensure that this happens.
        $operation = $request->input('operation');
        $firstNumDig = (int)$request->input('firstNumDig');
        $secondNumDig = (int)$request->input('secondNumDig');
        // ### Validate User Answer
        // The user input must be an integer or blank
        $this->validate($request, ['userAnswer' => 'nullable|integer']);
        // If the validation passes, the program will continue
        $userAnswer = $request->input('userAnswer', null);
        if(isset($userAnswer)) {
            $userAnswer = (int)$userAnswer;
        }


        // # Process the Request
        // - Case 1: Correct Answer
        //   - Display the Correct message
        //   - Recalculate based on the most recent number length and operation inputs
        //   - Set the output style to MessageBox Correct
        // - Case 2: Incorrect Answer with no change in number length and operation inputs
        //   - Display the Incorrect message
        //   - Maintain the numbers for the next attempt
        //   - Set the output style to MessageBox Incorrect
        // - Case 3: Incorrect Answer with a change in the number length and operation inputs
        //   - Display the Incorrect message
        //   - Recalculate based on the most recent number length and operation inputs
        //   - - Set the output style to MessageBox Incorrect
        // - Case 4: Blank Input
        //   - Recalculate based on the most recent number length and operation inputs
        //   - Set the output style to null
        // ### Default variable values
        $outputString = '';
        $firstNum = 0;
        $secondNum = 0;
        // ### Case 1: Correct Answer
        if($userAnswer == old('correctAnswer') && isset($userAnswer)) {
            $outputString = 'Correct';
            $firstNum = rand((int)10 ** ($firstNumDig - 1), ((int)10 ** $firstNumDig) - 1);
            $secondNum = rand((int)10 ** ($secondNumDig - 1), ((int)10 ** $secondNumDig) - 1);
            $outputStyle = 'MessageBox Correct';
        }
        // ### Case 2: Incorrect Answer with no change in number length and operation inputs
        if($userAnswer != old('correctAnswer') && isset($userAnswer)) {
            if($firstNumDig == old('preFirstNumDig')) {
                if($secondNumDig == old('preSecondNumDig')) {
                    if($operation == old('preOperation')) {
                        $outputString = 'Incorrect';
                        $firstNum = old('firstNum');
                        $secondNum = old('secondNum');
                        $outputStyle = 'MessageBox Incorrect';
                    }
                }
            }
        }
        // ### Case 3: Incorrect Answer with a change in the number length and operation inputs
        if($userAnswer != old('correctAnswer') && isset($userAnswer)) {
            if($firstNumDig != old('preFirstNumDig') ||
                $secondNumDig != old('preSecondNumDig') ||
                $operation != old('preOperation')) {
                    $outputString = 'Incorrect';
                    $firstNum = rand((int)10 ** ($firstNumDig - 1), ((int)10 ** $firstNumDig) - 1);
                    $secondNum = rand((int)10 ** ($secondNumDig - 1), ((int)10 ** $secondNumDig) - 1);
                    $outputStyle = 'MessageBox Incorrect';
            }
        }
        // ### Case 4: Blank Input
        if(!isset($userAnswer)) {
            $firstNum = rand((int)10 ** ($firstNumDig - 1), ((int)10 ** $firstNumDig) - 1);
            $secondNum = rand((int)10 ** ($secondNumDig - 1), ((int)10 ** $secondNumDig) - 1);
            $outputStyle = null;
        }


        // # Generate the Display String and calculate the correct answer
        // ### Set the operation
        if(isset($operation)) {
            if($operation == 'Add') {
                $displayString = ' + ';
            } else if($operation == 'Subtract') {
                $displayString = ' &#8722; ';
            } else if($operation == 'Multiply') {
                $displayString = ' &#215; ';
            } else if($operation == 'Divide') {
                $displayString = ' / ';
            } else {
                $displayString = '';
            }
        } else {
            $displayString = '';
        }
        // ### Add the first number
        if(isset($firstNum)) {
            $displayString = (string)$firstNum . ' ' . $displayString;
        } else {
            $displayString = 'num 1 error' . ' ' . $displayString;
        }
        // ### Add the second number
        if(isset($secondNum)) {
            $displayString = $displayString . ' ' . (string)$secondNum;
        } else {
            $displayString = $displayString . ' ' . 'num 2 error';
        }
        // ### Calculate the true answer
        if(isset($operation) && isset($firstNum) && isset($secondNum)) {
            if($operation == 'Add') {
                $correctAnswer = $firstNum + $secondNum;
            } else if($operation == 'Subtract') {
                $correctAnswer = $firstNum - $secondNum;
            } else if($operation == 'Multiply') {
                $correctAnswer = $firstNum * $secondNum;
            } else if($operation == 'Divide') {
                $correctAnswer = (int)($firstNum / $secondNum);
            } else {
                $correctAnswer = null;
            }
        } else {
            $correctAnswer = null;
        }


        // # Return the view
        return view('forms.form')->with([
            'displayString' => $displayString,
            'firstNum' => $firstNum,
            'secondNum' => $secondNum,
            'correctAnswer' => $correctAnswer,
            'outputString' => $outputString,
            'operation' => $operation,
            'firstNumDig' => $firstNumDig,
            'secondNumDig' => $secondNumDig,
            'outputStyle' => $outputStyle
            ]);
    }
}