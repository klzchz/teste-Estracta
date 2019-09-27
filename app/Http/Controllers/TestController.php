<?php

namespace App\Http\Controllers;


use App\Salary;
use Goutte\Client;
// use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;



class TestController extends Controller
{
    
    private $base_uri = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

    public function index()
    {
        $client =  new Client();
        // $salary = new Salary();
        
        $crawler = $client->request('GET', 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm');

        
        
        $final = [
           
     
        ];


            foreach ($this->multiplos(6) as $key => $value) {

                $r =  $crawler->filter('td')->eq($value)->siblings()->each(function ($node) {
                    return $node->text();
                });
               
                array_push($final, $r);
            }

           

            foreach ($this->multiplos(6) as $key => $value) {

                $r =  $crawler->filter('td')->eq($value)->first()->each(function ($node) {
                    return $node->text();
                });
                
                array_push($final[$key], $r[0]);
            }
      
            
                $response = [];

            for ($i=0; $i < 21; $i++) { 
                $arr = [];
                $arr['valor_mensal ']=  $final[$i][0];
                $arr['valor_diario ']=  $final[$i][1];
                $arr['valor_hora ']=  $final[$i][2];
                $arr['norma_legal ']=  $final[$i][3];
                $arr['dou ']=  $final[$i][4];
                $arr['vigencia ']=  $final[$i][5];
                // dd($arr);
                array_push($response,$arr);
                
            }
          
            return $response;
       

    }

    function multiplos($n)
    {
       $a = [] ;
       for ($i=1; $i < 22; $i++) { 
            array_push($a,($i*$n));
       }
       return $a;
    }
}
