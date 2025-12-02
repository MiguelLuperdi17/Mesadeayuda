<?php

namespace App\Imports;

use App\Models\Materiales;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class HtmlImport implements ToModel
{
    private $startRow = 2; // Indica la fila desde la cual comenzar a importar
    private $failedRows = []; // Lista para almacenar los índices de las filas que no se pudieron importar
    private $rowCount = 0; // Contador de filas procesadas

    public function model(array $row)
    {
        // Incrementar el contador de filas procesadas
        $this->rowCount++;

        // Si la fila actual es menor que la tercera fila, ignorarla
        if ($this->rowCount <= 2) {
            return null;
        }

        // Verificar si el código está vacío o ya existe en la base de datos
        if (empty($row[0]) || Materiales::where('codigo', $row[0])->exists()) {
            // Agregar el índice de la fila a la lista de filas fallidas
            $this->failedRows[] = $this->getRowIndex();

            // No importar la fila
            return null;
        }

        // Si el registro no existe y el código no está vacío, crear un nuevo modelo Materiales
        return new Materiales([
            'codigo' => $row[0],
            'nro_parte' => $row[1],
            'marca' => $row[2],
            'descripcion' => $row[3],
            'desc_larga' => $row[4],
            'um' => $row[5],
            'familia' => $row[6],
            'sub_familia' => $row[7],
            'grupo' => $row[8],
            'costo_unitario' => $row[9],
            // 'ubi_1' => $row[10],
            // 'ubi_2' => $row[11],
            // 'ubi_3' => $row[12],
        ]);
    }

    // public function rules(): array
    // {
    //     // Reglas de validación (opcional)
    //     return [
    //         '0' => 'required|unique:materiales,codigo', // El código debe ser único y no estar vacío
    //     ];
    // }

    public function getFailedRows(): array
    {
        return $this->failedRows;
    }

    private function getRowIndex(): int
    {
        return $this->getRowCount() + 1; // Añadir 1 porque las filas se indexan desde 0
    }

    private function getRowCount(): int
    {
        return count($this->failedRows);
    }
}