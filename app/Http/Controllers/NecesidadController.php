<?php

namespace App\Http\Controllers;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use App\Models\arch_flu;
use App\Models\flujo;
use App\Models\necesidad;
use App\Models\Poa;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;


class necesidadController extends Controller
{
  
    public function index()
    {
        $flujos = flujo::all();
       // $necesidads = Necesidad::with(['poa'])->get();
        $necesidads = Necesidad::with(['poa'])->orderBy('nro_nec')->get();
      
        return view('necesidad.index', compact('necesidads', 'flujos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flujos = flujo::all();
    
        $necesidads = Necesidad::where('cod_user', session('user_id'))->with('poa')->get();
        
        return view('necesidad.index', compact('necesidads', 'flujos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $necesidads = Necesidad::findOrFail($id);
        session(['nro_necn' => $necesidads->nro_nec]);
        session(['nro_nec1' => $necesidads->nro_nec1]);

       // $nro_nec1=  DB::table('necesidads')->where('id', $id)->value('nro_nec1');
     
       // session(['nro_nec1' => $nro_nec1]);
        $arch_flus = arch_flu::where('nro_nec', session('nro_necn'))
            ->where('nro_nec1', session('nro_nec1'))
            ->where('estado', 0)
            ->orderBy('documento', 'asc')
            ->get();
        
        // Aquí puedes devolver la vista o lo que necesites hacer con $arch_flus
        return view('arch_flu.index', compact('arch_flus'));
    }
        // return view('arch_flu.index', compact('necesidads', 'arch_flus'));
 
     
     

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id,Request $request)
    {
      
       $necesidads = Necesidad::findOrFail($id);
      // session(['nro_necn' => $necesidads->nro_nec]);
       $nro_nec=  DB::table('necesidads')->where('id', $id)->value('nro_nec');
       $nro_nec1=  DB::table('necesidads')->where('id', $id)->value('nro_nec1');
       session(['nro_necn' => $nro_nec]);
       session(['nro_nec1' => $nro_nec1]);
    
       $valor = session('nro_necn');
      
      // $flujos = Flujo::where('nro_nec', $necesidads->nro_nec)->where('estado','>',1)->get();
       $flujos = Flujo::where('nro_nec', session('nro_necn'))
       ->where('nro_nec1', session('nro_nec1'))
       ->where('estado', '>', 1)
       ->get();
        return view('flujo.index', compact('necesidads', 'flujos'));

    }
    public function update(Request $request, $id)
    {

                //   return redirect()->route('necesidads.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        
        $necesidad = Necesidad::find($id);
        $necesidad->status = '1'; // Asegúrate de usar el nombre correcto del campo
        $necesidad->cod_user = 999;
        $necesidad->save();
    
        return redirect()->route('necesidads.index')->with('mensaje', 'Requerimiento Anulado correctamente');
    }


   
   
        public function cambiarprecio($id)
    {
        $necesidad = Necesidad::findOrFail($id);
    
        return view('necesidad.precio', compact('necesidad')); // Asegúrate de pasar la variable $necesidad a la vista
    }
   

    public function updateprecio(Request $request, $id)
{
    $request->validate([
      //  'precio_pac' => 'required|numeric',
      //  'precio_eje' => 'required',
      //  'ruc'=>'required',
      //  'proveedor'=>'required',
      //  'nro_reforma'=>'required'
    ]);

    $necesidads = Necesidad::findOrFail($id);
    $necesidads->precio_pac = $request->input('precio_pac'); 
    $necesidads->precio_eje = $request->input('precio_eje');
    $necesidads->ruc = $request->input('ruc'); 
    $necesidads->proveedor = $request->input('proveedor'); 
    $necesidads->nro_reforma = $request->input('nro_reforma'); 
    $necesidads->status = $request->input('status'); // 0 o 2
    
    $necesidads->save();

    return redirect()->route('necesidads.index')->with('mensaje', 'Requerimiento actualizado correctamente');
}

public function rep_mora()
{
    $currentDate = Carbon::now();

    $necesidades = DB::table('necesidads as n')
        ->join('flujos as f', 'n.nro_nec', '=', 'f.nro_nec')
        ->where('f.fecha_fin', '<', $currentDate)
        ->where('f.estado', '=', 2)
        ->where('n.status', '=', null)
        ->select('n.*', 'n.descripcion as descripcionn', 'f.*')
        ->get();

    foreach ($necesidades as $necesidad) {
        $fechaFin = Carbon::parse($necesidad->fecha_fin);
        $fechaActual = Carbon::now();
        $necesidad->dias_mora = $fechaFin->diffInDays($fechaActual, false);
        $necesidad->horas_mora = $fechaFin->diffInHours($fechaActual, false);
    }

    $pdf = PDF::loadView('necesidad.rep_mora', compact('necesidades'))
        ->setPaper('a4', 'landscape'); // Configura el tamaño y la orientación de la página

    return $pdf->download('reporte_procesos_en_mora.pdf');
}

public function rep_mora_exe()
{
    $currentDate = Carbon::now();

    $necesidades = DB::table('necesidads as n')
        ->join('flujos as f', 'n.nro_nec', '=', 'f.nro_nec')
        ->where('f.fecha_fin', '<', $currentDate)
        ->where('f.estado', '=', 2)
        ->where('n.status', '=', null)
        ->select('n.*', 'n.descripcion as descripcionn', 'f.*')
        ->get();

    foreach ($necesidades as $necesidad) {
        $fechaFin = Carbon::parse($necesidad->fecha_fin);
        $fechaActual = Carbon::now();
        $necesidad->dias_mora = $fechaFin->diffInDays($fechaActual, false);
        $necesidad->horas_mora = $fechaFin->diffInHours($fechaActual, false);
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add logo
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('storage/imagenes/logo_req.jpg'); // Ruta al archivo de imagen
    $drawing->setHeight(50);
    $drawing->setCoordinates('A1');
    $drawing->setWorksheet($sheet);

    // Set title
    $sheet->setCellValue('A5', 'Reporte de Procesos en Mora');
    $sheet->mergeCells('A5:J5'); // Merge cells for the title
    $titleStyle = [
        'font' => [
            'bold' => true,
            'size' => 16,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];
    $sheet->getStyle('A5')->applyFromArray($titleStyle);

    // Set headers
    $sheet->setCellValue('A6', 'Nro Nec');
    $sheet->setCellValue('B6', 'Nro Nec1');
    $sheet->setCellValue('C6', 'Dpto');
    $sheet->setCellValue('D6', 'Fecha Inicio');
    $sheet->setCellValue('E6', 'Fecha Fin');
    $sheet->setCellValue('F6', 'Objeto del Proceso');
    $sheet->setCellValue('G6', 'Observación');
    $sheet->setCellValue('H6', 'Actividad');
    $sheet->setCellValue('I6', 'Días Mora');
    $sheet->setCellValue('J6', 'Horas Mora');

    // Apply styles to headers
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4F81BD'],
        ],
    ];
    $sheet->getStyle('A6:J6')->applyFromArray($headerStyle);

    // Apply borders to all cells
    $borderStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ];

    // Fill data
    $row = 7;
    foreach ($necesidades as $necesidad) {
        $sheet->setCellValue('A' . $row, $necesidad->nro_nec);
        $sheet->setCellValue('B' . $row, $necesidad->nro_nec1);
        $sheet->setCellValue('C' . $row, $necesidad->dpto);
        $sheet->setCellValue('D' . $row, $necesidad->fecha_ini);
        $sheet->setCellValue('E' . $row, $necesidad->fecha_fin);
        $sheet->setCellValue('F' . $row, $necesidad->descripcionn);
        $sheet->setCellValue('G' . $row, $necesidad->observaciones);
        $sheet->setCellValue('H' . $row, $necesidad->descripcion);
        $sheet->setCellValue('I' . $row, $necesidad->dias_mora);
        $sheet->setCellValue('J' . $row, $necesidad->horas_mora);
    
        $row++;
    }

    // Apply border style to the entire data range
    $sheet->getStyle('A6:J' . ($row - 1))->applyFromArray($borderStyle);

    $writer = new Xlsx($spreadsheet);
    $fileName = 'reporte_procesos_en_mora.xlsx';
    $writer->save($fileName);

    return response()->download($fileName)->deleteFileAfterSend(true);
}



    }



