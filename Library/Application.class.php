<?php
	namespace Library;
	
	abstract class Application
	{
		protected $httpRequest;
		protected $httpResponse;
		protected $name;
		protected $config;
		protected $user;

		public function __construct()
		{
			$this->httpRequest = new HttpRequest($this);
			$this->httpResponse = new HttpResponse($this);
			$this->name = '';
			$this->config = new Config($this);
			$this->user = new User($this);
		}
		
		public function getController()
		{
			$router = new \Library\Router();
			
			$xml = new \DOMDocument;
			$xml->load(__DIR__ . '/../Applications/' . $this->name . '/Config/routes.xml');
			
			$routes = $xml->getElementsByTagName('route');
			
			foreach ($routes as $route)
			{
				$vars = array();
				
				if($route->hasAttribute('vars'))
				{
					$vars = explode(',', $route->getAttribute('vars'));
				}
				
				$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
			}
			
			try
			{
				$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
			}
			catch (\RuntimeException $e)
			{
				if($e->getCode() == \Library\Router::NO_ROUTE)
				{
					$this->httpResponse->redirect404();
				}
			}
			
			$_GET = array_merge($_GET, $matchedRoute->vars());
			
			$controllerClass = 'Applications\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
			
			return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
		}
		
		abstract public function run();
		
		public function httpRequest()
		{
			return $this->httpRequest;
		}
		
		public function httpResponse()
		{
			return $this->httpResponse;
		}
		
		public function name()
		{
			return $this->name;
		}
		
		public function config()
		{
			return $this->config;
		}
		
		public function user()
		{
			return $this->user;
		}
	}
	