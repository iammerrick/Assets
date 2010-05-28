<?php
	/**
	* Assets takes urls and makes dynamic files that play nice with HTTP.
	*/
	class Assets
	{
		protected $output = '';
		protected $assets = array();
		
		function __construct()
		{
			// Use the factory method. It's sexier and allows for some chaining love.
		}
		
		public function factory()
		{
			return new Assets;
		}
		
		public function get()
		{
			$files = explode(',', $_GET['load']);
			foreach($files as $file)
			{
				$file = 'js/' . $file . '.js';
				$this->add($file);
			}
			
			return $this;
		}
		
		public function add($asset)
		{
			if(is_array($asset))
			{
				$this->assets = array_merge($this->assets, $asset);
			}
			else
			{
				$this->assets[] = $asset;
			}
			
			return $this;
		}
		
		public function render($print = TRUE)
		{
			if($print)
			{
				$this->compile();
				echo $this->output;	
			}
			else
			{
				return $this->compile();
			}
		}
		
		private function compile()
		{
			foreach($this->assets as $asset)
			{
				$this->output .= file_get_contents($asset);
			}
		}
	}
	
?>