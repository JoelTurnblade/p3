<?php

namespace App\Http\Controllers;

require 'Classes/Data.php';

use Illuminate\Http\Request;
use Custom\Data as Data;

class RequestController extends Controller
{
    public function submission()
    {
        $data = new Data($_POST);

        // Set $oppString
        if ($data->getOperation() != null) {
            if ($data->getOperation() == 'Add') {
                $oppString = ' + ';
            } else if ($data->getOperation() == 'Subtract') {
                $oppString = ' &#8722; ';
            } else if ($data->getOperation() == 'Multiply') {
                $oppString = ' &#215; ';
            } else if ($data->getOperation() == 'Divide') {
                $oppString = ' / ';
            }
        } else {
            $oppString = null;
        }

        // Calculate $result
        if ($data->getPreOpp() != null && $data->getFirstNum() != null && $data->getSecondNum() != null) {
            if ($data->getPreOpp() == 'Add') {
                $result = $data->getFirstNum() + $data->getSecondNum();
            } else if ($data->getPreOpp() == 'Subtract') {
                $result = $data->getFirstNum() - $data->getSecondNum();
            } else if ($data->getPreOpp() == 'Multiply') {
                $result = $data->getFirstNum() * $data->getSecondNum();
            } else if ($data->getPreOpp() == 'Divide') {
                $result = (int)($data->getFirstNum() / $data->getSecondNum());
            }
        } else {
            $result = null;
        }

        // Judge Answer
        $outputAnswer = null;
        $answer = 'Incorrect';
        $outputStyle = 'MessageBox Incorrect';
        if ((string)$result != null && $data->getUserAnswer() != null) {
            if ($result == $data->getUserAnswer()) {
                $outputAnswer = true;
                $answer = 'Correct';
                $outputStyle = 'MessageBox Correct';
            } else {
                $outputAnswer = true;
            }
        }
        if ($data->getErrors() != null) {
            $outputAnswer = true;
            $answer = $data->getErrors();
        }

        // Update Numbers: Correct Answer Recalculation
        if ($answer == 'Correct') {
            $data->randFirstNum();
            $data->randSecondNum();
        }

        // Update Numbers: New Length Parameters
        if ($data->getFirstNumDig() != null && $data->getSecondNumDig() != null) {
            if ($data->getFirstNum() != null && $data->getSecondNum() != null) {
                if (!$data->boundFirstNum() || !$data->boundSecondNum()) {
                    $data->randFirstNum();
                    $data->randSecondNum();
                }
            }
        }

        // Update Numbers: New Operation
        if ($data->getOperation() != null && $data->getPreOpp() != null) {
            if ($data->getOperation() != $data->getPreOpp()) {
                $data->randFirstNum();
                $data->randSecondNum();
            }
        }

        // Update Numbers: Blank Input
        if ($data->getUserAnswer() == null) {
            $data->randFirstNum();
            $data->randSecondNum();
        }

        // Set $dispString
        if ($data->getFirstNum() != null && $data->getSecondNum() != null && $oppString != null) {
            $dispString = $data->getFirstNum() . $oppString . $data->getSecondNum();
        } else {
            $dispString = '';
        }

        //
        //dump();
        //
        return view('forms.form')->with([
            'data' => $data,
            'dispString' => $dispString,
            'answer' => $answer,
            'outputAnswer' => $outputAnswer,
            'outputStyle' => $outputStyle
            ]);
        //
        //$testVar = 'Sample Text';
        //return view('forms.form')->with(['testVar' => $testVar]);

    }

}
