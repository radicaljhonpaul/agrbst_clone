<?php

namespace App\Interfaces;

interface SalesAndTransactionsInterface 
{
    public function getAllMappedTransactionsDemandsWithCommits();
    public function getSpecificMappedTransactionsDemandsWithCommits($id);
    public function getClientData($id);
    public function searchDemands($id);
    public function getPaymentHistory($mapped_transactions_id);
    public function demandsWithCommitsViaConsolidatedDemandID($consolidated_demand_id);
    public function getCommitsViaDemandID($demandsArray);
    public function approveCommit($commit_id,$demand_id,$demands_array);
    public function disApproveCommit($commit_id);
    
    
}