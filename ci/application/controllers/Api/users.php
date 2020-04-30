<?php defined('BASEPATH') or exit('No direct script access allowed');
// /api/users/create

class User_Controller extends Api_Controller
{
    // Create
    public function create()
    {
        $this->api->endpoint_create('user_model');
    }

    // Read
    public function read()
    {

    }

    // Update
    public function update()
    {

    }

    // Delete
    public function delete()
    {

    }
}
