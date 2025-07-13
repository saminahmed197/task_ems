<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BulkClientUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected array $clientIds;
    protected array $roles;
    protected array $statuses;
    /**
     * Create a new job instance.
     */
    public function __construct(array $clientIds, array $roles, array $statuses)
    {
        //
        $this->clientIds = $clientIds;
        $this->roles = $roles;
        $this->statuses = $statuses;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        foreach ($this->clientIds as $id) {
            $user = User::find($id);

            if ($user) {
                if ($user->request_decision === 'NO') {
                    $user->request_decision = 'YES';
                    $user->request_role = $this->roles[$id] ?? $user->request_role;
                    $user->is_admin = $this->roles[$id] ?? $user->activate;
                }

                $user->is_active = $this->statuses[$id] ?? $user->is_active;
                $user->save();
            }
        }
    }
}
