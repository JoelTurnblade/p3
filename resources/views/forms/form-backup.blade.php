@extends('layouts.master')

@section
    <form method='POST' action='index.php'>
        Operation
        <select name='operation'>
            <option value='Add' <?= ($data->getOperation() == 'Add') ? 'selected' : '' ?>>Add</option>
            <option value='Subtract' <?= ($data->getOperation() == 'Subtract') ? 'selected' : '' ?>>Subtract</option>
            <option value='Multiply' <?= ($data->getOperation() == 'Multiply') ? 'selected' : '' ?>>Multiply</option>
            <option value='Divide' <?= ($data->getOperation() == 'Divide') ? 'selected' : '' ?>>Int Divide</option>
        </select>
        <br>
        Digits in first number
        <input type='radio' name='firstNumDig' value='1' <?= ($data->getFirstNumDig() == 1 ||
            $data->getFirstNumDig() == null) ? 'checked' : '' ?>>1
        <input type='radio' name='firstNumDig' value='2' <?= ($data->getFirstNumDig() == 2) ? 'checked' : '' ?>>2
        <input type='radio' name='firstNumDig' value='3' <?= ($data->getFirstNumDig() == 3) ? 'checked' : '' ?>>3
        <input type='radio' name='firstNumDig' value='4' <?= ($data->getFirstNumDig() == 4) ? 'checked' : '' ?>>4
        <br>
        Digits in second number
        <input type='radio' name='secondNumDig' value='1' <?= ($data->getSecondNumDig() == 1 ||
            $data->getSecondNumDig() == null) ? 'checked' : '' ?>>1
        <input type='radio' name='secondNumDig' value='2' <?= ($data->getSecondNumDig() == 2) ? 'checked' : '' ?>>2
        <input type='radio' name='secondNumDig' value='3' <?= ($data->getSecondNumDig() == 3) ? 'checked' : '' ?>>3
        <input type='radio' name='secondNumDig' value='4' <?= ($data->getSecondNumDig() == 4) ? 'checked' : '' ?>>4
        <br>
        <p><?= $dispString != '' ? $dispString : '<br>' ?></p>
        <input type='text' name='userAnswer' value='<?= $data->getErrors() != null ? $data->getUserAnswer() : '' ?>'>
        <br>
        <input type='submit' value='check answer / generate'>
        <input type='hidden' name='firstNum' value='<?= $data->getFirstNum() ?>'>
        <input type='hidden' name='secondNum' value='<?= $data->getSecondNum() ?>'>
        <input type='hidden' name='preOpp' value='<?= $data->getOperation() ?>'>
    </form>
@endsection