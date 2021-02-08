<?php


namespace App\Services;

use Intervention\Image\Facades\Image;
use Storage;
use Str;
trait ImageTrait
{
    private $originalImg = 'original_img';
    private $previewImg = 'preview_img';
    private $imgNamePrefix = 'anime_';
    private $patchImgStorage = 'storage/anime/';
    private $thumb = 'thumb';
    private $imgColumns = '';
    private $extension = ['jpg', 'png', 'bmp', 'webp'];
    private $patchSeparator = '/';

    public function uploadImages($updateAnime, $requestForm)
    {
        $Extension = $requestForm[$this->originalImg]->getClientOriginalExtension();//Получает расширение файла
        if (in_array($Extension, $this->extension)) {
            $fileName = $this->imgNamePrefix . $updateAnime->id . '.' . $Extension;// формирует имя файла
            $pathImg = $this->patchImgStorage . Str::slug(
                    $updateAnime->title
                ) . $this->patchSeparator;          //путь к большой картинке
            $pathImgThumb = $pathImg . $this->thumb;//путь к уменьшеной картинке
            $pathImgSave = $this->patchImgStorage . Str::slug(
                    $updateAnime->title
                ) . $this->patchSeparator;
            $pathImgSaveThumb = $pathImgSave . $this->thumb;

            Storage::putFileAs($pathImg, $requestForm[$this->originalImg], $fileName);//запись картинки
            Storage::putFileAs(
                $pathImgThumb,
                $requestForm[$this->originalImg],
                $fileName
            );//запись уменьшеной картинки

            $requestForm[$this->originalImg] = $fileName;//Запись в базу
            $img = Image::make($pathImgSave . $fileName);
            $img->insert(
                self::$config['watermarkImg'],
                self::$config['watermarkPosition'],
                self::$config['watermark']['X'],
                self::$config['watermark']['Y']
            );
            $img->save($pathImgSave . $fileName);
            $imgThumb = Image::make($pathImgSaveThumb . $fileName);
            $imgThumb->resize(self::$config['img']['Width'], self::$config['img']['Height']);
            $imgThumb->save($pathImgSaveThumb . $fileName);

            return $requestForm;
        }
        return 'error';
    }
}
