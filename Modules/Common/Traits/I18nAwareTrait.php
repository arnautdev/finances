<?php

namespace Modules\Common\Traits;


use Illuminate\Database\Eloquent\Model;

trait I18nAwareTrait
{
    /**
     *
     */
    protected static function bootI18nAwareTrait()
    {
        static::creating(function (Model $entity) {
            $entity->setTranslatedAttributes();
        });

        static::saving(function (Model $entity) {
            $entity->setLocaleTranslatedAttributes();
        });
    }

    /**
     *
     */
    private function setLocaleTranslatedAttributes()
    {
        $request = request();

        $data = [];
        $localeKey = session('locale');
        foreach ($this->translatedAttributes as $translatedAttribute) {
            $data[$localeKey][$translatedAttribute] = $request->get($translatedAttribute, '');
        }

        $this->fill($data);
    }


    /**
     * Set translated attributes
     */
    private function setTranslatedAttributes()
    {

        $request = request();

        $data = [];
        foreach (config('app.locales') as $localeKey => $localeTitle) {
            foreach ($this->translatedAttributes as $translatedAttribute) {
                $data[$localeKey][$translatedAttribute] = $request->get($translatedAttribute, '');
                if ($this->$translatedAttribute != '') {
                    $data[$localeKey][$translatedAttribute] = $this->$translatedAttribute;
                }
            }
        }

        $this->fill($data);
    }
}