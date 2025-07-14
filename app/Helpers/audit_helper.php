<?php
use App\Models\AuditLog;

if (!function_exists('log_audit')) {
    function log_audit($type, $desc, $module, $userId = null)
    {
        AuditLog::create([
            'log_type'       => strtoupper($type),
            'description'    => $desc,
            'impact_module'  => $module,
            'user_id'        => $userId ?? auth()->id()
        ]);
    }
}
