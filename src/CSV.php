<?php

namespace Chadanuk;
/**
* CSV Class
*/
class CSV 
{
	protected $file;
	public $data  = array();


	function __construct($file = null)
	{

		$this->file = $file;
		if( ! empty($file))
		{
			$_SESSION['dc_csv_file'] = $file;
			$this->set_data();
		}
		
		if(isset($_SESSION['dc_csv_data']))
		{
			$this->data = $_SESSION['dc_csv_data'];
		}
		if( ! $this->has_data())
		{
			$this->set_data();
		}
		
	}

	/**
	 * Check if data exists function
	 *
	 * @return boolean
	 * @author 
	 **/
	public function has_data()
	{
		return (!empty($this->data));
	}

	/**
	 * save data in session
	 *
	 * @return void
	 * @author 
	 **/
	public function set_data()
	{
		if( empty($this->data))
		{	
			$this->load_data();
		}

		$_SESSION['dc_csv_data'] = $this->data;

	}

	public function load_data() 
	{
		ini_set('auto_detect_line_endings', TRUE);
		set_time_limit(8348348382);
		if($this->file == null)
		{
			return;
		}
	    $f = fopen($this->file, "r");

	    $result = false;
	    $rc = 1;
	    while (($row = fgetcsv($f, 1000, ",")) !== FALSE) 
	    {
	    	
	        if($rc == 1)
	        {
	        	$this->data['headers'] = $row;
	        }
	        else
	        {
	        	if(empty($this->data['data']))
	        	{
	        		$this->data['data'] = array();
	        	}

	        	$this->data['data'][] = array_combine($this->data['headers'], $row);
	        }
	        
	        $rc++;
	    }
	    
	    fclose($f);
	}

	public function finditem($field, $value) 
	{
	   	foreach($this->data['headers'] as $field_no => $header)
	   	{
	   		if($header == $field)
	   		{
	   			break;
	   		}
	   	} 
	    
	   	foreach($this->data['data'] as $k => $row)
	   	{
	   		if( ! empty($row) && $row[$header] == $value)
	   		{
	   			
	   			return $row;
	   			break;
	   		}
	   	}

	    return array();
	}
}