<?php
error_reporting(0);
require_once 'vendor/autoload.php';
require_once "config/fungsi_rupiah.php";

switch ($_GET['data']) {
    case 'provinsi':
        echo json_encode( RajaOngkir\RajaOngkir::Provinsi()->all() );
        break;
        
    case 'kota-by-provinsi':
        echo json_encode(RajaOngkir\RajaOngkir::Kota()->byProvinsi($_GET['id'])->get());
        break;

    case 'kota-by-kota-id':
        echo json_encode( RajaOngkir\RajaOngkir::Kota()->find($_GET['id']) );
        break;
    
    case 'option-kurir-html':
        /* start ongkos kirim */
        $data=[];
		$data['jne'] 	= RajaOngkir\RajaOngkir::Cost([
			'origin' 		=> 501, // id kota asal
			'destination' 	=> $_GET['d'], // id kota tujuan
			'weight' 		=> $_GET['w'], // berat satuan gram
			'courier' 		=> 'jne', // kode kurir pengantar ( jne / tiki / pos )
		])->get();
		$data['tiki'] 	= RajaOngkir\RajaOngkir::Cost([
			'origin' 		=> 501, // id kota asal
			'destination' 	=> $_GET['d'], // id kota tujuan
			'weight' 		=> $_GET['w'], // berat satuan gram
			'courier' 		=> 'tiki', // kode kurir pengantar ( jne / tiki / pos )
		])->get();
		$data['pos'] 	= RajaOngkir\RajaOngkir::Cost([
			'origin' 		=> 501, // id kota asal
			'destination' 	=> $_GET['d'], // id kota tujuan
			'weight' 		=> $_GET['w'], // berat satuan gram
			'courier' 		=> 'pos', // kode kurir pengantar ( jne / tiki / pos )
		])->get();
		$data['kurir'] = array_merge($data['jne'], $data['tiki'], $data['pos']);
		
		$htmls['option_kurir'] = [];
		foreach ($data['kurir'] as $key => $value) {
			$kurir= strtoupper($value['code']);
			foreach ($value['costs'] as $key_ => $value_) {
				if ( ($key==0) && ($key_==0) ) {
					$data['ongkos_kirim'] = $value_['cost'][0]['value'];
					$data['ongkos_kirim_rupiah'] = format_rupiah($value_['cost'][0]['value']);
				}
				$service= $value_['service'];
				$cost_value= format_rupiah($value_['cost'][0]['value']);
				$cost_etd= "({$value_['cost'][0]['etd']}";
				$cost_etd.= ($kurir=='POS') ? ')' : ' HARI)' ;

				$htmls['option_kurir'][] = "<option value='{$value_['cost'][0]['value']}'>{$kurir} {$service} Rp. {$cost_value} {$cost_etd}</option>";
			}
		}
        $htmls['option_kurir'] = implode('',$htmls['option_kurir']);
        echo $htmls['option_kurir'];
        break;

    default:
        # code...
        break;
}
?>