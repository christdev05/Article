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
			<button type="button" class="btn btn-primary"  wire:click='goToListUser()'>Back Users List</button>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-12 mx-auto">
		<h6 class="mb-0 text-uppercase">Add User</h6>
		<hr>
		<div class="card">
			<div class="card-body">
				<div class="p-2 border rounded">
					<form class="row g-3 needs-validation" wire:submit.prevent="addUser()" >
						<div class="col-md-6">
					        <label for="nom" class="form-label">Nom</label>
							<input type="text" class="form-control @error('newUser.nom') is-invalid @enderror" id="nom" wire:model="newUser.nom">
							@error("newUser.nom")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="prenom" class="form-label">Prenom</label>
							<input type="text" class="form-control @error('newUser.prenom') is-invalid @enderror" id="prenom" wire:model="newUser.prenom">
							@error("newUser.prenom")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="col-md-6">
					        <label for="sexe" class="form-label">Sexe</label>
							<select class="form-select mb-3 @error('newUser.sexe') is-invalid @enderror" aria-label="Default select example" wire:model="newUser.sexe">
								<option selected="">Select sexe</option>
								<option value="H">Homme</option>
								<option value="F">Femme</option>
							</select>
                            @error("newUser.sexe")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="email" class="form-label">Address E-mail</label>
							<input type="text" class="form-control @error('newUser.email') is-invalid @enderror" id="email" wire:model="newUser.email">
							@error("newUser.email")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="col-md-6">
					        <label for="telephone1" class="form-label">Telephone 1</label>
							<input type="text" class="form-control @error('newUser.telephone1') is-invalid @enderror" id="telephone1" wire:model="newUser.telephone1">
							@error("newUser.telephone1")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="telephone2" class="form-label">Telephone 2</label>
							<input type="text" class="form-control @error('newUser.telephone2') is-invalid @enderror" id="telephone2" wire:model="newUser.telephone2">
							@error("newUser.telephone2")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="col-md-6">
					        <label for="sexe" class="form-label">Piece Identité</label>
							<select class="form-select mb-3 @error('newUser.pieceIdentite') is-invalid @enderror" aria-label="Default select example" wire:model="newUser.pieceIdentite">
								<option selected="">Select Piece Identite</option>
								<option value="CNI">CNI</option>
								<option value="PASSPORT">PASSPORT</option>
                                <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
							</select>
                            @error("newUser.pieceIdentite")
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
						<div class="col-md-6">
					        <label for="Numero de piece d'identité" class="form-label">Numero de piece d'identité</label>
							<input type="text" class="form-control @error('newUser.numeroPieceIdentite') is-invalid @enderror" id="numeroPieceIdentite" wire:model="newUser.numeroPieceIdentite">
							@error("newUser.numeroPieceIdentite")
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