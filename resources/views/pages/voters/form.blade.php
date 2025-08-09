@extends('layouts.app')

@section('title', 'Voter Form')

@section('content')
  @if(isset($user))
    <livewire:voters.form :user="$user" />
  @else
    <livewire:voters.form />
  @endif
@endsection
