@extends('layouts.app')

@section('title', 'Candidate Form')

@section('content')
  @if(isset($candidate))
    <livewire:candidates.form :candidate="$candidate" />
  @else
    <livewire:candidates.form />
  @endif
@endsection
