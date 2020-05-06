<?php

/**
 * Library - Login Community BPS.
 *
 * @author   Original : Aditya Sudyana <aditya.sudyana@bps.go.id>
 * @author   Contributor : Syaifur Rijal Syamsul <syaifur.rijal@bps.go.id>
 * @link     https://git.bps.go.id/aditya.sudyana/php-plugin-bps-community
 */

namespace App\Utility;

use Illuminate\Support\Facades\Storage;

class Authentication
{
    const ENDPOINT   = "https://community.bps.go.id/";
    const APPNAME    = "Front Page";
    const APPID      = "0";
    const REMOTEIP   = "0.0.0.0";
    const REQUESTURL = "";

    protected $bpsId;
    private $ch;

    /**
     * Konstruktur kelas.
     * - Inisiasi curl
     * - Mengambil curl - cookie jika ada.
     *
     *  @return void
     */
    public function __construct()
    {
        $this->ch = curl_init();

        if(Storage::exists('cookie.txt')) $this->cookie = Storage::get('cookie.txt');
	}

    /**
     * Destruktor kelas.
     * - Tutup curl yang sedang berjalan.
     *
     * @return void
     */
    public function __destruct()
    {
        if($this->ch) curl_close($this->ch);
    }

    /**
     * Otentikasi pegawai ke community BPS.
     *
     * @return void
     */
    public function login($username, $password)
    {
        $postdata = "uname=" . $username.
                    "&pass=" . $password.
                    "&redirectto=" . Self::ENDPOINT.
                    "&appname=" . Self::APPNAME.
                    "&appid=". Self::APPID.
                    "&remoteip=" . Self::REMOTEIP.
                    "&requesturl=" . Self::REQUESTURL;

        $result = $this->execute_state($postdata, "libs/clogin.php");

		// get cookies after login
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result['result'], $matches);

		$cookies = array();

        foreach($matches[1] as $item) {
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}

		if(isset($cookies['CommunityBPS'])) {
			$kukis     = $cookies['CommunityBPS'];
			$len_char  = strlen($kukis) - 32;
			$sessionid = substr($kukis, 0 ,$len_char);
			$bpsId     = substr($kukis, 0 , 9);
			$hashkey   = substr($kukis, -32);

			$this->bpsId = $bpsId;
			$this->ch    = $result['curl'];

            return true;
		} else {
            return false;
		}
    }

    /**
     * Mendapatkan profil lengkap pegawai.
     *
     * @param $nip
     * @return array
     */
    public function getProfil($nip)
    {
        $postdata = "";

        $result = $this->execute_state($postdata, "portal/index.php?id=2,6,", $nip);

		$urlfoto      = Self::ENDPOINT . $this->get_string_between($result['result'], '<center><img width=120px src="..', '" ></center>');
		$nama         = trim(($this->get_string_between($result['result'], 'Nama Lengkap</td><td width="2px" align="left">:</td><td align="left">', '</td></tr>')));
		$nipbps       = $nip;
		$nippanjang   = $this->get_string_between($result['result'], $nipbps.' - ', '</td></tr>');
		$email        = $this->get_string_between($result['result'], 'Email</td><td width="2px" align="left">:</td><td align="left">', '</td></tr>');
		$username     = str_replace("@bps.go.id", "", $email);
		$satuankerja  = trim($this->get_string_between($result['result'], 'Satuan Kerja</td><td width="2px" align="left" valign="top">:</td><td align="left">', '</td></tr>'));
		$alamatkantor = trim($this->get_string_between($result['result'], 'Alamat Kantor</td><td width="2px" align="left">:</td><td align="left">', '</td></tr>'));

		return $nama != '' ? array(
			'nama'         => $nama,
			'nipbps'       => $nipbps,
			'nippanjang'   => $nippanjang,
			'email'        => $email,
			'username'     => $username,
			'satuankerja'  => $satuankerja,
			'alamatkantor' => $alamatkantor,
			'urlfoto'      => $urlfoto
		) : false;

    }

    /**
     * Mendapatkan daftar lengkap pegawai BPS kabupaten.
     *
     * @param String $kodekab
     * @return array
     */
    public function getPegawaiKabkot($kodekab)
    {
		$postdata = "";

		$result = $this->execute_state($postdata, "portal/index.php?id=2,2,0&kab=", $kodekab);

		$webpagestart = stripos($result['result'], '<!DOCTYPE');
		$webpage      = substr($result['result'], $webpagestart);
        $doc          = new \DOMDocument;

		$doc->loadHTML($webpage, LIBXML_NOWARNING | LIBXML_NOERROR);

		$content_node   = $doc->getElementById("tengah");
		$listurlpegawai = array(); // to get ASN nip

        $div_a_class_nodes = $this->getElementsByClass($content_node, 'div', 'left_box');

        foreach($div_a_class_nodes as $nodess) {
			$items = $nodess->getElementsByTagName('a');
			foreach($items as $value) {
				$attrs = $value->attributes;
				$listurlpegawai[] = substr($attrs->getNamedItem('href')->nodeValue, -9);
			}
		}

		// convert all ASN nip to arrays of profile
        $listpegawai = array();

		foreach($listurlpegawai as $nip) {
			$listpegawai[] = $this->getprofil($nip);
		}

		return count($listpegawai)>0 ? $listpegawai : false;
	}


	/**
     * Mendapatkan daftar lengkap pegawai BPS provinsi.
     *
     * @param String $kodeprof
     * @return array
     */
    public function getPegawaiProvinsi($kodeprov)
    {
		$postdata = "org=" . $kodeprov;

		$result = $this->execute_state($postdata, "portal/index.php?id=2,0,0");

		$webpagestart = stripos($result['result'], '<!DOCTYPE');
		$webpage      = substr($result['result'], $webpagestart);
		$doc          = new \DOMDocument;

        $doc->loadHTML($webpage, LIBXML_NOWARNING | LIBXML_NOERROR);

		$content_node   = $doc->getElementById("tengah");
		$listurlpegawai = array(); // to get ASN nip

        $div_a_class_nodes = $this->getElementsByClass($content_node, 'div', 'left_box');

        foreach($div_a_class_nodes as $nodess) {
			$items = $nodess->getElementsByTagName('a');
			foreach($items as $key => $value) {
				$attrs = $value->attributes;
				$listurlpegawai[] = $attrs->getNamedItem('href')->nodeValue;
			}
		}

		// convert all ASN nip to arrays of profile
		$listpegawai = array();
		$i = 0;
		foreach($listurlpegawai as $nip) {
			$getnip = substr($nip,-9);
			if($i == 0) {
				$listpegawai[] = $this->getprofil($getnip);
			} else {
				if(substr($getnip, -7) == '0000000') {
					$listpegawai[] = $this->get_sublist_pegawai_provinsi($nip);
				}
			}
			$i++;
		}

		return count($listpegawai)>0 ? $listpegawai : false;
	}

	/**
     * Mencari pegawai berdasarkan nama atau nip yang digunakan dan wilayahnya.
     *
     * @param String $query ('340012345' atau 'Nama Pegawai')
     * @param String $wilayah (nullable)
     *
     * @return array
     */
    public function pencarian($query, $wilayah = "All")
    {
		$postdata = "wil=" . $wilayah . "&namapg=" . trim($query);

		$result = $this->execute_state($postdata, "portal/index.php?id=2,5,0");

		$webpagestart = stripos($result['result'], '<!DOCTYPE');
		$webpage      = substr($result['result'], $webpagestart);
		$doc          = new \DOMDocument;

        $doc->loadHTML($webpage, LIBXML_NOWARNING | LIBXML_NOERROR);

		$listurlpegawai = array(); // to get ASN nip

        $div_a_class_nodes=$this->getElementsByClass($doc, 'div', 'left_box');

		foreach($div_a_class_nodes as $nodess) {
			$items = $nodess->getElementsByTagName('a');
			foreach($items as $value) {
				$attrs = $value->attributes;
				$listurlpegawai[] = substr($attrs->getNamedItem('href')->nodeValue, -9);
			}
		}

		// convert all ASN nip to arrays of profile
		$listpegawai = array();

        foreach($listurlpegawai as $nip) {
			if($nip == 'y.back(1)') break;
			$listpegawai[] = $this->getprofil($nip);
		}

		$pesanerror = null;
		if(count($listpegawai) == 0)
			$pesanerror = trim($this->get_string_between($result, '<div class=pesan_error>', '<br>'));


		$hasil = array(
			'listpegawai' => $listpegawai,
			'pesanerror'  => $pesanerror
		);

		return $hasil;
    }

    /**
     * Mendapatkan profil pegawai lebih lengkap.
     *
     * @param $suburl
     * @return array
     */
    public function get_sublist_pegawai_provinsi($suburl)
    {
		$postdata = "";

		$result = $this->execute_state($postdata, "portal/", $suburl);

		$webpagestart = stripos($result['result'], '<!DOCTYPE');
		$webpage      = substr($result['result'], $webpagestart);
        $doc          = new \DOMDocument;

		$doc->loadHTML($webpage, LIBXML_NOWARNING | LIBXML_NOERROR);

		$content_node   = $doc->getElementById("tengah");
		$listurlpegawai = array(); // to get ASN nip

        $div_a_class_nodes=$this->getElementsByClass($content_node, 'div', 'left_box');

        foreach($div_a_class_nodes as $nodess) {
			$items = $nodess->getElementsByTagName('a');
			foreach($items as $value) {
				$attrs = $value->attributes;
				$listurlpegawai[] = substr($attrs->getNamedItem('href')->nodeValue, -9);
			}
		}

		// convert all ASN nip to arrays of profile
		$listpegawai = array();

        foreach($listurlpegawai as $nip) {
			$listpegawai[] = $this->getprofil($nip);
		}

		return count($listpegawai)>0 ? $listpegawai : false;
	}

	/**
     * Konfigurasi cURL.
     *
     * @param Object $ch
     * @param String $url
     * @param Array $postdata
     *
     * @return Object $ch
     */
    private function connectcurl($ch, $url, $postdata)
    {
        $cookie = storage_path('app/cookie.txt');

		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
		curl_setopt ($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		return $ch;
	}

    /**
     * Mendapatkan substring diantara dua string.
     *
     * @return String
     */
    private function get_string_between($string, $start, $end)
    {
		$string = ' ' . $string;
		$ini    = strpos($string, $start);

        if ($ini == 0) return '';

        $ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
	}

    /**
     * Mendapatkan elemen HTML berdasarkan nama class.
     *
     * @var String $tagName
     * @var String $className
     *
     * @return array
     */
    private function getElementsByClass($parentNode, String $tagName, String $className)
    {
		$nodes = array();

		$childNodeList = $parentNode->getElementsByTagName($tagName);

        for ($i = 0; $i < $childNodeList->length; $i++) {
			$temp = $childNodeList->item($i);
			if (stripos($temp->getAttribute('class'), $className) !== false) {
				$nodes[] = $temp;
			}
		}

		return $nodes;
    }

    /**
     * Eksekusi cURL.
     *
     * @var String $postdata
     * @var String $url
     * @var String $data (nullable)
     *
     * @return Illuminate\Support\Collection
     */
    private function execute_state($postdata, $url, $data = null)
    {
        $url    = Self::ENDPOINT . $url . $data;
		$ch     = $this->connectcurl($this->ch, $url, $postdata);
        $result = curl_exec ($ch);

        $collection = collect([
            'curl'   => $ch,
            'result' => $result
        ]);

        return $collection;
    }

    public function getBpsId()
    {
        return $this->bpsId;
    }
}
