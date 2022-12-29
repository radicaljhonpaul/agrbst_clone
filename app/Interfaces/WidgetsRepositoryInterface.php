<?php

namespace App\Interfaces;

interface WidgetsRepositoryInterface
{
    public function demandOverCommitments();
    public function accounts();
    public function priceTrend();
    public function inventory();
    public function sales();
    public function priceIndex();
}