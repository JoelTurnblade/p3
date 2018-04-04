@extends('layouts.master')
@section('form')
    <form method='POST' action='/'>
        {{ csrf_field() }}
        Operation
        <select name='operation'>
            <option value='Add' @if(in_array(old('operation', ''), ['Add', ''])) {{ 'selected' }} @endif>Add</option>
            <option value='Subtract' @if(old('operation', '') == 'Subtract') {{ 'selected' }} @endif>Subtract</option>
            <option value='Multiply' @if(old('operation', '') == 'Multiply') {{ 'selected' }} @endif>Multiply</option>
            <option value='Divide' @if(old('operation', '') == 'Divide') {{ 'selected' }} @endif>Int Divide</option>
        </select>
        <input type='hidden' name='preOperation' value='{{ $operation or old('operation', '') }}'>
        <br>
        Digits in first number
        <input type='radio' name='firstNumDig' value='1' @if(in_array(old('firstNumDig'), ['1', ''])) {{ 'checked' }} @endif>1
        <input type='radio' name='firstNumDig' value='2' @if(old('firstNumDig', '') == '2') {{ 'checked' }} @endif>2
        <input type='radio' name='firstNumDig' value='3' @if(old('firstNumDig', '') == '3') {{ 'checked' }} @endif>3
        <input type='radio' name='firstNumDig' value='4' @if(old('firstNumDig', '') == '4') {{ 'checked' }} @endif>4
        <input type='hidden' name='preFirstNumDig' value='{{ $firstNumDig or old('operation', '') }}'>
        <br>
        Digits in second number
        <input type='radio' name='secondNumDig' value='1' @if(in_array(old('secondNumDig'), ['1', ''])) {{ 'checked' }} @endif>1
        <input type='radio' name='secondNumDig' value='2' @if(old('secondNumDig', '') == '2') {{ 'checked' }} @endif>2
        <input type='radio' name='secondNumDig' value='3' @if(old('secondNumDig', '') == '3') {{ 'checked' }} @endif>3
        <input type='radio' name='secondNumDig' value='4' @if(old('secondNumDig', '') == '4') {{ 'checked' }} @endif>4
        <input type='hidden' name='preSecondNumDig' value='{{ $secondNumDig or old('operation', '') }}'>
        <br>
        <p>{!! $displayString or old('displayString', '<br>') !!}</p>
        <input type='hidden' name='displayString' value='{{ $displayString or old('displayString', '') }}'>
        <input type='hidden' name='firstNum' value='{{ $firstNum or old('firstNum', '') }}'>
        <input type='hidden' name='secondNum' value='{{ $secondNum or old('secondNum', '') }}'>
        <input type='hidden' name='correctAnswer' value='{{ $correctAnswer or old('correctAnswer', '') }}'>
        <input type='text' name='userAnswer' value=@if($errors->any()) '{{ old('userAnswer', '') }}' @else {{ '' }} @endif>
        <br>
        <input type='submit' value='check answer / generate'>
    </form>
    @if($errors->any())
        <p class ='MessageBox Incorrect'>@foreach($errors->all() as $error) {{ $error }} @endforeach</p>
    @else
        <p class='{{ $outputStyle or '' }}'>{{ $outputString or '' }}</p>
    @endif
@endsection