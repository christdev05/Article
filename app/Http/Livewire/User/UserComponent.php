<?php

namespace App\Http\Livewire\User;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search = "";
    public $currentPage = PAGELIST;
    public $newUser = [];
    public $editUser = [];

    public $rolePermissions = [];
    

    public function rules(){

        if($this->currentPage == PAGEEDITFORM){

            // 'required|email|unique:users,email Rule::unique("users", "email")->ignore($this->editUser['id'])
            return [
                'editUser.nom' => 'required',
                'editUser.prenom' => 'required',
                'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id']) ] ,
                'editUser.telephone1' => ['required', 'numeric', Rule::unique("users", "telephone1")->ignore($this->editUser['id']) ]  ,
                'editUser.pieceIdentite' => ['required'],
                'editUser.sexe' => 'required',
                'editUser.numeroPieceIdentite' => ['required', Rule::unique("users", "pieceIdentite")->ignore($this->editUser['id']) ],
            ];
        }
        return [
            'newUser.nom' => 'required',
            'newUser.prenom' => 'required',
            'newUser.email' => 'required|email|unique:users,email',
            'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
            'newUser.telephone2' => 'required|numeric|unique:users,telephone2',
            'newUser.pieceIdentite' => 'required',
            'newUser.sexe' => 'required',
            'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',
        ];
    }

    public function render()
    {
        Carbon::setLocale("fr");
        $searchCriteria = "%".$this->search."%";
        $users = User::where("nom", "like", $searchCriteria)->latest()->paginate(10);
        return view('livewire.user.index-component',['users'=>$users])->layout('layouts.base');
    }

    public function goToAddUser(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToListUser(){
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    public function addUser(){

        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();
 
        $validationAttributes["newUser"]["password"] = "password";
 
        //dump($validationAttributes);
        // Ajouter un nouvel utilisateur
        User::create($validationAttributes["newUser"]);
 
        $this->newUser = [];
 
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur créé avec succès!"]);
    }

    public function goToEditUser($id){
        
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
        //creation de la function role
        $this->populateRolePermissions();
    }

    public function updateUser(){
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();

        User::find($this->editUser["id"])->update($validationAttributes["editUser"]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur mis à jour avec succès!"]);

    }

    //function role
    public function populateRolePermissions(){
        $this->rolePermissions["roles"] = [];
        $this->rolePermissions["permissions"] = [];

        $mapForCB = function($value){
            return $value["id"];
        };

        $roleIds = array_map($mapForCB, User::find($this->editUser["id"])->roles->toArray()); // [1, 2, 4] collection des identifiant des roles que le user a
        $permissionIds = array_map($mapForCB, User::find($this->editUser["id"])->permissions->toArray()); // [1, 2, 4]

        foreach(Role::all() as $role){
            if(in_array($role->id, $roleIds)){
                array_push($this->rolePermissions["roles"], ["role_id"=>$role->id, "role_nom"=>$role->nom, "active"=>true]);
            }else{
                array_push($this->rolePermissions["roles"], ["role_id"=>$role->id, "role_nom"=>$role->nom, "active"=>false]);
            }
        }

        foreach(Permission::all() as $permission){
            if(in_array($permission->id, $permissionIds)){
                array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>true]);
            }else{
                array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_nom"=>$permission->nom, "active"=>false]);
            }
        }


        // la logique pour charger les roles et les permissions
    }

    public function updateRoleAndPermissions(){
        DB::table("user_role")->where("user_id", $this->editUser["id"])->delete();
        DB::table("user_permission")->where("user_id", $this->editUser["id"])->delete();

        foreach($this->rolePermissions["roles"] as $role){
            if($role["active"]){
                User::find($this->editUser["id"])->roles()->attach($role["role_id"]);
            }
        }

        foreach($this->rolePermissions["permissions"] as $permission){
            if($permission["active"]){
                User::find($this->editUser["id"])->permissions()->attach($permission["permission_id"]);
            }
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Roles et permissions mis à jour avec succès!"]);
    }
    
    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "user_id" => $id
            ]
        ]]);
    }
    
    public function deleteUser($id){
        User::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur supprimé avec succès!"]);
    }
}
