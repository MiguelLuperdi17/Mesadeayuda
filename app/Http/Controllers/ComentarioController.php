<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Models\Comentario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ComentarioController extends Controller
{
    public function index()
    {
        $variable = "Hola";
//        $tickets = Ticket::getLista();
//        foreach ($tickets as $ticket) {
//            dd($ticket->id, $ticket->adjuntos);
//        }
        return view('ticket.index',compact('variable'));
    }

    public function MisComentarios(Request $request)
    {
        $comentarios = Comentario::getListaTicket($_POST['ticket_id']);
        return json_encode([$comentarios]);
    }

    public function create(Request $request)
    {
        $comentario = new Comentario();
        $comentario->ticket_id = $request->ticket_id;
        $comentario->comentario = $request-> comentario;
        $comentario->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $comentario->user_id = Auth::user()->id;
        $comentario->save();
        $data = [
            'subject' => 'Nuevo comentario en su ticket N.º '.$comentario->ticket->codigo,
            'titulo' => 'Le informamos que su ticket con número '.$comentario->ticket->codigo.', relacionado a "'.$comentario->ticket->detalle.'", ha sido actualizado con el siguiente comentario por parte del equipo de soporte:',
            'contenido' => "
                <strong>Comentario de: {$comentario->user->username}</strong><br>
                \"{$comentario->comentario}\"
            ",
            'enlace' => 'http://mesadeayudalaredo.com/MisTickets',
            'enlace_texto' => 'Ver ticket',
            'footer' => 'Si tiene alguna duda o desea agregar información adicional, puede responder directamente desde el portal.',
            'firma' => 'Gracias por su atención.<br>— Equipo de Sistemas',
            'correo_destino' => $comentario->ticket->usercreador->email,
            'logo' => asset('recursos/logo2.png'), // opcional
        ];

        Mail::to($comentario->ticket->usercreador->email)->queue(new TestEmail($data));

        return redirect()->back()->with('success', 'Se creó el comentario solicitado.');
    }
}
