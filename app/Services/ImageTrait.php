<?php


namespace App\Services;

use App\Models\Anime;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Storage;
use Str;

trait ImageTrait
{
	private $config = [
		'imgColumns'        => 'poster',
		'patchImgPublic'    => 'public/anime/',
		'imgNamePrefix'     => 'poster_',
		'patchImgStorage'   => 'storage/anime/',
		'imgPostDir'        => 'anime/',
		'watermarkImg'      => 'admin/images/watermark.png',
		'watermarkPosition' => 'bottom-right',
		'watermark'         => [
			'X' => 10,
			'Y' => 10,
		],
		'thumb'             => 'thumb/',
		'img'               => [
			'Width'  => 232,
			'Height' => 322,
		],
		'extension'         => [
			'jpg',
			'png',
			'bmp',
			'webp',
		],
	];

	public function __construct()
	{
		$this->config['patchSeparator'] = config('secondConfig.patchSeparator');
	}

	/**
	 * Загружает постер к записи
	 *
	 * @param  Anime    $updateAnime
	 * @param  Request  $requestForm
	 *
	 * @return mixed
	 */
	public function uploadImages(Anime $updateAnime, Request $requestForm)
	{
		$Extension = $requestForm[$this->config['imgColumns']]->getClientOriginalExtension();//Получает расширение файла
		if (in_array($Extension, $this->config['extension'])) {
			$fileName = $this->config['imgNamePrefix'] . $updateAnime->id . '.' . $Extension;// формирует имя файла
			$pathImg = $this->config['patchImgPublic'] . Str::slug(
					$updateAnime->title
				) . $this->config['patchSeparator'];          //путь к большой картинке
			$pathImgThumb = $pathImg . $this->config['thumb'];//путь к уменьшеной картинке
			$pathImgSave = $this->config['patchImgStorage'] . Str::slug(
					$updateAnime->title
				) . $this->config['patchSeparator'];
			$pathImgSaveThumb = $pathImgSave . $this->config['thumb'];

			Storage::putFileAs($pathImg, $requestForm[$this->config['imgColumns']], $fileName);//запись картинки
			Storage::putFileAs(
				$pathImgThumb,
				$requestForm[$this->config['imgColumns']],
				$fileName
			);//запись уменьшеной картинки

			$requestForm[$this->config['imgColumns']] = $fileName;//Запись в базу
			$img = Image::make($pathImgSave . $fileName);
			$img->insert(
				$this->config['watermarkImg'],
				$this->config['watermarkPosition'],
				$this->config['watermark']['X'],
				$this->config['watermark']['Y']
			);
			$img->save($pathImgSave . $fileName);
			$imgThumb = Image::make($pathImgSaveThumb . $fileName);
			$imgThumb->resize($this->config['img']['Width'], $this->config['img']['Height']);
			$imgThumb->save($pathImgSaveThumb . $fileName);

			return $requestForm;
		}
		return 'error';
	}
}
