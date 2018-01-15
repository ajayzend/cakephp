<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public $defaultFields;
        public $softFind = true;
        public $softDelete = true;
        public $defaultConditions;
#	public $recursive = -1;
        // var $actsAs = array('SoftDeletable' => array('find' => true, 'deleted' => '0')); 
	// public $actsAs = array('SoftDeletable');
    public function getModelName(){
        if($this->softFind == true){
         $a = array();
         $a[$this->alias.".deleted"] =  0;
         $this->defaultConditions = $a;
        }
    }   
    public function beforeFind($queryData){
         $this->getModelName();
        if(isset($this->defaultFields) && !empty($this->defaultFields)) {
			$queryData['fields'] = array_merge((array)$this->defaultFields,(array)$queryData['fields']);
		}
		
		if(isset($this->defaultConditions) && !empty($this->defaultConditions)) {
			$queryData['conditions'] = array_merge((array)$this->defaultConditions,(array)$queryData['conditions']);
		}
		
		return $queryData;
       
        
    }
    public function unbindModelAll()
  {
    $unbind = array();
    foreach ($this->belongsTo as $model=>$info)
    {
	  $unbind['belongsTo'][] = $model;
    }
	
    foreach ($this->hasOne as $model=>$info)
    {
      $unbind['hasOne'][] = $model;
    }
    foreach ($this->hasMany as $model=>$info)
    {
      $unbind['hasMany'][] = $model;
    }
    foreach ($this->hasAndBelongsToMany as $model=>$info)
    {
      $unbind['hasAndBelongsToMany'][] = $model;
    }
	
    parent::unbindModel($unbind);
  }
  
  function delete($id = NULL, $cascade = true) {
      if($this->softDelete == true){  
      $this->id = $id;
       
       
		//return false;
        // save the deleted field with current date-time
        if ($this->saveField('deleted', 1)) {
            return true;
        }else{
				return false;
			}
      }else{
          
          parent::delete($id,$cascade);
          
          
      }
    }
	
  
}
