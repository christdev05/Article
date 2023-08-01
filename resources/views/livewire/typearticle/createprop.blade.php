<div class="col">
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="modalProp" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gestion des caracteristique de "{{ optional($selectedTypeArticle)->nom }}" </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" wire:submit.prevent="addProp()" >
                                <div class="col-md-6">
                                    <input type="text" placeholder="Nom"  wire:model="newPropModel.nom" class="form-control @error("newPropModel.nom") is-invalid @enderror" id="nom" required="">
                                    @error("newPropModel.nom")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select @error("newPropModel.estObligatoire") is-invalid @enderror" id="estObligatoire" required="" wire:model="newPropModel.estObligatoire">
                                        <option selected="" value="">--Champ Obligatoire--</option>
                                        <option value="1">OUI</option>
                                        <option value="0">NON</option>
                                    </select>
                                    @error("newPropModel.estObligatoire")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <button class="btn btn-primary form-control" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Nom</th>
                            <th>Est obligatoire</th>
                            <th style="width:30%;" class="text-center">Action</th>
                        </thead>
                        <tbody>
                            @forelse ($proprietesTypeArticles as $prop)
                                <tr>
                                    <td>{{ $prop->nom }}</td>
                                    <td>{{ $prop->estObligatoire == 0 ? "NON": "OUI" }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-link" wire:click="editProp({{$prop->id}})" data-bs-toggle="modal" data-bs-target="#editModalProp"><i class="fadeIn animated bx bx-edit"></i> </button>
                                        @if(count($prop->articles)==0)
                                            <button class="btn btn-link" wire:click="showDeletePrompt('{{$prop->nom}}', {{$prop->id}})"><i class="fadeIn animated bx bx-trash"></i> </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <span class="text-info">Vous n'avez pas encore des propriétés définies pour ce type d'article</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>