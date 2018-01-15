<?php
class Tax extends AppModel
{

	  function taxValidate() {
	  	//pr($this->data);die;
		$validate1 = array(
		'tax_value'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please Enter Tax Value.')
					));
				$this->validate=$validate1;
		return $this->validates();
	}
}
