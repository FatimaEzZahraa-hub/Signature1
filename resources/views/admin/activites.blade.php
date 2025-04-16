@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Activités des utilisateurs</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Utilisateur</th>
                                    <th>Action</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activites as $activite)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($activite->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @php
                                                $user = \App\Models\User::find($activite->causer_id);
                                                echo $user ? $user->name : 'Utilisateur inconnu';
                                            @endphp
                                        </td>
                                        <td>{{ $activite->description }}</td>
                                        <td>
                                            @if($activite->properties)
                                                <pre class="mb-0">{{ json_encode($activite->properties, JSON_PRETTY_PRINT) }}</pre>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 