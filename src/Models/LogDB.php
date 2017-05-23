<?php

namespace App\Components\LogDB\Models;

use Illuminate\Database\Eloquent\Model;

class LogDB extends Model
{
    protected $table      = 'log_db';
    protected $primaryKey = 'id';
    protected $fillable   = [
        "level",
        "message",
        "request_full_url",
        "request_url",
        "request_uri",
        "request_method",
        "devices",
        "os",
        "os_version",
        "browser_name",
        "browser_version",
        "browser_accept_language",
        "robot",
        "client_ip",
    ];
}
