<?php

namespace PhilipSorensen\CrudPages\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CrudPage extends Model
{
	protected $guarded = [];
	protected $table = 'crud_pages';

	public function getOGImage()
	{
		if ($this->ogimage !== null)
		{
			return route('storageimage.show', ['path' => 'ogimages/' . $this->ogimage]);
		}
	}

	public function getText()
	{
		return $this->text;
	}

	public function scopeActive(Builder $query): void
	{
		$query->where('active', true);
	}
}