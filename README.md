# blog0
Laravel CRUD (create, read, update and delete)

Step 1 : Install Laravel 5.5
Command: composer create-project --prefer-dist laravel/laravel blog

Step 2 : Install Laravel Collective
we will install laravelcollective/html composer package for form builder
Command: composer require laravelcollective/html

So open config/app.php file and add service provider & alias
    config/app.php
    'providers' => [
	....
	Collective\Html\HtmlServiceProvider::class,
    ],
    aliases' [
	....
	'Form' => Collective\Html\FormFacade::class,
    'Html' => Collective\Html\HtmlFacade::class,
    ],

Step 3: Database Configuration
 we have to make database configuration for example database name, username, password
 So let's open .env file
    .env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=here your database name(blog)
    DB_USERNAME=here database username(root)
    DB_PASSWORD=here database password(root)

Step 4: Create articles Table and Model
create crud application for article. so we have to create migration for articles table using Laravel 5.5 php artisan command
Command:
php artisan make:migration create_articles_table
ou
php artisan make:migration create_article_table --create=articles

create_article_table sera le nom du fichier de migration.
L'option --create pré-rempli la migration avec la création d'une nouvelle table.
Un fichier a été créé : database/migrations/*

After this command you will find one file in following path database/migrations and you have to put bellow code in your migration file for create articles table.
database/migrations/.... create_articles_table.php
public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });

 create model for "articles" table with command
 php artisan make:model Article

 So we find app/Article.php
     protected $fillable = [
        'title', 'body'
    ];

Step 5: Add Resource Route
we need to add resource route for article crud application
open your routes/web.php file and add following route
toutes mes routes sont ici (dossier des views ex'articles' en 1 et en 2 dans app, les controllers 'ArticleController')

routes/web.php
Route::resource('articles','ArticleController');
Route::resource('itemCRUD','ItemCRUDController');



Step 6: Create ArticleController
create new controller as ArticleController
php artisan make:controller ArticleController -r
<!-- ou php artisan make:controller ArticleController --resource -->

you will find new file in this path app/Http/Controllers/ArticleController.php.
1)index()
2)create()
3)store()
4)show()
5)edit()
6)update()
7)destroy()

Step 7: Create Blade Files in ressources/views
1) layout.blade.php 
<!-- ex: resources/views/layout.blade.php -->
<!-- create articles file and inside we have index,show,form,create,edit files -->
2) index.blade.php
<!-- resources/views/articles/index.blade.php -->
3) show.blade.php
4) form.blade.php
5) create.blade.php
6) edit.blade.php

Step 8: php artisan serve

Step 9: http://localhost:8000/articles

http://localhost:8000/itemCRUD/

NB. faire attention lors des Migrations
En cas d'erreur à la génération. Du type : Key too long error:
SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 7
67 bytes (SQL: alter table users add unique users_email_unique (email))
donc dans:
app/providers/AppServiceProvider.php

rajouter:

use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}

utiliser la commande: php artisan migrate:fresh
et php artisan migrate:fresh --seed
puis vérifier la DB et relancer le serveur avec php artisan serve

MAIS AUSSI dans le dossier migrations
lorsque l'on a email lui rajouter une longueur de 191
ex: $table->string('email', 191)->unique();