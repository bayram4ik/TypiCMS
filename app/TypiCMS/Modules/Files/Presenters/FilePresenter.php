<?php
namespace TypiCMS\Modules\Files\Presenters;

use Croppa;

use TypiCMS\Presenters\Presenter;

class FilePresenter extends Presenter
{

    public function thumb($size = 'sm')
    {
        $sizes = ['xs' => 24, 'sm' => 130, 'md' => 200, 'lg' => 400];

        if ($this->isImage($this->entity)) {
            $src = Croppa::url(
                '/'.$this->entity->path.'/'.$this->entity->filename,
                $sizes[$size],
                $sizes[$size],
                array('quadrant' => 'T')
            );
            return '<img src="' . $src . '" alt="' . $this->entity->alt_attribute . '">';
        } else {
            return '<div class="text-center doc"><i class="text-center fa fa-file-text-o"></i></div>';
        }
    }

    private function isImage($object)
    {
        return in_array(strtolower($object->extension), array('.jpg', '.jpeg', '.gif', '.png'));
    }
}
