<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Models\Aprobacion;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SelectionController extends Controller
{
    public function updateApprover(Request $request)
    {
        $ticketId = $request->input('ticket_id');
        $approverId = $request->input('approver_id');
        $action = $request->input('action');

        // Buscar el ticket por su ID
        $ticket = Ticket::find($ticketId);

        if ($ticket) {
            if ($action == 'add') {
                // Añadir aprobador al ticket
                $aprobacion = Aprobacion::create([
                    'user_id' => $approverId,
                    'ticket_id' => $ticketId,
                    'fecha_creacion' => now(),
                ]);

                // Obtener datos del usuario aprobador
                $usuarioAprobador = User::find($approverId);

                if ($usuarioAprobador && $usuarioAprobador->email) {
                    // Datos para el correo
                    $data = [
                        'subject' => 'Nuevo ticket asignado para su aprobación — Ticket N.º ' . $ticket->codigo,
                        'titulo' => 'Se le ha asignado un nuevo ticket para su revisión y aprobación.',
                        'contenido' => "
                            <p>Estimado(a) <strong>{$usuarioAprobador->name}</strong>,</p>
                            <p>Le informamos que el ticket con número <strong>{$ticket->codigo}</strong> ha sido asignado para su aprobación.</p>
                            <p><strong>Detalle del ticket:</strong><br>{$ticket->detalle}</p>
                        ",
                        'enlace' => url('/Aprobar'),
                        'enlace_texto' => 'Revisar ticket',
                        'footer' => 'Por favor, revise el ticket en el sistema y proceda con la aprobación o comentarios correspondientes.',
                        'firma' => 'Gracias por su colaboración.<br>— Equipo de Sistemas',
                        'correo_destino' => $usuarioAprobador->email,
                        'logo' => asset('recursos/logo2.png'),
                    ];

                    // Enviar correo al aprobador
                    Mail::to($usuarioAprobador->email)->queue(new TestEmail($data));
                }

            } elseif ($action == 'remove') {
                // Eliminar aprobador del ticket
                Aprobacion::where('ticket_id', $ticketId)
                    ->where('user_id', $approverId)
                    ->delete();
            }

            return response()->json(['status' => 'success', 'message' => 'Aprobador actualizado correctamente.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Ticket no encontrado.'], 404);
    }
    public function saveApprovers(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|integer|exists:tickets,id',
            'approver_ids' => 'array',
            'approver_ids.*' => 'integer|exists:users,id', // Suponiendo que estás guardando IDs de usuarios
        ]);

        $ticket = Ticket::FindOrFail($request->input('ticket_id'));

        $approverIds = $request->input('approver_ids');
        // Obtener los aprobadores actuales para este ticket
        $aprob_act = Aprobacion::where('ticket_id', $ticket->id)->pluck('user_id')->toArray();

        $toAdds = array_diff($approverIds, $aprob_act);
        $toRemove = array_diff($aprob_act, $approverIds);
       // Aprobadores a agregar

        foreach ($toAdds as $toAdd) {

        }
        // Eliminar aprobadores


        return response()->json(['message' => 'Aprobadores actualizados con éxito.']);
    }
    public function getSelectedItems(Request $request)
    {
        dd($request);
        // Obtener elementos seleccionados de la sesión
        $selectedItems = Session::get('selected_items', []);
        return response()->json($selectedItems);
    }

    public function saveSelectedItems(Request $request)
    {
//        dd($request);
        // Validar los datos
        $request->validate([
            'selected_ids' => 'array',
            'selected_ids.*' => 'integer|exists:users,id', // Suponiendo que estás guardando IDs de usuarios
        ]);

        // Guardar los elementos seleccionados en la sesión
        $selectedIds = $request->input('selected_ids');
        foreach ($selectedIds as $selectedId) {
//            $exit = Aprobacion::

        }
        $selectedItems = \App\Models\User::whereIn('id', $selectedIds)->get(['id', 'username']);
        Session::put('selected_items', $selectedItems);

        return response()->json(['message' => 'Selección guardada.']);
    }
}
