<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 10/9/15
 * Time: 12:38 PM
 */



//$str = '$this->app->bind(\'App\Services\ProductCodeServiceInterface\', \'App\Services\ProductCodeService\');';

$str = '$this->app->bind(\'App\Repositories\ImageRepositoryInterface\', \'App\Repositories\ImageRepository\');';

if (preg_match('/\'(.*?)\'/', $str, $matches)){
    print_r($matches);
}

die;

$file = '/home/vagrant/Code/conark/app/Repositories/UserRepository.php';

$str = substr($file, strripos($file, '/') + 1, strlen($file));


echo substr($str, 0, strpos($str, '.php')), "====\n";

