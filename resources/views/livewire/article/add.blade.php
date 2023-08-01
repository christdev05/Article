<div class="modal fade" id="modalAdd" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="ajoutArticle" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($errors->any())
                                    <div class="alert alert-danger">

                                        <h5><i class="icon fas fa-ban"></i> Erreurs!</h5>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                            @endif

                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text" wire:model="addArticle.nom" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Numero de serie</label>
                                <input type="text" wire:model="addArticle.noSerie" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select  class="form-select" wire:model="addArticle.type">
                                    <option value=""></option>
                                    @foreach ($typearticles as $typearticle)
                                        <option value="{{$typearticle->id}}">{{ $typearticle->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Les champs dynamiques qui seront crées par rapport au type selectionné --}}
                            @if($proprietesArticles != null) <br>
                            <p style="border: 1px dashed black;"></p>
                            <div class="my-3 bg-gray-light">
                                @foreach($proprietesArticles as $propriete)
                                    <div class="form-group">
                                        <label for=""> {{$propriete->nom}} @if(!$propriete->estObligatoire) (optionel) @endif
                                        </label>

                                        @php
                                        $field = "addArticle.prop.".$propriete->nom;
                                        @endphp

                                        <input type="text" wire:model="{{ $field }}"  class="form-control">
                                    </div>
                                @endforeach
                            </div>
                            @endif

                        </div>

                        <div class="col-md-6" >
                            <div class="form-group mt-6">
                                <input type="file" class="form-control" wire:model="addPhoto" id="image{{$inputFileIterator}}" style="margin-bottom: 17px; margin-top: 20px;">
                            </div>
                            <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                    @if ($addPhoto)
                                        <img src="{{ $addPhoto->temporaryUrl() }}" style="height:200px; width:200px;">
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>