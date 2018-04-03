@extends('layouts.master')

{{--
- Submit is still broken
- I am experimenting with replacing the echo statements in the 'Operation' section.
It looks good overall
- Maybe I can implement 'old' for the presets.
 --}}

@section('form')
    <form method='POST' action='/'>
        {{ csrf_field() }}
        Operation
        <select name='operation'>
            <option value='Add' @if($data->getOperation() == 'Add') {{ 'selected' }} @endif>Add</option>
            <option value='Subtract' @if($data->getOperation() == 'Subtract') {{ 'selected' }} @endif>Subtract</option>
            <option value='Multiply' @if($data->getOperation() == 'Multiply') {{ 'selected' }} @endif>Multiply</option>
            <option value='Divide' @if($data->getOperation() == 'Divide') {{ 'selected' }} @endif>Int Divide</option>
        </select>
        <br>
        Digits in first number
        <input type='radio' name='firstNumDig' value='1' @if($data->getFirstNumDig() == 1 ||
            $data->getFirstNumDig() == null) {{ 'checked' }} @endif>1
        <input type='radio' name='firstNumDig' value='2' @if($data->getFirstNumDig() == 2) {{ 'checked' }} @endif>2
        <input type='radio' name='firstNumDig' value='3' @if($data->getFirstNumDig() == 3) {{ 'checked' }} @endif>3
        <input type='radio' name='firstNumDig' value='4' @if($data->getFirstNumDig() == 4) {{ 'checked' }} @endif>4
        <br>
        Digits in second number
        <input type='radio' name='secondNumDig' value='1' @if($data->getSecondNumDig() == 1 ||
            $data->getSecondNumDig() == null) {{ 'checked' }} @endif>1
        <input type='radio' name='secondNumDig' value='2' @if($data->getSecondNumDig() == 2) {{ 'checked' }} @endif>2
        <input type='radio' name='secondNumDig' value='3' @if($data->getSecondNumDig() == 3) {{ 'checked' }} @endif>3
        <input type='radio' name='secondNumDig' value='4' @if($data->getSecondNumDig() == 4) {{ 'checked' }} @endif>4
        <br>
        <p>@if($dispString != '') {!! $dispString !!} @else {!! '<br>' !!} @endif</p>
        <input type='text' name='userAnswer' value='@if($data->getErrors() != null) {{ $data->getUserAnswer() }} @endif'>
        <br>
        <input type='submit' value='check answer / generate'>
        <input type='hidden' name='firstNum' value='{{ $data->getFirstNum() }}'>
        <input type='hidden' name='secondNum' value='{{ $data->getSecondNum() }}'>
        <input type='hidden' name='preOpp' value='{{ $data->getOperation() }}'>
    </form>
    <p class='@if(!empty($outputAnswer)) {{ $outputStyle }} @endif'>
        @if(!empty($outputAnswer)) {{ $answer }} @endif
    </p>
@endsection