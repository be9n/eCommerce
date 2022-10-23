<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = true;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable =[
        'parent_id',
        'slug',
        'is_active',
        ];

    protected $hidden = [
        'translations',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }

    public function getActive(){
       return $this -> is_active == 0 ? 'Inactive' : 'Active';
    }

    public function createTranslation(Request $request)
    {
        foreach (locales() as $key => $language) {
            foreach ($this->translatedAttributes as $attribute) {
                if ($request->get($attribute . '_' . $key) != null && !empty($request->$attribute . $key)) {
                    $this->{$attribute . ':' . $key} = $request->get($attribute . '_' . $key);
                }
            }
            $this->save();
        }
        return $this;
    }
}
