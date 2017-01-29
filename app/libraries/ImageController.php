<?php
	Class ImageController
	{
		function __construct() {
		}
		public static function imageValidation($data)
		{
			$aux_rules = array();
			$aux_attr  = array();
			foreach ($data['img'] as $i => $f) {
				$aux_rules['img.'.$i] = 'image';
				$aux_attr['img.'.$i] = 'imagen';
			}
			return array('rules' => $aux_rules, 'attr' =>$aux_attr);
		}
		public static function upload_image($file, $filename,$path)
		{
			$ruta 	 = $path;
			$extension = File::extension($filename);
			$time = time();
			$miImg = $time.'.'.$extension;
			while (file_exists($ruta.$miImg)) {
				$time = time();
				$miImg = $time.'.'.$extension;
			}
	        $file->move($ruta,$miImg);
	        return $miImg;
		}

	}