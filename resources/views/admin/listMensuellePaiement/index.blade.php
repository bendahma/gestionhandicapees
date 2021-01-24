@extends('layouts.template')

<x-pageHolder title="Paiement Des Handicapées Du Mois {{DateTime::createFromFormat('!m', $paie->moisPaiement)->format('F') . ' ' . $paie->anneesPaiement}} " icon="fas fa-file-invoice-dollar">
     <x-slot name="topAction">
         <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-excel"></i> <i class="fas fa-download fa-sm text-white-50"></i> Téléchargé </a> 
     </x-slot>
     @livewire('hands.hands-list',['actions'=>'details'])
</x-pageHolder>