php_csv_browser
===============

Get specific information from any CSV


After your file is upload initialise the CSV browser by parsing the file name to the constructor.

		$c = new CSV($filename);
	
Then use the finditem method to retrieve the row of data you want based on a field and value

		$data = $c->finditem('name', 'Dave'); 
