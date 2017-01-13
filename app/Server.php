<?php

namespace Mozart;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    /**
     * Get the identity associated with the server.
     */
    public function identity()
    {
        return $this->hasOne('Mozart\Identity', 'id', 'identity_id');
    }
}
