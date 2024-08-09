<?php

namespace App\DataTransferObjects\Relatorio;

use App\Models\Votacoes\Sufragios;
use Illuminate\View\View;

class Pdf
{
    public function __construct(protected Sufragios $sufragio){
        // Code...
    }

    public function html(): View
    {
        return view(
            'A4.Portrait.Relatorio',
            [
                'sufragio' => $this->sufragio,
                'data'=> date('d/m/Y'),
                'hora' => date('H:i:s')
            ]
        );
    }
}
