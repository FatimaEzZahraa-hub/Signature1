@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tableau de bord Étudiant</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Mes documents à signer</h3>
                            @if($documents->count() > 0)
                                <ul class="list-group">
                                    @foreach($documents as $document)
                                        <li class="list-group-item">
                                            {{ $document->title }}
                                            <span class="float-end">
                                                <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-primary">Signer</a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Aucun document à signer.</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h3>Mes contacts</h3>
                            @if($contacts->count() > 0)
                                <ul class="list-group">
                                    @foreach($contacts as $contact)
                                        <li class="list-group-item">
                                            {{ $contact->name }}
                                            <span class="float-end">
                                                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-primary">Voir</a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Aucun contact trouvé.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 