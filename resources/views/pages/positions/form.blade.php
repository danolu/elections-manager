@extends('layouts.app')

@section('title', 'Position Form')

@section('content')
  @if(isset($position))
    <livewire:positions.form :position="$position" />
  @else
    <livewire:positions.form />
  @endif
@endsection
