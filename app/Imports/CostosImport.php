<?php

namespace App\Imports;

use App\Models\Ccosto;
use App\Models\Linea;
use App\Models\Observacion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CostosImport implements ToModel, WithStartRow
{
    private $startRow = 2; // Indica la fila desde la cual comenzar a importar
    private $failedRows = []; // Lista para almacenar los índices de las filas que no se pudieron importar

    public function __construct($mes)
    {
        $this->mes = $mes;
    }

    public function model(array $row)
    {
        date_default_timezone_set('America/Lima'); // Establecer la zona horaria a Lima
        if($row[0]){
            $linea = Linea::where('numero', $row[0])->first();
            if($linea){
                $costo = new Ccosto();
                $costo->linea_id = $linea->id;
                $costo->voz = $row[2];
                $costo->voz_adicional = $row[3];
                $costo->serv_adicionales = $row[4];
                $costo->distancia_nacional = $row[5];
                $costo->distancia_internacional = $row[6];
                $costo->roaming = $row[7];
                $costo->seguro = $row[8];
                $costo->total = $row[9];
                $costo->mes = $this->mes;
                $costo->estado = $linea->costo_actual == $row[9] ? 1 : 2;
                $costo->registro = Carbon::now()->format('Y-m-d H:i:s');
                $costo->save();
            }else{
                $obs = new Observacion();
                $obs->mes = $this->mes;
                $obs->tipo = "Celular";
                $obs->detalle = "Número ".$row[0]." no registrado"; ;
                $obs->registro = Carbon::now()->format('Y-m-d H:i:s');
                $obs->save();
            }
        }
        return null;
    }
    public function getFailedRows(): array
    {
        return $this->failedRows;
    }

    public function startRow(): int
    {
        return $this->startRow;
    }
}
