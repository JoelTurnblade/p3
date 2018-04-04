<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        $firstNum = old('firstNum', rand((int)10 ** (1 - 1), ((int)10 ** 1) - 1));
        $secondNum = old('secondNum', rand((int)10 ** (1 - 1), ((int)10 ** 1) - 1));
        $correctAnswer = old('correctAnswer',$firstNum + $secondNum);
        $displayString = old('displayString', (string)$firstNum . ' + ' . (string)$secondNum);
        $operation = old('operation', 'Add');
        $firstNumDig = old('firstNumDig', 1);
        $secondNumDig = old('secondNumDig', 1);


        return view('forms.form')->with([
            'firstNum' => $firstNum,
            'secondNum' => $secondNum,
            'correctAnswer' => $correctAnswer,
            'displayString' => $displayString,
            'operation' => $operation,
            'firstNumDig' => $firstNumDig,
            'secondNumDig' => $secondNumDig
            ]);
    }
}
