@extends('layouts.template')

<x-pageHolder title="Attestation administrative" icon="far fa-file-word">
      @livewire('hands.hands-list',['actions'=>'attestation','type'=>$type])
</x-pageHolder>