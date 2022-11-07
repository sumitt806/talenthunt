<?php

namespace App\MediaLibrary;

use App\Models\Candidate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 * @package App\MediaLibrary
 */
class CustomPathGenerator implements PathGenerator
{
    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        $path = '{PARENT_DIR}'.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;

        switch ($media->collection_name) {
            case Setting::PATH;
                return str_replace('{PARENT_DIR}', 'settings', $path);
            case Candidate::RESUME_PATH;
                return str_replace('{PARENT_DIR}', 'resumes', $path);
            case Testimonial::PATH;
                return str_replace('{PARENT_DIR}', 'testimonials', $path);
            case User::PROFILE;
                return str_replace('{PARENT_DIR}', 'profile-pictures', $path);
            case Post::PATH:
                return str_replace('{PARENT_DIR}', Post::PATH, $path);
            case 'default' :
                return '';
        }
    }

    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'thumbnails/';
    }

    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'rs-images/';
    }
}
