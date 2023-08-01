<div>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-lg-3 col-xl-2">
                            <a type="button" wire:click="showAddArticleModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="bx bxs-plus-square"></i>New Article</a>
                        </div>

                        <div class="col-lg-9 col-xl-10">
                            <form class="float-lg-end">
                                <div class="row row-cols-lg-auto g-2">
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <input type="text" class="form-control ps-5"  wire:model.debounce.250ms="search" placeholder="Search User..."> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <select class="form-select form-control" id="filtreType" wire:model="filtreType" >
                                                <option selected="" disabled="" value="">Filtrer par type</option>
                                                @foreach ($typearticles as $typearticle)
                                                    <option value="{{$typearticle->id}}">{{ $typearticle->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <select class="form-select form-control" id="filtreEtat" wire:model="filtreEtat">
                                                <option selected="" disabled="" value="">Filtrer par etat</option>
                                                <option value="1">Disponible</option>
                                                <option value="0">Indisponible</option>
                                            </select>
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
                            <th style="width:30%;" class="text-center"></th>
                            <th style="width:30%;" class="text-center">Article</th>
                            <th style="width:30%;" class="text-center">Type</th>
                            <th style="width:30%;" class="text-center">Etat</th>
                            <th  style="width:30%;" class="text-center">Ajouté</th>
                            <th  style="width:30%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article )
                        <tr>
                            <td>
                                <img src="{{asset($article->imageUrl)}}" alt="" style="width:40px;height:40px;">
                            </td>
                            <td class="text-center" >{{ $article->nom }} - {{ $article->noSerie }}</td>
                            <td class="text-center">{{ $article->type->nom }}</td>
                            <td class="text-center">
                                @if($article->estDisponible)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">Indisponible</span>
                                @endif
                            </td>
                            <td class="text-center">{{ optional($article->created_at)->diffForHumans() }}</td>
                                    
                            <td class="text-center">
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" wire:click="editArticle({{$article->id}})"><i class="fadeIn animated bx bx-edit"></i>Edit</a>
                                        
                                <button type="button" class="btn btn-danger"><i class="fadeIn animated bx bx-trash"></i>Delete</button>
                                    
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-white">Information!</h6>
                                            <div class="text-white">Aucune donnée trouvée par rapport aux éléments de recherche entrés.</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
                <div class="text-center">
                    {{ $articles->links() }}
                </div>
        </div>
    </div>
</div>
