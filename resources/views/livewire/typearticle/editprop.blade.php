<div class="col">
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="editModalProp" style="z-index: 1900;" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edition propriété </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="p-4 border rounded">
                            <form class="row g-3 needs-validation" wire:submit.prevent="updateProp()" >
                                <div class="col-md-6">
                                    <input type="text" placeholder="Nom"  wire:model="editPropModel.nom" class="form-control @error("editPropModel.nom") is-invalid @enderror" id="nom" required="">
                                    @error("editPropModel.nom")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select @error("editPropModel.estObligatoire") is-invalid @enderror" id="estObligatoire" required="" wire:model="editPropModel.estObligatoire">
                                        <option selected="" value="">--Champ Obligatoire--</option>
                                        <option value="1">OUI</option>
                                        <option value="0">NON</option>
                                    </select>
                                    @error("editPropModel.estObligatoire")
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>