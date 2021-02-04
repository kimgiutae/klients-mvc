<?php


namespace app\core;


class Router {
  
  // 
  
  protected array $routes = [
    'get' => [],
    'post' => [],
  ];
  
  // 
  
  public Request $request;
  
  // 
  
  public function __construct($request) {
    
    $this->request = $request;
    
  }
  
  // 
  
  public function get($path, $func) {
    
    $this->routes['get'][$path] = $func;
    
  } 
  
  // 
  
  public function resolve() {
    
    $method = $this->request->getMethod();
    $path = $this->request->getPath();
    $func = $this->routes[$method][$path] ?? null;
    
    if (!$func) {
      return 'Not found';
    }
    
    if (is_string($func)) {
      return $this->renderView($func);
    }
    
    return call_user_func($func);
    
  }
  
  // 
  
  public function renderView($view) {
    
    $layout = $this->getViewLayout();
    
  }
  
  // 
  
  protected function getViewLayout() {
    
    include_once App::$ROOT_DIR . '/views/layouts/base.php';
    
  }
  
}

