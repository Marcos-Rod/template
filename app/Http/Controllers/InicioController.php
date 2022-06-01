<?
namespace App\Http\Controllers;
use App\Http\Response;

class InicioController
{
    public function index(){
        return new Response('inicio');
    }
}