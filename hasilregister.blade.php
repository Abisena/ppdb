@extends('layout.navbar')

@section('layout')

<h6>Nama : {{Auth::user()->email}}</h6>

<script>
    window.print()
</script>
@endsection