<?php

namespace App\Http\Livewire\Article;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\ArticlePropriete;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ArticlesComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = "bootstrap";

    public $search = "";
    public $filtreType = "", $filtreEtat = "";
    public $addArticle = [];
    public $editArticle = [];
    public $proprietesArticles = null;
    public $addPhoto = null;
    public $editPhoto = null;
    public $inputFileIterator = 0;
    public $inputEditFileIterator = 0;
    public $editHasChanged = false;
    public $editArticleOldValues = [];


    protected function rules () {
        return [
            'editArticle.nom' => ["required", Rule::unique("articles", "nom")],
            'editArticle.noSerie' => ["required", Rule::unique("articles", "noSerie")],
            'editArticle.type_article_id' => 'required|exists:App\Models\TypeArticle,id',
            'editArticle.article_proprietes.*.valeur' => 'required',
        ];
    } 

    
    function showUpdateButton(){
        $this->editHasChanged = false;

        foreach ($this->editArticleOldValues["article_proprietes"] as $index => $editArticleOld) {
            if($this->editArticle["article_proprietes"][$index]["valeur"] != $editArticleOld["valeur"]){
                $this->editHasChanged = true;
            }
        }

        if(
            $this->editArticle["nom"] != $this->editArticleOldValues["nom"] ||
            $this->editArticle["noSerie"] != $this->editArticleOldValues["noSerie"] ||
            $this->editPhoto != null
        ){
            $this->editHasChanged = true;
        }

    }
    
    public function render()
    {
        Carbon::setLocale("fr");

        $articleQuery = Article::query();

        if($this->search != ""){
            $this->resetPage();
            $articleQuery->where("nom", "LIKE",  "%". $this->search ."%")
                         ->orWhere("noSerie","LIKE",  "%". $this->search ."%");
        }

        if($this->filtreType != ""){
            $articleQuery->where("type_article_id", $this->filtreType);
        }

        if($this->filtreEtat != ""){
            $articleQuery->where("estDisponible", $this->filtreEtat);
        }

        if($this->editArticle != []){
            $this->showUpdateButton();
        }
        
        return view('livewire.article.articles-component',[
            "articles" => $articleQuery->latest()->paginate(10),
            "typearticles"=> TypeArticle::orderBy("nom", "ASC")->get()
        ])->layout('layouts.base');
    }

    public function updated($property){
        if($property == "addArticle.type"){
            $this->proprietesArticles = optional(TypeArticle::find($this->addArticle["type"]))->proprietes;
        }
    }
    
    public function updateArticle(){
        $this->validate();

        $article = Article::find($this->editArticle["id"]);

        $article->fill($this->editArticle);

        if($this->editPhoto != null){
            $path = $this->editPhoto->store("upload", "public");
            $imagePath = "storage/".$path;
            $image = Image::make(public_path($imagePath))->fit(200, 200);

            $image->save();

            Storage::disk("local")->delete(str_replace("storage/", "public/", $article->imageUrl));

            $article->imageUrl = $imagePath;
        }

        $article->save();

        collect($this->editArticle["article_proprietes"])
        ->each(
                fn($item) => ArticlePropriete::where([
                    "article_id" => $item["article_id"],
                    "propriete_article_id" => $item["propriete_article_id"]
                ])->update(["valeur" => $item["valeur"]])
            );

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=> "Article mis à jour avec succès!"]);
        $this->dispatchBrowserEvent("closeEditModal");
        
    }

    public function editArticle($articleId){
        
        $this->editArticle = Article::with("article_proprietes", "article_proprietes.propriete","type")->find($articleId)->toArray();

        $this->editArticleOldValues = $this->editArticle;

        $this->editPhoto = null;

        $this->dispatchBrowserEvent("showEditModal");
    }

    

    public function ajoutArticle(){
        //dump($this->addArticle);
        $validateArr = [
            "addArticle.nom" => "string|min:3|required|unique:articles,nom",
            "addArticle.noSerie" => "string|max:50|min:3|required|unique:articles,noSerie",
            "addArticle.type" => "required",
            "addPhoto" => "image|max:10240" // 10mb

        ];

        $customErrMessages = [];
        $propIds = [];

        foreach ($this->proprietesArticles?: [] as $propriete) {

            $field = "addArticle.prop.".$propriete->nom;

            $propIds[$propriete->nom] = $propriete->id;

            if($propriete->estObligatoire == 1){
                $validateArr[$field] = "required";
                $customErrMessages["$field.required"] = "Le champ <<".$propriete->nom.">> est obligatoire.";
            }else{
                $validateArr[$field] = "nullable";
            }


        }

        // Validation des erreurs
        $validatedData = $this->validate($validateArr, $customErrMessages);

        // par défaut notre image est une placeholder
        $imagePath = "assets/images/imageplaceholder.png";

        if($this->addPhoto != null){

            $path = $this->addPhoto->store('upload', 'public');
            $imagePath = "storage/".$path;

            $image = Image::make(public_path($imagePath))->fit(200, 200);
            $image->save();

        }

        $article = Article::create([
            "nom" => $validatedData["addArticle"]["nom"],
            "noSerie" => $validatedData["addArticle"]["noSerie"],
            "type_article_id" => $validatedData["addArticle"]["type"],
            "imageUrl" => $imagePath
        ]);



        foreach($validatedData["addArticle"]["prop"]?: [] as $key => $prop){
            ArticlePropriete::create([
                "article_id" => $article->id,
                "propriete_article_id" => $propIds[$key],
                "valeur"=> $prop
            ]);
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Article ajouté avec succès!"]);

        $this->closeModal();
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal");
    }

    public function showAddArticleModal(){
        $this->resetValidation();
        $this->addArticle = [];
        $this->proprietesArticles = [];
        $this->addPhoto = null;
        $this->inputFileIterator++;
        $this->dispatchBrowserEvent("showModal");
    }

   

    public function closeEditModal(){
        
        $this->dispatchBrowserEvent("closeEditModal");
    }
}
