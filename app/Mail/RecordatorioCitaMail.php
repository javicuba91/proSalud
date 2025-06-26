<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cita;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $qrCodeData = null;

        // Generar QR como imagen base64 si existe
        if ($this->cita->codigo_qr) {
            $qrCodeData = base64_encode(QrCode::format('png')->size(150)->generate($this->cita->codigo_qr));
        }

        return $this->subject('Recordatorio de Cita - ProSalud')
                    ->view('emails.recordatorio-cita')
                    ->with([
                        'cita' => $this->cita,
                        'paciente' => $this->cita->paciente,
                        'profesional' => $this->cita->profesional,
                        'consultorio' => $this->cita->consultorio,
                        'qrCodeData' => $qrCodeData
                    ]);
    }
}
