<?php

declare(strict_types=1);

namespace App\File;

use Gaufrette\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Banner;
use Gaufrette\StreamWrapper;

final class Uploader
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function upload(Banner $banner, UploadedFile $file)
    {
        $map = StreamWrapper::getFilesystemMap();
        $map->set('storage', $this->filesystem);

        StreamWrapper::register();

        $input  = fopen($file->getPathname(), 'r');
        $output = fopen(sprintf('gaufrette://storage/%s', $banner->getId()), 'w');

        //stream_copy_to_stream($input, $output);
    }
}
