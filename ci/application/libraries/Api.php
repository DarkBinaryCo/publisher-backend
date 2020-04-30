<?php defined('BASEPATH') or exit('No direct script access allowed');

class Api 
{
    private $_default_response_messages = ['success'=>'Successfully completed operation','failure'=>'Failed to complete operation'];
    protected $ci;

    function __construct($models_required = [])
    {   
        $this->ci = &get_instance();
           
        // Dynamically load each model
        foreach ($models_required as $model_name) {
            $this->ci->load->model($model_name);
        }
    }

    /** Prints API response (JSON)
     * @param bool $ok Was the operatiookay or nah
     * @param array<string> $messages An associative array in the format of `['success'=>'','failure'=>'']` representing our responses messages
     * @param array|NULL $data An associative array representing the data we want to return as part of the API response
     * @param int $status_code HTTP status code of the response. Default `200`
     */
    private function _print_api_response($ok, $messages=['success'=>'Success!','failure'=>'Failed!'],$data = NULL,$status_code = 200)
    {
        $messages =  !empty($messages) ? $messages :  $this->_default_response_messages;
        $message = $ok ? $messages['success'] : $messages['failure'];

        $api_response = [
            'ok'=>$ok,
            'message'=>$message,
            'data'=>$data,
            'status_code'=>$status_code,
        ];

        $this->ci->output(json_encode($api_response));
    }

    /** [POST] Add a single record */
    public function endpoint_create($model='',$options = ['messages'=>['success'=>'Success created record!','failure'=>'Failed to create record!']])
    {
        $insert_data = $this->ci->input->post_get('data');

        if(is_empty($insert_data)) throw new Error('Data is required for an update endpoint.');

        $create_status = $this->ci->{$model}->create_batch($insert_data);

        // Response
        $is_ok = !empty($insert_data);
        $response_data = ['create_status'=> $create_status, 'inserted_data'=>$insert_data];

        $this->_print_api_response($is_ok,$options['messages'],$response_data);
    }

    /** [POST] Add multiple records */
    public function endpoint_create_batch($model='',$options = ['messages'=>['success'=>'Success!','failure'=>'Failed!']])
    {
        $insert_data = $this->ci->input->post_get('data');

        if(is_empty($insert_data)) throw new Error('Data is required for an update endpoint.');

        $create_status = $this->ci->{$model}->create_batch($insert_data);

        // Response
        $is_ok = !empty($insert_data);
        $response_data = ['create_status'=> $create_status, 'inserted_data'=>$insert_data];

        $this->_print_api_response($is_ok,$options['messages'],$response_data);
    }

    /** [GET] Read records */
    public function endpoint_read($model='',$options = ['limit'=>NULL,'offset'=>0,'messages'=>['success'=>'Success!','failure'=>'Failed!']],$is_strict=TRUE)
    {
        $filter = $this->ci->input->post_get('filter');

        if(is_empty($filter)) throw new Error('Filter is required for an update endpoint');
        
        $this->ci->load->model($model);
        $data_found = $this->ci->{$model}->read($filter,@$options['limit'],$options['offset'],$is_strict);
        $is_ok = !!$data_found;

        $this->_print_api_response($is_ok,$options['messages'],$data_found);
    }

    /** [POST] Update records 
     * Expects filter|data
    */
    public function endpoint_update($model='',$options=['messages'=>['success'=>'Success updated record!','failure'=>'Failed to update record!']],$is_strict=TRUE)
    {
        $filter = $this->ci->input->post_get('filter');
        $update_data = $this->ci->input->post_get('data');
        
        if(is_empty($filter)) throw new Error('Filter is required for an update endpoint');

        if(is_empty($update_data)) throw new Error('Data is required for an update endpoint.');

        //* Getting here means we have the appropriate data set
        $this->ci->load->model($model);
        $update_status = $this->ci->{$model}->update($filter,$update_data,$is_strict);
        $response_data = ['update_status'=>$update_status];

        $this->_print_api_response($is_ok,$options['messages'],$response_data,201);
    }
    
    /** [POST] Delete records */
    public function endpoint_delete($model='')
    {
        $filter = $this->ci->input->post_get('filter');
        $delete_status = $this->ci->{$model}->delete($filter);

        //TODO: Print API response
    }
}