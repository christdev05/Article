    <!--breadcrumb-->
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="breadcrumb-title pe-3">Tables</div>
		<div class="ps-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 p-0">
					<li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Data Table</li>
				</ol>
			</nav>
		</div>
	</div>
	<!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Liste des types d'articles</h6>
	<hr/>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-3 col-xl-2">
							<button type="button" class="btn btn-primary mb-3 mb-lg-0" wire:click="toggleShowAddTypeArticleForm"><i class="bx bxs-plus-square"></i>Add Type Article</button>
						</div>
						<div class="col-lg-9 col-xl-10">
							<form class="float-lg-end">
								<div class="row row-cols-lg-auto g-2">
									<div class="col-12">
										<div class="position-relative">
											<input type="text" class="form-control ps-5"  wire:model.debounce.250ms="search" placeholder="Search User..."> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="" class="table table-striped table-bordered">
					<thead>
					    <tr>
						    <th style="width:30%;" class="text-center">Type Article</th>
						    <th style="width:30%;" class="text-center">Ajouté</th>
						    <th style="width:30%;" class="text-center">Action</th>
					    </tr>
					</thead>
					<tbody>

                        @if ($isAddTypeArticle)
                            <tr>
                                <td colspan="2">
                                    <input type="text" wire:keydown.enter="addNewTypeArticle" class="form-control @error('newTypeArticleName') is-invalid @enderror" wire:model="newTypeArticleName"/>
                                    @error('newTypeArticleName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" wire:click="addNewTypeArticle"> <i class="fadeIn animated bx bx-check"></i>
                                        Add</button>
                                    <button type="button" class="btn btn-danger" wire:click="toggleShowAddTypeArticleForm"> <i class="fadeIn animated bx bx-trash"></i>
                                        Cancel</button>
                                </td>
                            </tr>
                        @endif

                        @foreach ($typearticles as $typearticle)
                            <tr>
                                <td class="text-center" >{{$typearticle->nom}}</td>
                                <td class="text-center">{{ optional($typearticle->created_at)->diffForHumans() }}</td>
                                
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" wire:click="editTypeArticle({{$typearticle->id}})"><i class="fadeIn animated bx bx-edit"></i>Edit</button>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalProp" wire:click="showProp({{$typearticle->id}})"><i class="fadeIn animated bx bx-list-ol"></i>Propriete</button>
                                    @if(count($typearticle->articles) == 0)
                                        <button type="button" class="btn btn-danger" wire:click="confirmDelete('{{$typearticle->nom}}', {{$typearticle->id}})"><i class="fadeIn animated bx bx-trash"></i>Delete</button>
                                    @endif
                                </td>
                            </tr>	
                        @endforeach

					</tbody>
				</table>
			</div>
				<div class="text-center">
					{{ $typearticles->links() }}
				</div>
		</div>
	</div>