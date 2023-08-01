<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">Forms</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
			</ol>
		</nav>
	</div>
	<div class="ms-auto">
		<div class="btn-group">
			<button type="button" class="btn btn-primary"  wire:click='goToListUser()'>Users List</button>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-12 mx-auto">
		<h6 class="mb-0 text-uppercase">Edit User</h6>
		<hr>
		<div class="card">
			<div class="card-body">
				<div class="p-2 border rounded">
					<form class="row g-3 needs-validation" wire:submit.prevent="updateUser()" >
						<div class="col-md-6">
					        <label for="nom" class="form-label">Nom</label>
							<input type="text" class="form-control @error('editUser.nom') is-invalid @enderror" id="nom" wire:model="editUser.nom">
							@error("editUser.nom")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="prenom" class="form-label">Prenom</label>
							<input type="text" class="form-control @error('editUser.prenom') is-invalid @enderror" id="prenom" wire:model="editUser.prenom">
							@error("editUser.prenom")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="col-md-6">
					        <label for="sexe" class="form-label">Sexe</label>
							<select class="form-select mb-3 @error('editUser.sexe') is-invalid @enderror" aria-label="Default select example" wire:model="editUser.sexe">
								<option selected="">Select sexe</option>
								<option value="H">Homme</option>
								<option value="F">Femme</option>
							</select>
                            @error("editUser.sexe")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="email" class="form-label">Address E-mail</label>
							<input type="text" class="form-control @error('editUser.email') is-invalid @enderror" id="email" wire:model="editUser.email">
							@error("editUser.email")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="col-md-6">
					        <label for="telephone1" class="form-label">Telephone 1</label>
							<input type="text" class="form-control @error('editUser.telephone1') is-invalid @enderror" id="telephone1" wire:model="editUser.telephone1">
							@error("editUser.telephone1")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="telephone2" class="form-label">Telephone 2</label>
							<input type="text" class="form-control @error('editUser.telephone2') is-invalid @enderror" id="telephone2" wire:model="editUser.telephone2">
							@error("editUser.telephone2")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                          <div class="col-md-6">
					        <label for="sexe" class="form-label">Piece Identité</label>
							<select class="form-select mb-3 @error('editUser.pieceIdentite') is-invalid @enderror" aria-label="Default select example" wire:model="editUser.pieceIdentite">
								<option selected="">Select Piece Identite</option>
								<option value="CNI">CNI</option>
								<option value="PASSPORT">PASSPORT</option>
                                <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
							</select>
                            @error("editUser.pieceIdentite")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="Numero de piece d'identité" class="form-label">Numero de piece d'identité</label>
							<input type="text" class="form-control @error('editUser.numeroPieceIdentite') is-invalid @enderror" id="numeroPieceIdentite" wire:model="editUser.numeroPieceIdentite">
							@error("editUser.numeroPieceIdentite")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="col-md-6">
					        <label for="prenom" class="form-label">Mot de passe</label>
							<input type="text" class="form-control"  disabled placeholder="Password" >
						</div>
						<div class="col-12">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="page-content">
	<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
		<div class="col">
			<h6 class="mb-0 text-uppercase">List Role</h6>
			<hr>
			<div class="card">
				<div class="card-body">
					<ul class="list-group">
						@foreach($rolePermissions["roles"] as $role)
							<li class="list-group-item d-flex justify-content-between align-items-center">
								{{$role["role_nom"]}}
								<div class="form-check form-switch">
									<input 
										class="form-check-input form-control"
										wire:model.lazy="rolePermissions.roles.{{$loop->index}}.active"
										@if($role["active"]) 
											checked 
										@endif 
										type="checkbox" 
										id="flexSwitchCheckDefault{{$role['role_id']}}"
									>
									<label 
										class="custom-control-label" 
										for="customSwitch{{$role['role_id']}}"
									> 
										{{ $role["active"]? "Activé" : "Desactivé" }}
									</label>
								</div>
							</li>
						@endforeach
					
					</ul>
				</div>
			</div>
		</div>
		<div class="col">
			<h6 class="mb-0 text-uppercase">List Permission</h6>
			<hr>
			<div class="card">
				<div class="card-body">
					<ul class="list-group">
						@foreach($rolePermissions["permissions"] as $permission)
						<li class="list-group-item d-flex justify-content-between align-items-center">
							{{ $permission["permission_nom"] }}
							<div class="form-check form-switch">
								<input 
									class="form-check-input form-control"
									wire:model.lazy="rolePermissions.permissions.{{$loop->index}}.active"
									@if($permission["active"]) checked @endif 
									type="checkbox" 
									id="flexSwitchCheckDefaultPermission{{$permission['permission_id']}}"
								>
								<label 
									class="custom-control-label" 
									for="customSwitchPermission{{$permission['permission_id']}}"
								> 
									{{ $permission["active"]? "Activé" : "Desactivé" }}
								</label>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<div class="col-12">
						<button class="btn btn-primary form-control" type="submit"  wire:click="updateRoleAndPermissions">Submit form</button>
					</div>
				</li>
				
			</div>
		</div>
	</div>
	<!--end row-->
</div>