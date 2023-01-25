

<?php

class Router {
  
  protected $routes = [];

  protected $params = [];

  public function add($route, $params = []) {
    $route = preg_replace("/\//", "\\/", $route);

    $route = preg_replace("/\{([a-z]+)\}/", "(?<\\1>[a-z-]+)", $route);

    $route = preg_replace("/\{([a-z]+):([^\}]+)\}/", "(?<\\1>\\2)", $route);

    $route = "/^" . $route . "$/i";

    $this->routes[$route] = $params;
   
  }

  public function getRoutes() {
    return $this->routes;
  }

  public function explode_url($url) {
    if(preg_match("/&/", $url, $matches)) {
        $url = explode("&", $url, 2);
        $url = $url[0];
        return $url;
    } else {
        return $url;
    }
  }

  public function match($url) {
    $url = $this->explode_url($url);
    foreach ($this->routes as $route => $parameters) {
      if (preg_match($route, $url, $matches)) {
        $params = [];
        
        foreach ($matches as $key => $match) {
          if (is_string($key)) {
            $parameters[$key] = $match;
          }
        }
        $this->params = $parameters;
        return true;
      }
    }
    return false;
  }

  public function getParams() {
    return $this->params;
  }

  public function autoload($classname) {
    return spl_autoload_register(function($classname) {
        $root = "../App/Controllers";
        $file = $root . "/$classname.php";
        if(is_readable($file)) {
            require "$file";
        } 
        else {
            // header("Location: /retrieve/home");
            echo "Page 404";
            exit();
        }
    });
  }

  public function dispatch($url) {

    if ($this->match($url)) {
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);

      if ($this->autoload($controller)) {
        $controller_object = new $controller();

        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);

        if (method_exists($controller, $action)) {
          $controller_object->$action();
        } else {
          echo "Method $action (in controller $controller) not found";
        }
      } else {
        echo "Controller class $controller not found.";
      }
    } else {
      echo "No route matched";
    }
  }

  public function convertToStudlyCaps($string) {
    return str_replace(" ", "", ucwords(str_replace("-", " ", $string)));
  }

  public function convertToCamelCase($string) { {
      return lcfirst($this->convertToStudlyCaps($string));
    }
  }

}
