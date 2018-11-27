<?php defined('BASEPATH') or exit('No direct script access allowed');

//Model override
class MY_Model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	// Generates a random 64 bit string
	private function _generate_random_string($prepend='',$append='',$length=NULL)
	{
		$length = empty($length) ? ID_STRING_LENGTH : $length;
	
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
		$characters_length = strlen($characters);
		$randomString = isset($prepend) ? $prepend : '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $characters_length - 1)];
		}
		return $randomString.@$append;
	}

	/** Get a table field  
	 * @param string $table_name The name of the table the column/field belongs to
	 * @param string $field_name The column/field name we want to get a reference to. Defaults to all columns in the specified table
	 * @return string Returns a complete sql based concatenation of the table and field/column name 
	*/
	protected function get_table_field(string $table_name,string $field_name='*'):string
	{
		return $table_name.'.'.$field_name;
	}

	// Checks if an id exists, returns true if it does and false if it doesn't
	private function _id_exists($table_name,$id_column,$generated_id)
	{
		$_field_id = $this->get_table_field($table_name,$id_column);
		$this->db->select($_field_id);

		// Check if the id exists in the table we are trying to add it to
		$this->db->where(
			array(
				$_field_id => $generated_id
			)
		);
		$item_found = $this->db->get($table_name)->row_object();

		return !empty($item_found);
	}

	/** Generate a random string id for the table specified 
	 * @param string $table_name The name of the table we want to check for the id
	 * @param mixed $id_column Name of the id column we are going to be checking
	*/
	public function generate_string_id($table_name,$id_column='id')
    {		
		$generated_id = $this->_generate_random_string();
		
		$item_exists = $this->_id_exists($table_name,$id_column,$generated_id);

		// If id exists ~ try genrating again (recursively)
		if($item_exists)
		{//! Big O of log(N) ~ Consider finding optimization, possibly use dynamic programming
			$generated_id = $this->generate_string_id($table_name,$id_column);
		}
		else
		{
			return $generated_id;
		}
	}

	/** Generate a random integer id for the table specified 
	 * @param string $table_name The name of the table we want to check for the id
	 * @param mixed $id_column Name of the id column we are going to be checking
	*/
	public function generate_int_id($table_name,$id_column)
	{
		$generated_id = rand((int)ID_INT_MIN,(int)ID_INT_MAX);
		
		$item_exists = $this->_id_exists($table_name,$id_column,$generated_id);

		// If id exists ~ try genrating again (recursively)
		if($item_exists)
		{//! Big O of log(N) ~ Consider finding optimization, possibly use dynamic programming
			$generated_id = $this->generate_int_id($table_name,$id_column);
		}
		else
		{
			return $generated_id;
		}
	}


}
