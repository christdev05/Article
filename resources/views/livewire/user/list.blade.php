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

    <h6 class="mb-0 text-uppercase">All User</h6>
	<hr/>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-3 col-xl-2">
							<button type="button" class="btn btn-primary mb-3 mb-lg-0" wire:click.prevent='goToAddUser'><i class="bx bxs-plus-square"></i>New User</button>
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
						    <th></th>
						    <th>Users</th>
						    <th>Role</th>
                            <th>Email</th>
                            <th>Telephone1</th>
                            <th>Telephone2</th>
                            <th>Piece d'identité</th>
                            <th>Date Ajout</th>
						    <th >Action</th>
					    </tr>
					</thead>
					<tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                @if($user->sexe == "F")
                                        <img src="{{asset('assets/images/avatars/woman.jpg')}}" width="45"/>
                                    @else
                                        <img src="{{asset('assets/images/avatars/man.jpg')}}" width="45"/>
                                    @endif
                                </td>
                                <td>{{$user->nom}} {{$user->prenom}}</td>
                                <td>{{ $user->allRoleNames}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->telephone1}}</td>
                                <td>{{$user->telephone2}}</td>
                                <td>{{$user->pieceIdentite}}</td>
                                 <td>{{$user->created_at->diffForHumans()}}</td>
                                <td >
                                    <button type="button" class="btn btn-primary" wire:click="goToEditUser({{$user->id}})"><i class="fadeIn animated bx bx-edit"></i>Edit</button>
                                    <button type="button" class="btn btn-danger"  wire:click.prevent="confirmDelete('{{ $user->prenom }} {{ $user->nom }}', {{$user->id}})" ><i class="fadeIn animated bx bx-trash"></i>Delete</button>
                                </td>
                            </tr>	
                        @endforeach	
					</tbody>
				</table>
			</div>
				<div class="text-center">
					{{ $users->links() }}
				</div>
		</div>
	</div>