<?php namespace Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Builder;
class MorphPivot extends Pivot {
	protected $morphType;
	protected $morphClass;
	protected function setKeysForSaveQuery(Builder $query)
	{
		$query->where($this->morphType, $this->morphClass);
		return parent::setKeysForSaveQuery($query);
	}
	public function delete()
	{
		$query = $this->getDeleteQuery();
		$query->where($this->morphType, $this->morphClass);
		return $query->delete();
	}
	public function setMorphType($morphType)
	{
		$this->morphType = $morphType;
		return $this;
	}
	public function setMorphClass($morphClass)
	{
		$this->morphClass = $morphClass;
		return $this;
	}
}
