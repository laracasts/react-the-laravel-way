<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class OptimizeWebpImageAction
{
    public function handleFromUploadedFile(UploadedFile $file): array
    {
        return $this->optimize($file->getRealPath());
    }

    public function handleFromPath(string $path): array
    {
        return $this->optimize($path);
    }

    protected function optimize(string $path): array
    {
        // Image optimization
        $image = Image::read($path);

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
