<?
namespace App\Http;

class Request{
    protected $segments = [];
    protected $controller;
    protected $method;

    public function __construct()
    {
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);

        $this->setController();
        $this->setMethod();
    }

    //Setea nombre del controlador
    public function setController(){
        $this->controller = empty($this->segments[1])
            ? 'inicio'
            : $this->segments[1];
    }

    //Setea nombre del methodo (por defecto index)
    public function setMethod(){
        $this->method = empty($this->segments[2])
            ? 'index'
            : $this->segments[2];
    }

    //Obtiene el nombre del controlador desde la URI para buscar el archivo
    public function getController(){
        $controller = ucfirst($this->controller);

        return "App\Http\Controllers\\{$controller}Controller";
    }

    //Obtiene el metodo
    public function getmethod(){
        return $this->method;
    }

    //Manda a traer el controlador
    public function send(){
        $controller = $this->getController();
        $method = $this->getmethod();

        $response = call_user_func([
            new $controller,
            $method
        ]);

        $response->send();
    }
}