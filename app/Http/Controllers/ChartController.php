<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Pac;
use App\Models\Necesidad;

class ChartController extends Controller
{
    //GRAFICO POR CUATRIMESTRES PASTEL
    public function index()
    {
        // PRIMER GRAFICO
        $cuatrimestres = ['PRIMERO', 'SEGUNDO', 'TERCERO'];
    
        $PC = 87;
        $SC = 55;
        $TC = 6;
        $cantidades = [$PC, $SC, $TC];
        $total = array_sum($cantidades);
        session(['total' => $total]);
    
        // Calcular el precio total
        $precioTotal = 3045088.78;
        session(['precioTotal' => $precioTotal]);
    
        $porcentajes = array_map(function($cantidad) use ($total) {
            return ($cantidad / $total) * 100;
        }, $cantidades);

        // SEGUNDO GRAFICO
    
        $cuatrimestres1 = ['PRIMERO', 'SEGUNDO', 'TERCERO'];
    
        $PC1 = DB::table('pacs')->where('PC', 'S')->count();
        $SC1 = DB::table('pacs')->where('SC', 'S')->count();
        $TC1 = DB::table('pacs')->where('TC', 'S')->count();
        $cantidades1 = [$PC1, $SC1, $TC1];
        $total1 = array_sum($cantidades1);
        session(['total1' => $total1]);
    
        // Calcular el precio total
        $precioTotal1 = DB::table('pacs')->sum('precio');
        session(['precioTotal1' => $precioTotal1]);
    
        $porcentajes1 = array_map(function($cantidad) use ($total) {
            return ($cantidad / $total) * 100;
        }, $cantidades1);
        return view('graficos.grafico', compact('cuatrimestres', 'porcentajes', 'precioTotal','cuatrimestres1', 'porcentajes1', 'precioTotal1','cantidades','cantidades1'));
    }
    


    //GRAFICO POR TIPO DE PROCESOS
   public function index1()
    {
        $procesos = ['INFIMA CUANTIA', 'CATÁLOGO', 'COMUNES', 'ESPECIALES'];
    
        $INFIMA = DB::table('pacs')->where('id_proceso', '2')->count();
        $CATALOGO = DB::table('pacs')->where('id_proceso', '1')->count();
        $COMUNES = DB::table('pacs')->where(function($query) {
            $query->where('id_proceso', '>=', 3)
                  ->where('id_proceso', '<=', 10)
                  ->orWhere('id_proceso', '=', 21);
        })->count();
        $ESPECIALES = DB::table('pacs')->where(function($query) {
            $query->where('id_proceso', '>=', 11)
                  ->where('id_proceso', '<=', 40)
                  ->Where('id_proceso', '<>', 21);
        })->count();
        
        $cantidades = [$INFIMA, $CATALOGO, $COMUNES, $ESPECIALES];
        $total = array_sum($cantidades);
        session(['total' => $total]);

        //SEGUNDO GRAFICO

        $procesos1 = ['INFIMA CUANTIA', 'CATÁLOGO', 'COMUNES', 'ESPECIALES'];
        $INFIMA1 = DB::table('necesidads')->where('tipo_flujo', 'Infima Cuantía')->where('status', NULL)->count();
        $CATALOGO1 = DB::table('necesidads')->where('tipo_flujo', 'Catálogo Electrónico')->where('status',NULL)->count();
        $COMUNES1 = DB::table('necesidads')->where('tipo_flujo', 'Común')->where('status',NULL)->count();
        $ESPECIALES1 = DB::table('necesidads')->where('tipo_flujo', 'Especial')->where('status',NULL)->count();
        
        $cantidades1 = [$INFIMA1, $CATALOGO1, $COMUNES1, $ESPECIALES1];
        $total1 = array_sum($cantidades1);
        session(['total1' => $total1]);
  
        return view('graficos.grafico1', compact('procesos', 'cantidades', 'total','procesos1', 'cantidades1', 'total1'));
    }

    // GRAFICO DE PROCESOS POR UNIDADES
    public function index2()
    {
        // PRIMER GRAFICO
        $conteoProcesos = DB::table('pacs')
            ->join('depars', 'pacs.id_dpto', '=', 'depars.id')
            ->select('pacs.id_dpto', 'depars.dpto as nombre_dpto', DB::raw('count(pacs.id_dpto) as total_procesos'))
            ->groupBy('pacs.id_dpto', 'depars.dpto')
            ->get();
    
        // SEGUNDO GRAFICO
        $conteoProcesos1 = DB::table('necesidads') 
            ->join('depars', 'necesidads.id_dpto', '=', 'depars.id')
            ->select('necesidads.id_dpto', 'depars.dpto as nombre_dpto', DB::raw('count(necesidads.id_dpto) as total_procesos'))
            ->groupBy('necesidads.id_dpto', 'depars.dpto')
            ->orderBy(DB::raw('CAST(necesidads.id_dpto AS UNSIGNED)'), 'asc')
            ->where('status', NULL)
            ->get();
    
        // Preparar los datos para pasarlos a la vista
        $data = [
            'conteoProcesos' => $conteoProcesos,
            'conteoProcesos1' => $conteoProcesos1
        ];
    
        return view('graficos.grafico2', compact('data'));
    }

    
    //GRAFICO DE AHORRO POR PROCESOS
    public function index3()
    {
        // Obtener los datos y excluir los campos en blanco o null
        $counts = DB::table('pacs')
            ->select('reforma', DB::raw('count(*) as total'))
            ->whereNotNull('reforma')
            ->where('reforma', '!=', '')
            ->groupBy('reforma')
            ->get();
    
        // Calcular el total de reformas
        $totalReformas = $counts->sum('total');
    
        // Calcular los porcentajes
        $counts->transform(function ($item) use ($totalReformas) {
            $item->percentage = ($item->total / $totalReformas) * 100;
            return $item;
        });
    
        // Preparar los datos para pasarlos a la vista
        $data = [
            'counts' => $counts,
        ];
    
        return view('graficos.grafico3', compact('data'));
    }

    public function index4()
    {
        $results = DB::table('necesidads as n')
            ->join('pacs as p', 'n.nro_nec', '=', 'p.nro_nec')
            ->join('direccions as d', 'n.id_direcc', '=', 'd.id')
            ->select('d.direcc', DB::raw('COUNT(n.id) as total_procesos'), DB::raw('SUM(p.precio) as precio'), DB::raw('SUM(n.precio_eje) as precio_eje'))
            ->where('n.precio_eje', '>', 0)
            ->where('n.nro_nec1', null)
            ->groupBy('d.direcc')
            ->get();
    
        $labels = [];
        $totalProcesosData = [];
        $precioData = [];
        $precioEjeData = [];
        $diferenciaData = [];
        $porcentajeAhorroData = [];
        $totalPrecio = 0;
        $totalPrecioEje = 0;
    
        foreach ($results as $result) {
            $labels[] = $result->direcc;
            $totalProcesosData[] = $result->total_procesos;
            $precioData[] = $result->precio;
            $precioEjeData[] = $result->precio_eje;
            $diferenciaData[] = $result->precio - $result->precio_eje;
    
            // Verificar que el precio no sea cero antes de calcular el porcentaje de ahorro
            if ($result->precio != 0) {
                $porcentajeAhorroData[] = (($result->precio - $result->precio_eje) / $result->precio) * 100;
            } else {
                $porcentajeAhorroData[] = 0; // O cualquier valor que consideres apropiado
            }
    
            $totalPrecio += $result->precio;
            $totalPrecioEje += $result->precio_eje;
        }
    
        $totalDiferencia = $totalPrecio - $totalPrecioEje;
    
        // Verificar que el totalPrecio no sea cero antes de calcular el totalPorcentajeAhorro
        if ($totalPrecio != 0) {
            $totalPorcentajeAhorro = ($totalDiferencia / $totalPrecio) * 100;
        } else {
            $totalPorcentajeAhorro = 0; // O cualquier valor que consideres apropiado
        }
    
        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Procesos',
                    'data' => $totalProcesosData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Precio',
                    'data' => $precioData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Precio Ejecutado',
                    'data' => $precioEjeData,
                    'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                    'borderColor' => 'rgba(153, 102, 255, 1)',
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Diferencia',
                    'data' => $diferenciaData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1
                ]
            ],
            'porcentajeAhorro' => $porcentajeAhorroData,
            'totalPrecio' => $totalPrecio,
            'totalPrecioEje' => $totalPrecioEje,
            'totalDiferencia' => $totalDiferencia,
            'totalPorcentajeAhorro' => $totalPorcentajeAhorro
        ];
    
        return view('graficos.grafico4', compact('data'));
    }
}    