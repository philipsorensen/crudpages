<?php

namespace PhilipSorensen\CrudPages\Models;

use Illuminate\Database\Eloquent\Model;

class CrudPage extends Model
{
	protected $guarded = [];
	protected $table = 'crud_pages';

	public function getText()
	{
		return $this->text;
	}
}