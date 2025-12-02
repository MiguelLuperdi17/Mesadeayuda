<?php

namespace App\Imports;

use App\Models\Balances;
use App\Models\Materiales;
use App\Models\SubBalances;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BalancesImport implements ToModel, WithStartRow
{
    private $startRow = 7; // Indica la fila desde la cual comenzar a importar
    private $failedRows = []; // Lista para almacenar los índices de las filas que no se pudieron importar
    private $rowCount = 4; // Contador de filas procesadas, iniciado desde la cuarta fila (índice 3)

    private $balanceId;
    private $fechaBalance;

    public function __construct($balanceId = null,$fechaBalance = null)
    {
        $this->balanceId = $balanceId;
        $this->fechaBalance = $fechaBalance;
    }

    public function model(array $row)
    {
        date_default_timezone_set('America/Lima'); // Establecer la zona horaria a Lima

        // Obtener el código del material del archivo Excel
        $codigo = $row[1];
        // dd($this->fechaBalance);
        // Buscar si existe un registro en SubBalances con el código del material
        $subBalance = SubBalances::where('codigo', $codigo)->where('fecha',$this->fechaBalance)->first();
        // Si existe, actualizar los campos correspondientes
        if ($subBalance) {
            $subBalance->update([
                'stock_fisico' => $row[7], // Actualizar stock físico desde el archivo Excel
                // 'descripcion_pro' => $row[3], // Actualizar stock físico desde el archivo Excel
                // 'fecha' => now()->toDateString(), // Actualizar la fecha actual
            ]);
            // Regresar null para indicar que no se debe crear un nuevo registro
            return null;
        }
        // Si no existe, crear un nuevo registro
        return new SubBalances([
            'codigo' => $codigo,
            'stock_fisico' => $row[7],
            // 'descripcion_pro' => $row[3], // Actualizar stock físico desde el archivo Excel
            'fecha' => now()->toDateString(),
            'estado' => 2,
            'id_balance' => $this->balanceId, // Asignar el ID del balance si está disponible
        ]);
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