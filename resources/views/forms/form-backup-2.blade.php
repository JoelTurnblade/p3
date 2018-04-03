@extends('layouts.master')

@section('form')
    <form method='POST' action='/'>
        {{ csrf_field() }}
        Operation
        <select name='operation'>
            <option value='Add'>Add</option>
            <option value='Subtract'>Subtract</option>
            <option value='Multiply'>Multiply</option>
            <option value='Divide'>Int Divide</option>
        </select>
        <br>
        <input type='submit' value='check answer / generate'>
    </form>
@endsection