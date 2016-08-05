<?php 
	class Encryptor {
		
		private $dado;
		
 		public  function __construct($dado) {
 			$this->dado = $dado;
 		}
		
		public function encrypt() {
			return sha1($this->dado);
		}
	}
?>
