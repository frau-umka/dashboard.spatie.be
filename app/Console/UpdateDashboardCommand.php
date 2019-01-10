<?php

namespace App\Console;

use Illuminate\Console\Command;

class UpdateDashboardCommand extends Command
{
    protected $signature = 'dashboard:update';

    protected $description = 'Update all components displayed on the dashboard.';

    public function handle()
    {
        $this->call('dashboard:determine-appearance');
        $this->call('dashboard:send-heartbeat');
        $this->call('dashboard:fetch-openweather');
        $this->call('dashboard:fetch-calendar-events');
    }
}
