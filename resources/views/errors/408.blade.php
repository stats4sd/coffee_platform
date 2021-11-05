@extends('errors.layout')

@php
  $error_number = 408;
@endphp

@section('title')
{{ t('Request timeout.') }}
@endsection

@section('description')
  @php
    $default_error_message = t('"Please :go-back, refresh the page and try again.', ['go-back' => '<a href="javascript:history.back()">go back</a>']);

  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
