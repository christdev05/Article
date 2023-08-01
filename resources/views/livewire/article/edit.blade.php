<div class="col">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateArticle" enctype="multipart/form-data">
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
                                    <input type="text" wire:model="editArticle.nom" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Numero de serie</label>
                                    <input type="text" wire:model="editArticle.noSerie" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select  class="form-select" wire:model="editArticle.type_article_id">
                                        <option value="{{ $editArticle["type_article_id"] }}">{{ $editArticle["type"]["nom"] }}</option>
                                    </select>
                                </div>

                                {{-- Les champs dynamiques qui seront crées par rapport au type selectionné --}}
                                @if($editArticle["article_proprietes"] != []) <br>
                                    <p style="border: 1px dashed black;"></p>
                                    <div class="my-3 bg-gray-light">
                                        @foreach($editArticle["article_proprietes"] as $index => $articlePropriete)
                                            <div class="form-group">
                                                <label for=""> {{$articlePropriete["propriete"]["nom"]}} @if(!$articlePropriete["propriete"]["estObligatoire"]) (optionel) @endif
                                                </label>

                                                <input type="text" wire:model="editArticle.article_proprietes.{{ $index }}.valeur"  class="form-control">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6" >
                                <div class="form-group mt-6">
                                    <input type="file" class="form-control" wire:model="editPhoto" id="image{{$inputEditFileIterator}}" style="margin-bottom: 17px; margin-top: 20px;">
                                </div>
                                <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                    @if (isset($editPhoto))

                                        <img src="{{ $editPhoto->temporaryUrl() }}" style="height:200px; width:200px;">

                                    @else

                                        <img src="{{ asset($editArticle["imageUrl"]) }}" style="height:200px; width:200px;">

                                    @endif
                                </div>
                                @isset($editPhoto)
                                <div>
                                    <button
                                    type="button" 
                                    class="btn btn-default btn-sm mt-2"
                                    wire:click="$set('editPhoto', null)"
                                    >Réinitialiser</button>    
                                </div> 
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeEditModal">Close</button>
                        @if( $editHasChanged)
                        <button type="submit" class="btn btn-primary">Update</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

