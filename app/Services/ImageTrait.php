<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Storage;
use Str;

trait ImageTrait
{
	private array $config;

	/**
	 * ImageTrait constructor.
	 */
	public function __construct()
	{
		$this->config = config('imgConfig');
		$this->config['patchSeparator'] = config('secondConfig.patchSeparator');
	}

	/**
	 * Загружает постер к записи
	 *
	 * @param $updateAnime
	 * @param $requestForm
	 *
	 * @return mixed
	 */
	public function uploadImages($updateAnime, $requestForm): mixed
	{
		$Extension = $requestForm[$this->config['imgColumns']]->getClientOriginalExtension();//Получает расширение файла
		if (in_array($Extension, $this->config['extension'])) {
			$fileName = strtotime(time()) . '_' . $this->config['imgNamePrefix'] . $updateAnime->id . '_' . $updateAnime->name . '.' . $Extension;// формирует имя файла
			$pathImg = $this->config['patchImgPublic'] . Str::slug($updateAnime->title) . $this->config['patchSeparator'];                        //путь к большой картинке
			$pathImgThumb = $pathImg . $this->config['thumb'];                                                                                    //путь к уменьшеной картинке
			$pathImgSave = $this->config['patchImgStorage'] . Str::slug($updateAnime->title) . $this->config['patchSeparator'];
			$pathImgSaveThumb = $pathImgSave . $this->config['thumb'];
			Storage::putFileAs($pathImg, $requestForm[$this->config['imgColumns']], $fileName);     //запись картинки
			Storage::putFileAs($pathImgThumb, $requestForm[$this->config['imgColumns']], $fileName);//запись уменьшеной картинки
			$requestForm[$this->config['imgColumns']] = $fileName;                                  //Запись в базу
			$img = Image::make($pathImgSave . $fileName);
			$img->insert($this->config['watermarkImg'], $this->config['watermarkPosition'], $this->config['watermark']['X'], $this->config['watermark']['Y']); //добавляет вотемарк
			$img->encode('webp', 90);
			$img->resize(1200, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($pathImgSave . $fileName);
			$imgThumb = Image::make($pathImgSaveThumb . $fileName);
			$imgThumb->resize(200, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$imgThumb->encode('webp', 90);
			$imgThumb->save($pathImgSaveThumb . $fileName);

			return $requestForm;
		}
		return 'error';
	}

	public function uploadImageNew($anime, $requestForm): array
	{
		$def = '/';
		$fileName = strtotime($anime->created_at) . '_anime_' . $anime->id . '_' . Str::slug($anime->name) . '.webp';
		$pathImg = $def . 'anime/' . $anime->id . '_' . Str::slug($anime->name) . '/'; //путь к большой картинке
		$pathImgThumb = $pathImg . 'thumb/';                                           //путь к уменьшеной картинке
		Storage::putFileAs($pathImg, $requestForm['poster'], $fileName);               //запись картинки
		Storage::putFileAs($pathImgThumb, $requestForm['poster'], $fileName);          //запись уменьшеной картинки
		/*$img = Image::make(public_path('storage' . $pathImg . $fileName));
		$img->encode('webp', 100);
		$img->resize(1200, null, function ($constraint) {
			$constraint->aspectRatio();
		});
		$img->save(public_path('storage' . $pathImg . $fileName));
		$imgThumb = Image::make(public_path('storage' . $pathImgThumb . $fileName));
		$imgThumb->encode('webp', 10);
		$imgThumb->resize(200, null, function ($constraint) {
			$constraint->aspectRatio();
		});
		$imgThumb->save(public_path('storage' . $pathImgThumb . $fileName));*/
		$this->imgResize('storage' . $pathImg, $fileName, 'webp', 100, 1200);
		$this->imgResize('storage' . $pathImgThumb, $fileName, 'webp', 10, 200);

		return $requestForm = [
			'original_img' => $pathImg . $fileName,
			'preview_img'  => $pathImgThumb . $fileName,
		];
	}

	private function imgResize(string $patch, string $fileName, string $fileFormat, int $quality, int $width = null, int $height = null)
	{
		$img = Image::make(public_path($patch . $fileName));
		$img->encode($fileFormat, $quality);
		$img->resize($width, $height, function ($constraint) {
			$constraint->aspectRatio();
		});
		$img->save(public_path($patch . $fileName));
	}
}
