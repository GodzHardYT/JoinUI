<?php


namespace GodzHard;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    public $myConfig;

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§cPlugin enabled!");
        $this->saveDefaultConfig();
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
            $this->openMyForm($player);
        }

    public function openMyForm($player) {
    	$Title = $this->getConfig()->get("Title");
		$Description = $this->getConfig()->get("Description");
		$Button = $this->getConfig()->get("Button");
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null) {
			$Command = $this->getConfig()->get("Command");
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                break;
				
				case 1:
				$this->getServer()->dispatchCommand($player, $Command);
				break;
				
            }
        });
        $form->setTitle($Title);
        $form->setContent($Description);
        $form->addButton($Button);
		$Button2 = $this->getConfig()->get("Button2");
		$Buttonon = $this->getConfig()->get("Button2-On");
		if ($Button2 == "true") {
			if ($form->addButton($Buttonon));
		}
        $form->sendToPlayer($player);
        return $form;
        }
}