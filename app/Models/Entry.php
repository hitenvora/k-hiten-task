<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    public function PerchParty()
	{
		return $this->hasOne(PerchParty::class, 'id', 'partie_id');
	}


	public function Rupees()
	{
		return $this->hasOne(PerchOrder::class, 'id', 'rupee');
	}

	public function Leser_type()
	{
		return $this->hasOne(Ledger::class, 'id', 'ledgers_id');
	}




}
