@extends('layouts.app')

@section('title', 'Vote')

@section('content')
  <livewire:vote.position :position="$position" />
@endsection
