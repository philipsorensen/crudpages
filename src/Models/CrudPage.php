<?php

namespace PhilipSorensen\CrudPages\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CrudPage extends Model
{
	protected $guarded = [];
	protected $table = 'crud_pages';

	public function getOGImage()
	{
		if ($this->ogimage !== null)
		{
			$arr = explode('.', $this->ogimage);
			$fileext = end($arr);
			return 'data:image/' . $fileext . ';base64,' . base64_encode(Storage::get("ogimages/" . $this->ogimage));
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