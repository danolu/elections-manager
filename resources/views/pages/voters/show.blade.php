@extends('layouts.app')

@section('title', 'Voter')

@section('content')
  <livewire:voters.show :user="$user" />
@endsection
