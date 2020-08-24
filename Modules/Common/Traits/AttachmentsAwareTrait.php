<?php

namespace Modules\Common\Traits;


use Illuminate\Database\Eloquent\Model;

trait AttachmentsAwareTrait
{

    /**
     *
     */
    public static function bootAttachmentsAwareTrait()
    {
        static::creating(function (Model $entity) {
            if (isset($entity->attachments)) {
                $entity->addAttachments();
            }
        });

        static::updated(function (Model $entity) {
            if (isset($entity->attachments)) {
                $entity->addAttachments();
            }
        });
    }


    /**
     * Add attachments to model
     */
    private function addAttachments()
    {
        $request = request();
        $attachments = $this->attachments;

        foreach ($attachments as $attachmentName => $attachmentSettings) {

            /// check if exists in request
            if ($request->exists($attachmentName)) {

                /// if set param, clear media collection before save
                if (isset($attachmentSettings['clearBeforeSave']) && $attachmentSettings['clearBeforeSave'] == true) {
                    $this->clearMediaCollection($attachmentName);
                }


                if (is_array($request->$attachmentName)) {
                    foreach ($request->$attachmentName as $item) {
                        $this->addMedia($item)
                            ->toMediaCollection($attachmentName);
                    }
                } else {
                    $this->addMedia($request->$attachmentName)
                        ->toMediaCollection($attachmentName);
                }
            }
        }
    }
}
