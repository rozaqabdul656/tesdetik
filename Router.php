<?php
include_once __DIR__ . '/vendor/autoload.php';
class Router
{
  private $request;
  private $supportedHttpMethods = array(
    "GET",
    "POST"
  );

  function __construct(IRequest $request)
  {
  header('Content-type:application/json;charset=utf-8');
   $this->request = $request;
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();
   
  }

  function __call($name, $args)
  {
    list($route, $method) = $args;

    if(!in_array(strtoupper($name), $this->supportedHttpMethods))
    {
      $this->invalidMethodHandler();
    }

    $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
  }

  /**
   * Removes trailing forward slashes from the right of the route.
   * @param route (string)
   */
  private function formatRoute($route)
  {
    $result = rtrim($route, '/');
    if ($result === '')
    {
      return '/';
    }
    return $result;
  }

  private function invalidMethodHandler()
  {
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
  }

  private function defaultRequestHandler()
  {
    header("{$this->request->serverProtocol} 404 Not Found");
    echo "Undfined Route";
  }

  /**
   * Resolves a route
   */
  function resolve()
  {
    if(!(isset($_SERVER["HTTP_X_API_KEY"]))){
      header("{$this->request->serverProtocol} 401 Unauthorized");
      echo "Unauthorized";
      return;
      
    }if(($_SERVER["HTTP_X_API_KEY"] != $_ENV['API_KEY'])){
      header("{$this->request->serverProtocol} 401 Unauthorized");
      echo "Unauthorized";
      return;
    }
    $methodDictionary = $this->{strtolower($this->request->requestMethod)};
    $formatedRoute = $this->formatRoute($this->request->requestUri);
    
    $method = isset ($methodDictionary[$formatedRoute]) ? $methodDictionary[$formatedRoute]:NULL;

    
    if(is_null($method))
    {
      $this->defaultRequestHandler();
      return;
    }

    echo call_user_func_array($method, array($this->request));
  }

  function __destruct()
  {
    $this->resolve();
  
  }
  function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}
}