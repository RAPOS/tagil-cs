<?php
/**
 * General API
 *
 * @author RAPOS
 */
namespace app\extensions;

use Yii;
use yii\base\Component;

class general extends Component {
	public function Print_r($obj) {
		print '<pre>';
		print_r($obj);
		print '</pre>';
	}
	
	public function translate($insert) {
		$replace = array(
			"А" => "a", "Б" => "b",  "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e", "Ё" => "yo",
			"Ж" => "zh","З" => "z",  "И" => "i", "Й" => "j", "К" => "k", "Л" => "l",
			"М" => "m", "Н" => "n",  "О" => "o", "П" => "p", "Р" => "r", "С" => "s",
			"Т" => "t", "У" => "u",  "Ф" => "f", "Х" => "h", "Ц" => "c", "Ч" => "ch",
			"Ш" => "sh","Щ" => "sch","Ъ" => "",  "Ы" => "",  "Ь" => "",  "Э" => "e",
			"Ю" => "yu","Я" => "ya",

			'а'=>'a', 'б'=>'b',  'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e','ё'=>'yo',
			'ж'=>'zh','з'=>'z',  'и'=>'i', 'й'=>'j', 'к'=>'k', 'л'=>'l',
			'м'=>'m', 'н'=>'n',  'о'=>'o', 'п'=>'p', 'р'=>'r', 'с'=>'s',
			'т'=>'t', 'у'=>'u',  'ф'=>'f', 'х'=>'h', 'ц'=>'c', 'ч'=>'ch',
			'ш'=>'sh','щ'=>'shh','ъ'=>'',  'ы'=>'y', 'ь'=>'',  'э'=>'e',
			'ю'=>'yu','я'=>'ya',

			' '=>'_','/'=>'_','_'=>'_','.'=>'',':'=>'',';'=>'',
			','=>'','!'=>'','?'=>'','>'=>'','<'=>'','&'=>'','*'=>'',
			'%'=>'','$'=>'','"'=>'','\''=>'','('=>'',')'=>'','`'=>'',
			'+'=>'','\\'=>'','|'=>'','['=>'',']'=>'','№'=>'',
		);
		$insert = strtr($insert, $replace);
		$insert = preg_replace('/-{2,}/', '-', $insert);

		return strtolower($insert);
	}
	
	public function getCut($string, $maxlen) {
		$len = (mb_strlen($string) > $maxlen)
			? mb_strripos(mb_substr($string, 0, $maxlen), ' ')
			: $maxlen
		;
		$cutStr = mb_substr($string, 0, $len);
		return (mb_strlen($string) > $maxlen)
			? '' . $cutStr . '...'
			: '' . $cutStr . ''
		;
	}
}
?>