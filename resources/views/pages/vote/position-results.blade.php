@extends('layouts.app')

@section('title', 'Position Results')

@section('content')
  <livewire:vote.position-results :position="$position" />
@endsection
