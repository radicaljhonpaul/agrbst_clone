<?php

namespace App\Interfaces;

interface InventoryAndOrdersInterface 
{
    public function getAllDemandsSupplyAssessmentInADay();
    public function getConsolidatedDemandsByDateInAMonth($month);
    public function getConsolidatedDemandsByDate($date);
    
}