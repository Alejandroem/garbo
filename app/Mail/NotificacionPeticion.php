<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Peticiones;

class NotificacionPeticion extends Mailable
{
    use Queueable, SerializesModels;
    protected $peticion;
    protected $message;
    protected $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Peticiones $peticion,$title,$message)
    {
        //
        $this->peticion = $peticion;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.NotificacionPeticion')
            ->with([
                'peticion' => $this->peticion,
                'title' => $this->title,
                'message' => $this->message,
            ]);;
    }
}
