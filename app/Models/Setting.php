<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Setting extends Model
{
    use HasFactory;
    use Translatable;

    protected $with = ['translations'];

    protected $fillable = [
        'key',
        'is_translatable',
        'plain_value',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $translatedAttributes = ['value'];

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

    protected $casts = [
        'is_translatable' => 'boolean',
    ];

     public static function setMany($settings){
         foreach ($settings as $key => $value){
             self::set($key, $value);
         }
     }

     public static function set($key, $value){
         if ($key === 'translatable'){
             return static::setTranslatableSettings($value);
         }

         if (is_array($value)){
             $value = json_encode($value);
         }
         static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
     }

     public static function setTranslatableSettings($settings = []){
         foreach ($settings as $key => $value){
             static::updateOrCreate(['key' => $key], [
                 'is_translatable' => true,
                 'value' => $value,
             ]);
         }
     }
}
