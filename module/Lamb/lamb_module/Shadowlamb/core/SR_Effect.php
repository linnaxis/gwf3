<?php
final class SR_Effect
{
	const MODE_ONCE = 1; # This effect holds until time is reached.
//	const MODE_STACK = 2; # This effect repeats every time seconds, the effect is stacked.
	const MODE_REPEAT = 3; # This effect repeats every time seconds.
	const MODE_TRIGGER = 4; # This effect exectues in time seconds.
	
	private $time_start;
	private $time_end;
	private $mode;
	private $time;
	private $modifiers;
	
	public function __construct($duration, $modifiers, $mode=self::MODE_ONCE, $time=0)
	{
		$this->time_start = $t = Shadowrun4::getTime();
		$this->time_end = $t + $duration;
		$this->mode = $mode;
		$this->time = $time;
		$this->modifiers = $modifiers;
	}
	
	public function getMode() { return $this->mode; }
	public function getTimeEnd() { return $this->time_end; }
	public function getModifiersRaw() { return $this->modifiers; }
	public function getModifiers(SR_Player $player)
	{
		switch($this->mode)
		{
			case self::MODE_REPEAT: return $this->isRepeating() === true ? $this->modifiers : array();
			case self::MODE_TRIGGER: return $this->isTriggered() === true ? $this->modifiers : array();
			case self::MODE_ONCE: return $this->modifiers;
			default: die('NO MOre OOps');
		}
	}
	
	private function isRepeating()
	{
		return true;
	}
	
	private function isTriggered()
	{
		return $this->time_end === Shadowrun4::getTime();
	}
	
	public function display()
	{
		$eta = $this->time_end - Shadowrun4::getTime();
		$e = $eta > 0 ? '('.GWF_Time::humanDuration($eta).')' : '(Over)';
		switch($this->mode)
		{
			case self::MODE_REPEAT:
				return 'Unknown';
			case self::MODE_ONCE:
				return Shadowfunc::getModifiers($this->modifiers).$e;
			case self::MODE_TRIGGER:
				return 'Unknown';
		}
	}

	public function isOver()
	{
		return $this->time_end < Shadowrun4::getTime();
	}
}
?>