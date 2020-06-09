<?php
namespace Rentit;

class App
{


static function run(){

    $routes=self::getRoutes();

    $request=new Request();
    $controller=$request->getController();
    $action=$request->getAction();


    try{
        if(in_array($controller, $routes)){
            $nameController='\\Rentit\Controllers\\'.ucfirst($controller).'Controller';
            $objCont=new $nameController($request);



            if(is_callable([$objCont,$action])){
                call_user_func([$objCont,$action]);
            }else{
                call_user_func([$objCont,'error']);
            }
        }else{
            throw new \Exception("[ERROR]: Ruta no definida");
        }

    }catch (\Exception $e){
        echo $e->getMessage();
    }

}

    /*
     * Extract controlle and method
     * @return array
     */


    static function getRoutes():Array{
        $dir=__DIR__.'/Controllers';
        $handle=opendir($dir);
        while (false!=($entry=readdir($handle))){
            if($entry!="." && $entry!="..") {
           $routes[]=strtolower(substr($entry,0,-14));
            }
        }
        return $routes;
    }
}