@extends('layouts.app')

@section('content')
    <h1>Magazine Details</h1>

    <p>Code: {{ $document->getCode() }}</p>
    <p>Publisher: {{ $document->getPublisher() }}</p>
    <p>Release Count: {{ $document->getReleaseCount() }}</p>
    <p>Issue Number: {{ $document->getIssueNumber() }}</p>
    <p>Month: {{ $document->getMonth() }}</p>
@endsection
