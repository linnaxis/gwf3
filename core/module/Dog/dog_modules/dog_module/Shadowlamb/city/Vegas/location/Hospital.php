<?php
final class Vegas_Hospital extends SR_Hospital
{
	public function getHealPrice() { return 400; }
	
	public function getFoundPercentage() { return 95.00; }
	
	public function getStoreItems(SR_Player $player)
	{
		$back = array();
		$rep = $player->get('reputation');
		
		$back[] = array('Headcomputer');
		$back[] = array('SmartGoggles');
		$back[] = array('Sporn');
		$back[] = array('Cybermuscles');
		$back[] = array('CybermusclesV2');
		$back[] = array('CybermusclesV3');
		$back[] = array('DermalPlates');
		if ($rep >= 1) $back[] = array('DermalPlatesV2');
		if ($rep >= 2) $back[] = array('DermalPlatesV3');
		$back[] = array('WiredReflexes');
		if ($rep >= 2) $back[] = array('WiredReflexesV2');
		if ($rep >= 3) $back[] = array('WiredReflexesV3');
		
		return $back;
	}
}
?>