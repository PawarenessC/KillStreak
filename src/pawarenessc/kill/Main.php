<?php

namespace pawarenessc\slot;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\Player;
use pocketmine\Server;

class Main extends pluginBase implements Listener{

	public function onEnable(){
		
