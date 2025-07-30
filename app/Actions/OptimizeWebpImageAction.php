<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class OptimizeWebpImageAction
{
    public function handle(string $input): array
    {
        // Image optimization
        $image = Image::read($input);

        // Scale down only
        if ($image->width() > 1000) {
            $image->scale(width: 1000);
        }

        $encoded = $image->toWebp(quality: 95)->toString();
        $fileName = Str::random() . '.webp';

        return  [
            'fileName' => $fileName,
            'webpString' => $encoded,
        ];
    }
}
