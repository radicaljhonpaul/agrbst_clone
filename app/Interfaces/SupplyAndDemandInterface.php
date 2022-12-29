<?php

namespace App\Interfaces;

interface SupplyAndDemandInterface 
{
    public function getAllConsolidatedDemandsWithCommits();
    public function searchDemands($id);
    public function specificConsolidatedDemand($consolidated_demand_id);
    public function demandsWithCommitsViaConsolidatedDemandID($consolidated_demand_id);
    public function getCommitsViaDemandID($demandsArray);
    public function approveCommit($commit_id,$demand_id,$demands_array);
    public function disApproveCommit($commit_id);
    public function getCalendarView($month);
    
}