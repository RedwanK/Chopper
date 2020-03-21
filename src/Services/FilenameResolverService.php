<?php

namespace App\Services;

class FilenameResolverService
{
    const IMAGE_FIELDS_CONST_NAME = 'IMAGE_FIELDS';

    /**
     * @param $objects
     *
     * @return mixed
     */
    public function updateListObjects($objects) {
        foreach ($objects as $object) {
            $object = $this->updateImagesName($object);
        }

        return $objects;
    }

    /**
     * This method set the filename of an object instead of the full path to it
     * for all the images fields of this object
     * @param $object
     */
    public function updateImagesName($object) {
        $reflexionObject = new \ReflectionObject($object);

        if($reflexionObject->hasConstant(self::IMAGE_FIELDS_CONST_NAME)) {
            $imageFields = $reflexionObject->getConstant(self::IMAGE_FIELDS_CONST_NAME);

            foreach($imageFields as $imageField) {
                $getter = "get".ucwords($imageField);
                $setter = "set".ucwords($imageField)."Name";
                if(method_exists($object, $getter) && method_exists($object, $setter)) {
                    $filename = $this->getFilename($object->$getter());
                    $object->$setter($filename);
                }
            }
        }

        return $object;
    }

    /**
     * retrieve the real filename of a path
     * @param $filepath
     *
     * @return mixed
     */
    public function getFilename($filepath) {
        $fileArray = explode('/', $filepath);

        $fileArray = array_reverse($fileArray);

        return $fileArray[0];
    }
}
