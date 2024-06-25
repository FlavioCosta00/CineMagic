<?php

use App\Http\Middleware\isCliente;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\BilheteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracaoController;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ROTAS ADMINISTRAÇÃO

Route::middleware(['auth','verified','isBloqueado','isFuncionario'])->prefix('admin')->name('admin.')->group(function () {
  
    
    //Controlo de Acesso á Sessão
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/showsessao', [DashboardController::class, 'showSessao'])->name('sessao.show');
    Route::get('/validarbilhete', [DashboardController::class, 'validarBilhete'])->name('validarBilhete.show');
    Route::post('/alterarEstadoBilhete',[DashboardController::class, 'bilheteEstado'])->name('bilheteEstado.update');

    Route::middleware(['isAdmin'])->group(function() {
    
        //Estatísticas
        Route::get('estatisticas', [DashboardController::class, 'estatisticas'])->name('estatisticas.show');

        // Admininstração de clientes
        Route::get('clientes', [ClienteController::class, 'admin'])->name('clientes')
        ->middleware('can:viewAny,App\Models\Cliente');
        Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store')
        ->middleware('can:create,App\Models\Cliente');
         Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')
        ->middleware('can:update,cliente');
        Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')
        ->middleware('can:delete,cliente');
        Route::post('clientes', [ClienteController::class, 'bloquearClientes'])->name('clientes.unlock');


        // Administração de filmes
        Route::get('filmes', [FilmeController::class, 'admin_index'])->name('filmes')
        ->middleware('can:viewAny,App\Models\Filme');
        Route::get('filmes/{filme}/edit', [FilmeController::class, 'edit'])->name('filmes.edit')
        ->middleware('can:view,filme');
        Route::get('filmes/create', [FilmeController::class, 'create'])->name('filmes.create')
        ->middleware('can:create,App\Models\Filme');
        Route::post('filmes', [FilmeController::class, 'store'])->name('filmes.store')
        ->middleware('can:create,App\Models\Filme');
        Route::put('filmes/{filme}', [FilmeController::class, 'update'])->name('filmes.update')
        ->middleware('can:update,filme');
        Route::delete('filmes/{filme}', [FilmeController::class, 'destroy'])->name('filmes.destroy')
        ->middleware('can:delete,filme');

        // Admininstração de Géneros
        Route::get('generos', [GeneroController::class, 'admin'])->name('generos')
        ->middleware('can:viewAny,App\Models\Genero');
        Route::get('generos/{genero}/edit', [GeneroController::class, 'edit'])->name('generos.edit')
        ->middleware('can:view,genero');
        Route::get('generos/create', [GeneroController::class, 'create'])->name('generos.create')
        ->middleware('can:create,App\Models\Genero');
        Route::post('generos', [GeneroController::class, 'store'])->name('generos.store')
        ->middleware('can:create,App\Models\Genero');
        Route::put('generos/{genero}', [GeneroController::class, 'update'])->name('generos.update')
        ->middleware('can:update,genero');
        Route::delete('generos/{genero}', [GeneroController::class, 'destroy'])->name('generos.destroy')
        ->middleware('can:delete,genero');



        // Admininstração de Salas
        Route::get('salas', [SalaController::class, 'admin'])->name('salas')
            ->middleware('can:viewAny,App\Models\Sala');
        Route::get('salas/{sala}/edit', [SalaController::class, 'edit'])->name('salas.edit')
            ->middleware('can:view,sala');
        Route::get('salas/create', [SalaController::class, 'create'])->name('salas.create')
            ->middleware('can:create,App\Models\Sala');
        Route::post('salas', [SalaController::class, 'store'])->name('salas.store')
            ->middleware('can:create,App\Models\Sala');
        Route::put('salas/{sala}', [SalaController::class, 'update'])->name('salas.update')
            ->middleware('can:update,sala');
        Route::delete('salas/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy')
            ->middleware('can:delete,sala');

            // Admininstração de Bilhetes
        Route::get('bilhetes', [BilheteController::class, 'admin'])->name('bilhetes')
            ->middleware('can:viewAny,App\Models\Bilhete');
        Route::get('bilhetes/{bilhete}/edit', [BilheteController::class, 'edit'])->name('bilhetes.edit')
            ->middleware('can:view,bilhete');
        Route::get('bilhetes/create', [BilheteController::class, 'create'])->name('bilhetes.create')
            ->middleware('can:create,App\Models\Bilhete');
        Route::post('bilhetes', [BilheteController::class, 'store'])->name('bilhetes.store')
            ->middleware('can:create,App\Models\Bilhete');
        Route::put('bilhetes/{bilhete}', [BilheteController::class, 'update'])->name('bilhetes.update')
            ->middleware('can:update,bilhete');
        Route::delete('bilhetes/{bilhete}', [BilheteController::class, 'destroy'])->name('bilhetes.destroy')
            ->middleware('can:delete,bilhete');

                // admininstração de lugares
        Route::get('lugares', [LugarController::class, 'admin'])->name('lugares')
                ->middleware('can:viewAny,App\Models\Lugar');
        Route::get('lugares/{lugar}/edit', [LugarController::class, 'edit'])->name('lugares.edit')
                ->middleware('can:view,lugar');
         Route::get('lugares/create', [LugarController::class, 'create'])->name('lugares.create')
                ->middleware('can:create,App\Models\Lugar');
         Route::post('lugares', [LugarController::class, 'store'])->name('lugares.store')
                ->middleware('can:create,App\Models\Lugar');
         Route::put('lugares/{lugar}', [LugarController::class, 'update'])->name('lugares.update')
                ->middleware('can:update,lugar');
         Route::delete('lugares/{lugar}', [LugarController::class, 'destroy'])->name('lugares.destroy')
                ->middleware('can:delete,lugar');

               // admininstração de sessoes
         Route::get('sessoes', [SessaoController::class, 'admin'])->name('sessoes')
               ->middleware('can:viewAny,App\Models\Sessao');
         Route::get('sessoes/edit', [SessaoController::class, 'edit'])->name('sessoes.edit')
               ->middleware('can:view,sessao');
           Route::get('sessoes/create', [SessaoController::class, 'create'])->name('sessoes.create')
               ->middleware('can:create,App\Models\Sessao');
           Route::post('sessoes', [SessaoController::class, 'store'])->name('sessoes.store')
               ->middleware('can:create,App\Models\Sessao');
           Route::put('sessoes/update', [SessaoController::class, 'update'])->name('sessoes.update')
               ->middleware('can:update,sessao');
           Route::delete('sessoes/destroy', [SessaoController::class, 'destroy'])->name('sessoes.destroy')
               ->middleware('can:delete,sessao');


                // admininstração de users
                Route::get('users', [UserController::class, 'admin'])->name('users')
                ->middleware('can:viewAny,App\Models\User');
            Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')
                ->middleware('can:view,user');
            Route::get('users/create', [UserController::class, 'create'])->name('users.create')
                ->middleware('can:create,App\Models\User');
            Route::post('users', [UserController::class, 'store'])->name('users.store')
                ->middleware('can:create,App\Models\User');
            Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')
                ->middleware('can:update,user');
            Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')
                ->middleware('can:delete,user');

                // admininstração de recibos
                Route::get('recibos', [ReciboController::class, 'admin'])->name('recibos')
                ->middleware('can:viewAny,App\Models\Recibo');
            Route::get('recibos/{recibo}/edit', [ReciboController::class, 'edit'])->name('recibos.edit')
                ->middleware('can:view,recibo');
            Route::get('recibos/create', [ReciboController::class, 'create'])->name('recibos.create')
                ->middleware('can:create,App\Models\Recibo');
            Route::post('recibos', [ReciboController::class, 'store'])->name('recibos.store')
                ->middleware('can:create,App\Models\Recibo');
            Route::put('recibos/{recibo}', [ReciboController::class, 'update'])->name('recibos.update')
                ->middleware('can:update,recibo');
            Route::delete('recibos/{recibo}', [ReciboController::class, 'destroy'])->name('recibos.destroy')
                ->middleware('can:delete,recibo');

            // administração de configuracao
        Route::get('configuracao', [ConfiguracaoController::class, 'admin'])->name('configuracao')
        ->middleware('can:viewAny,App\Models\Configuracao');
        Route::get('configuracao/{configuracao}/edit', [ConfiguracaoController::class, 'edit'])->name('configuracao.edit')
        ->middleware('can:view,configuracao');
        Route::put('configuracao/{configuracao}', [ConfiguracaoController::class, 'update'])->name('configuracao.update')
        ->middleware('can:update,configuracao');
    });

        Route::get('users/password', [UserController::class, 'edit_password'])->name('password.edit');
        Route::patch('users/password', [UserController::class, 'update_password'])->name('password.update');

});


Auth::routes(['verify'=>true]);

//ROTAS FRONT-END

//Página Inicial
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[FilmeController::class, 'filmes_exibicao'])->name('inicio');
Route::get('/genero/{code}',[GeneroController::class, 'filtrar_genero'])->name('filtrogenero');
Route::post('/substring',[FilmeController::class, 'filtrar_substring'])->name('filtrosubstring');

//Página Filme
Route::get('filme/{id}',[FilmeController::class, 'filme_detail'])->name('filme');

//Página Lugares
Route::get('/sessao/{id}',[SessaoController::class, 'show_lugares'])->name('show.lugares');

Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho');
Route::post('/carrinho/store', [CarrinhoController::class, 'store_pedido'])->name('carrinho.store_pedido');
Route::delete('carrinho/destroy', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');
Route::delete('carrinho', [CarrinhoController::class, 'destroy_bilhete'])->name('carrinho.destroy_bilhete');

Route::middleware(['auth','isBloqueado','isCliente'])->prefix('/')->name('utilizador.')->group(function () {
    
    Route::get('perfil', [ClienteController::class, 'perfil'])->name('perfil');
    Route::put('perfil/{cliente}', [ClienteController::class, 'updateClientesInfo'])->name('cliente.update');
    Route::delete('perfil/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('cliente.foto.destroy');

    Route::middleware(['isCarrinhoEmpty'])->group(function() {
        Route::get('checkout', [CarrinhoController::class, 'checkout'])->name('checkout');
        Route::post('store_compra', [CarrinhoController::class, 'store_compra'])->name('carrinho.store_compra');
    });  

});