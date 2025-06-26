<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cita;

class RecordatorioCitaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cita;

    /**
     * Create a new message instance.
     */
    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Recordatorio de Cita - ProSalud')
                    ->view('emails.recordatorio-cita')
                    ->with([
                        'cita' => $this->cita,
                        'paciente' => $this->cita->paciente,
                        'profesional' => $this->cita->profesional,
                        'consultorio' => $this->cita->consultorio
                    ]);
    }
}
