@extends('front.master')
@section('title')
    منو
@endsection
@section('body')

    <livewire:page.menu :categories="$categories" :products="$products" />
@endsection

