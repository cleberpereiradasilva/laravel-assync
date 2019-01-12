<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessaImportacao;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function importarPares($path){
        $pares = fopen(storage_path("app/pares.txt"), "w");
        $file = fopen(storage_path("app/". $path), "r");
        while(!feof($file)) {
            $linha = fgets($file);
            $colunas = explode("|", $linha);
            if( (int)$colunas[0] % 2 == 0){
                fwrite($pares,$linha);
                sleep(5);
            }
        }
        fclose($file);
        fclose($pares);
        return ;
    }

    public function store(Request $request)
    {
        $path = $request->file('arquivo')->store('arquivo');
        //$this->importarPares($path);
        ProcessaImportacao::dispatch($this, $path);
        echo "Navegador liberado....";
    }
}
