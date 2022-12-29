<?php

namespace App\Repositories;

use App\Interfaces\SaleAnalyticsRepositoryInterface;
use App\Interfaces\WidgetsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\Commit;
use App\Models\CommitDemandTransaction;
use App\Models\ConsolidatedDemand;
use App\Models\CropPricing;
use App\Models\User;
use App\Models\Demand;
use App\Models\MappedTransaction;
use stdClass;
use Carbon\Carbon;

class SaleAnalytics implements SaleAnalyticsRepositoryInterface  
{
    public function sales(){

    }
}
