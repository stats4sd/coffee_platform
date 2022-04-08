@extends('errors.layout')

@php
  $error_number = 403;
@endphp

@section('title')
{{ t('Forbidden.') }}
@endsection

@section('description')
  @php
    $default_error_message = t('"Please :go-back or return to :our-homepage', ['go-back' => '<a href="javascript:history.back()">go back</a>', 'our-homepage' => '<a href="'.url('').'">our homepage</a>."']);
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
