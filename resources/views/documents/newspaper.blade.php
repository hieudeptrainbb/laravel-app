@extends('layouts.app')

@section('content')
    <h1>Newspaper Details</h1>

    <p>Code: {{ $document->getCode() }}</p>
    <p>Publisher: {{ $document->getPublisher() }}</p>
    <p>Release Count: {{ $document->getReleaseCount() }}</p>
    <p>Publish Date: {{ $document->getPublishDate() }}</p>
@endsection
