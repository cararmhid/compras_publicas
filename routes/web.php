<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Arch_FluController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EnviarWhatsappController;
use App\Http\Controllers\FlujoController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\MemodirController;
use App\Http\Controllers\necesidadController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', function () { return view('admin'); });

Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])->name('password.update');
        
    Route::resource('/formatos', \App\Http\Controllers\FormatoController::class);
    Route::get('formatos/download/{id}', [App\Http\Controllers\FormatoController::class, 'download'])->name('formatos.download');

    Route::resource('/flujo1s', \App\Http\Controllers\Flujo1Controller::class);
    Route::resource('/flujo2s', \App\Http\Controllers\Flujo2Controller::class);
    Route::resource('/flujo3s', \App\Http\Controllers\Flujo3Controller::class);
    Route::resource('/flujo4s', \App\Http\Controllers\Flujo4Controller::class);
    Route::resource('/flujo5s', \App\Http\Controllers\Flujo5Controller::class);   
    Route::resource('/docuflujos', \App\Http\Controllers\DocuflujoController::class);
    Route::resource('/direcciones', \App\Http\Controllers\DireccionController::class);
    Route::resource('/depars', \App\Http\Controllers\DeparController::class);
    Route::resource('/poas', \App\Http\Controllers\PoaController::class);
    Route::resource('/procesos', \App\Http\Controllers\ProcesoController::class);
    Route::resource('/pacs', \App\Http\Controllers\PacController::class);
    Route::resource('/solicituds', \App\Http\Controllers\SolicitudController::class);
    Route::resource('/necesidads', \App\Http\Controllers\NecesidadController::class);
    Route::resource('/flujos', \App\Http\Controllers\FlujoController::class);
    Route::resource('/arch_flus', \App\Http\Controllers\Arch_FluController::class);

    Route::get('/generar-pdf', [FlujoController::class, 'generarPDF'])->name('generarPDF');
    Route::get('/generarCertPac', [FlujoController::class, 'generarCertPac'])->name('generarCertPac');
    Route::get('/generarCertCE', [FlujoController::class, 'generarCertCE'])->name('generarCertCE');
    Route::get('/downloadCC', [FlujoController::class, 'downloadCC'])->name('downloadCC');
    Route::get('/downloadIS', [FlujoController::class, 'downloadIS'])->name('downloadIS');
    Route::get('/downloadAER', [FlujoController::class, 'downloadAER'])->name('downloadAER');

    Route::post('/flujo/download-aer', [FlujoController::class, 'downloadAER'])->name('flujo.downloadAER');
       
    Route::get('/generar1-pdf', [FlujoController::class, 'generar1PDF'])->name('generar1PDF');
    Route::get('/generar2-pdf', [FlujoController::class, 'generar2PDF'])->name('generar2PDF');
    Route::get('/generar-documento', [DocumentoController::class, 'generarDocumento'])->name('generar-documento');
    Route::get('/generar-memodir', [MemodirController::class, 'generarMemodir'])->name('generarMemodir');
    Route::get('/generar-memodirpago', [MemodirController::class, 'generarMemodirpago'])->name('generarMemodirpago');
  
    Route::get('/descargar-todos', [ArchivoController::class, 'descargarTodos']);
    Route::get('/descargar-todos1', [ArchivoController::class, 'descargarTodos1']);
      
    Route::get('arch_flus/download/{id}', [App\Http\Controllers\Arch_FluController::class, 'download'])->name('arch_flus.download');
    Route::get('/grafico', [ChartController::class, 'index']);
    Route::post('/admin/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
  
    Route::get('/formulario', [FormularioController::class, 'index']);
    Route::post('/formulario', [FormularioController::class, 'store']);

    Route::get('/asignar', [FlujoController::class, 'asignar']);
    Route::post('/guardar', [FlujoController::class, 'guardar'])->name('ruta.guardar');

    Route::get('/designar', [FlujoController::class, 'designar']);
    Route::post('/guardaradm', [FlujoController::class, 'guardaradm'])->name('ruta.guardaradm');

    Route::get('/cambiarprecio/{id}', [NecesidadController::class, 'cambiarprecio'])->name('necesidads.cambiarprecio');
    Route::post('/updateprecio/{id}', [NecesidadController::class, 'updateprecio'])->name('ruta.updateprecio');
    Route::get('/grafico/index1', [ChartController::class, 'index1']);
    Route::get('/grafico/index2', [ChartController::class, 'index2']);
    Route::get('/grafico/index3', [ChartController::class, 'index3']);
    Route::get('/grafico/index4', [ChartController::class, 'index4']);
    Route::get('/rep_mora', [NecesidadController::class, 'rep_mora'])->name('necesidads.rep_mora');
    Route::get('/rep_mora_exe', [NecesidadController::class, 'rep_mora_exe'])->name('necesidads.rep_mora_exe');

   Route::get('/enviar-whatsapp', [EnviarWhatsappController::class, 'enviarWhatsapp']);

  

});
