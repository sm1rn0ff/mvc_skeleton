<?php
	namespace Library;

	class HttpResponse extends ApplicationComponent
	{
		protected $page;
		
		public function addHeader($header)
		{
			header($header);
		}
		
		public function redirect($location)
		{
			header('Location: ' . $location);
		}
		
		public function redirect404()
		{
			$this->page = new Page($this->app);
			$this->page->setContentFile(__DIR__ . '/../Errors/404.php');
			
			$this->addHeader('HTTP/1.0 404 Not Found');
			
			$this->send();
		}
		
		public function send()
		{
			exit($this->page->getGeneratedPage());
		}
		
		public function setPage(Page $page)
		{
			$this->page = $page;
		}
		
		public function setcookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
		{
			setcookie($name, $value, $path, $domain, $secure, $httpOnly);
		}
	}
