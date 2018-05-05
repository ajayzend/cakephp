<?php
class CommonHelper extends AppHelper {

	public function showDate($date)
	{
		if($date!='')
		{
		return date('d-m-Y h:i A',strtotime($date));
		}
	}
	
	public function showAvgRating($allRating)
	{
	$totalCount=count($allRating);
		$total=0;
		if($totalCount>0)
		{
			foreach($allRating as $ratingData)
			{
			$total=$total+$ratingData['rating'];	
			}
			$total=$total/$totalCount;
		}
		return round($total);	
	}
	
	public function author($str)
	{
		if($str['author']=='')
		{
		$ret='No Name';	
		} else  if($str['website']!='') {
		$ret='<a href="'.$this->makeLink($str['website']).'" target="_blank">'.$str['author'].'</a>';
		} else {
		$ret=$str['author'];	
		}
	return $ret;	
	}
	
	function makeLink($link)
	{
		if($link!='')
		{
			if(strstr('http://',$link) || strstr('https://',$link))
			{
			$ret=$link;	
			} else {
			$ret='http://'.$link;
			}
		return $ret;
		}	
		
	}
	
	function CarCount($id, $userid, $groupid)
	{

		App::import("Model", "Car");
		$model = new Car();
		$model->unbindModelAll();

		if(!$userid)
			$condition = array('car_type_id'=>$id, 'Car.publish'=>1, 'Car.groupid' => array(1, 4));
		else if($groupid == 5)
			$condition = array('car_type_id'=>$id, 'Car.publish'=>1, 'Car.groupid' => array(5));
		else
			$condition = array('car_type_id'=>$id, 'Car.publish'=>1);
		$CarMainType = $model->find('count', array('conditions'=>$condition,'recursive'=>-1,));
		return $CarMainType;
	}
	
	function getSubCat($id)
	{
		App::import("Model", "CarType");
		$model = new CarType();
		$model->unbindModelAll();
		$CarMainType = $model->find('all', array('conditions'=>array('p_id'=>$id),'recursive'=>-1, 'limit' => 12));
		return $CarMainType;
	}


        function getBrandinfo($userid, $groupid)
        {
			if(!$userid)
				$condition = " AND c.groupid IN(1, 4)";
			else if($groupid == 5)
				$condition = " AND c.groupid IN(5)";
			else
				$condition = " ";
               $user= ClassRegistry::init('User');
			$query = "SELECT b.id,b.brand_name,b.brand_image,COUNT(c.id) as total  
						FROM `brands` b 
						LEFT JOIN cars c ON c.brand_id=b.id 
						where c.publish=1 AND c.deleted=0 $condition GROUP BY c.brand_id order by total desc";
               $result = $user->query($query);
		return $result;
        }



	
	function getPopularBrand($id)
	{
		App::import("Model", "Car");
		$model = new Car();
		
		$model->unbindModelAll();
		$model->bindModel(array('belongsTo'=>array('Brand'=>array('fields'=>array('')))));
		$condition = array('Car.car_type_id'=>$id);
		$fields = array('Brand.id','Brand.brand_name','Car.car_type_id'); 
		$group = array('Car.brand_id');
		$order = array('Brand.priority');
		
		$brandDetail = $model->find('all' , array('fields'=>$fields,'group'=>$group,'order'=>$order ,'conditions'=>$condition,'recursive'=>0, 'limit' => 7));
		return $brandDetail;
	}
}
