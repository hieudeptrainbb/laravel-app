@extends('layouts.app')

@section('content')
    <h1>Document Details</h1>

    <p>Code: {{ $document->getCode() }}</p>
    <p>Title: {{ $document->getTitle() }}</p>
    <p>Author: {{ $document->getAuthor() }}</p>
@endsection
