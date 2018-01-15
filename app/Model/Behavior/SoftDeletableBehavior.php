<?php 
class SoftDeletableBehavior extends ModelBehavior {
	 var $__settings = array(); 
    function setup(Model $Model, $settings = array())
    {
        $default = array('field' => 'deleted', 'field_date' => 'deleted_date', 'delete' => true, 'find' => true);

        if (!isset($this->__settings[$Model->alias]))
        {
            $this->__settings[$Model->alias] = $default;
        }

        $this->__settings[$Model->alias] = am($this->__settings[$Model->alias], ife(is_array($settings), $settings, array()));
    } 

    // override the delete function (behavior methods that override model methods take precedence)
    /*
    function delete(Model $Model, $id = null) {
        $Model->id = $id;
        echo $id;
        
		//return false;
        // save the deleted field with current date-time
        if ($Model->saveField('deleted', 1)) {
            return true;
        }

        return false;
    }
    */
    // override the deleteAll function (behavior methods that override model methods take precedence)
   /* function deleteAll(Model $Model, $id = null) {
        $Model->id = $id;

        // save the deleted field with current date-time
        if ($Model->saveMany($id)) {
            return true;
        }

        return false;
    }
*/
    function beforeFind(Model $Model, $query) {
         if ($this->__settings[$Model->alias]['find'] && $Model->hasField($this->__settings[$Model->alias]['field']))
        {
            $Db =& ConnectionManager::getDataSource($Model->useDbConfig);
            $include = false;

            if (!empty($queryData['conditions']) && is_string($queryData['conditions']))
            {
                $include = true;

                $fields = array(
                    $Db->name($Model->alias) . '.' . $Db->name($this->__settings[$Model->alias]['field']),
                    $Db->name($this->__settings[$Model->alias]['field']),
                    $Model->alias . '.' . $this->__settings[$Model->alias]['field'],
                    $this->__settings[$Model->alias]['field']
                );

                foreach($fields as $field)
                {
                    if (preg_match('/^' . preg_quote($field) . '[\s=!]+/i', $queryData['conditions']) || preg_match('/\\x20+' . preg_quote($field) . '[\s=!]+/i', $queryData['conditions']))
                    {
                        $include = false;
                        break;
                    }
                }
            }
            else if (empty($queryData['conditions']) || (!in_array($this->__settings[$Model->alias]['field'], array_keys($queryData['conditions'])) && !in_array($Model->alias . '.' . $this->__settings[$Model->alias]['field'], array_keys($queryData['conditions']))))
            {
                $include = true;
            }

            if ($include)
            {
                if (empty($queryData['conditions']))
                {
                    $queryData['conditions'] = array();
                }

                if (is_string($queryData['conditions']))
                {
                    $queryData['conditions'] = $Db->name($Model->alias) . '.' . $Db->name($this->__settings[$Model->alias]['field']) . '!= 1 AND ' . $queryData['conditions'];
                }
                else
                {
                    $queryData['conditions'][$Model->alias . '.' . $this->__settings[$Model->alias]['field']] = '!= 1';
                }
            }
        }

        return $queryData; 
    }
}
