@extends('layouts.template')
<!-- Page Heading -->

<x-pageHolder title="Dashboard" icon="fas fa-home">
     <x-slot name="topAction">
         <a href="{{route('hands.exportHandsMondate')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Liste Hand Mondate</a> 
     </x-slot>
     @livewire('hands.hands-list',['actions'=>'details','paiementStatus'=>'all'])
</x-pageHolder>