<?php

namespace App\Models\Traits;

use App\Models\AvaliacaoDesempenho\EvaluationStatus;
use App\Models\AvaliacaoDesempenho\Question;
use App\Models\External\IDONIC\AsResultado;
use App\Models\External\IDONIC\Pessoa;
use App\Models\External\PRIMAVERA\Departamento;
use App\Models\External\PRIMAVERA\Funcionario;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

trait GeneratePDF
{

    public $pdfGerado = NULL;
    public $initDepartament;
    public $idFuncionarioF = 0;


    public function gerarPDF()
    {
        $injustificadas = AsResultado::faltasInjustificadasCopia($this->funcionario)
            ->dateBetween($this->initialDate, $this->finalDate)
            ->orderBy('Data', 'desc')->get();

        $html = View::make('Reports.presenca-funcionario',
            [
                'faltasInjustificadas' => $injustificadas,
                'totalInjustificadas' => collect($injustificadas)->count(),
                'totalJustificadas' => 0,
                'nomeFuncionario' => Pessoa::where('ID', $this->funcionario)->first()['Nome']
            ]
        )->render();
        $pdf = PDF::setPaper('letter', 'portrait')->loadHtml($html);
        $pathName = 'storage/Reports/PresençaFuncionario' . $this->idFuncionarioF . date('Y') . date('m') . date('d') . '.pdf';
        $pdf->save($pathName);
        $this->pdfGerado = asset($pathName);

    }


}
