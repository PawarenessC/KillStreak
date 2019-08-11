<?php

namespace pawarenessc\kill;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\Player;
use pocketmine\Server;

use onebone\economyapi\EconomyAPI;
use metowa1227\moneysystem\api\core\API;

class Main extends pluginBase implements Listener{

	public $kill = [];
	
	public function onEnable(){
		$this->getLogger()->info("=========================");
 		$this->getLogger()->info("KillStreakを読み込みました");
 		$this->getLogger()->info("制作者: PawarenessC");
 		$this->getLogger()->info("ライセンス: NYSL Version 0.9982");
 		$this->getLogger()->info("http://www.kmonos.net/nysl/");
 		$this->getLogger()->info("バージョン:v{$this->getDescription()->getVersion()}");
 		$this->getLogger()->info("=========================");
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
		$this->config = new Config($this->getDataFolder() . "Setup.yml", Config::YAML, array(
			"プラグイン"=>"MoneySystem",
			"1"=> array(
			 "Message"=>"{name}が1キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"2"=> array(
			 "Message"=>"{name}が2キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"3"=> array(
			 "Message"=>"{name}が3キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"4"=> array(
			 "Message"=>"{name}が4キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"5"=> array(
			 "Message"=>"{name}が5キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"6"=> array(
			 "Message"=>"{name}が6キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"7"=> array(
			 "Message"=>"{name}が7キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"8"=> array(
			 "Message"=>"{name}が8キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"9"=> array(
			 "Message"=>"{name}が9キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"10"=> array(
			 "Message"=>"{name}が10キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"11"=> array(
			 "Message"=>"{name}が11キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"12"=> array(
			 "Message"=>"{name}が12キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"13"=> array(
			 "Message"=>"{name}が13キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"14"=> array(
			 "Message"=>"{name}が14キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			),
			"15"=> array(
			 "Message"=>"{name}が15キル目だ！",
			 "表示"=>false,
			 "報酬"=>0,
			)));
	}
	
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$this->kill[$name] = 0;
	}
	
	public function onDeath(PlayerDeathEvent $event){
		$killer = $event->getPlayer();
		$player = $event->getEntity();
		$kname  = $killer->getName();
		$dname  = $player->getName();
		$this->kill[$dname] = 0;
		$this->kill[$kname]+1;
		$k = $this->kill[$kname];
		$cfg = $this->config->getAll();
		$this->addMoney($cfg[$k]["報酬"],$killer);
		
		if($cfg[$k]["表示"]){
			$msg = $cfg[$k]["Message"];
			$msg = str_replace("{name}", $kname, $msg);
			$this->getServer()->broadcastMessage($msg);
		}
	}
	
	public function addMoney($money, $p){
		$plugin = $this->config->get("プラグイン");
		switch($plugin){
			case "MoneySystem":
			case "moneysystem":
			case "MoneySystemAPI":
			
			API::getInstance()->increase($p, $money, "KillStreak", "KILLSTREAK");
			break;
			
			case "EconomyAPI":
			case "Economy":
			EconomyAPI::getInstance()->addMoney($p, $money);
			break;
		}
	}
}
