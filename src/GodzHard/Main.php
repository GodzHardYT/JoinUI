<?php


namespace GodzHard;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public $myConfig;

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§cPlugin enabled!");
        $this->myConfig = (new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
            "UI" => [
                "Title" => "§cThis is a Title",
                "Description" => "§aThis is a description",
                "Button" => "§eThis is a single button",
            ],
        )));
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
            $this->openMyForm($player);
        }

    public function openMyForm($player) {
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $config = $this->myConfig->getAll();
        $message = $config["UI"] ["Title"];
        $message2 = $config["UI"] ["Description"];
        $message3 = $config["UI"] ["Button"];
        $form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    break;
            }
        });
        $form->setTitle($message);
        $form->setContent($message2);
        $form->addButton($message3);
        $form->sendToPlayer($player);
        return $form;
        }
}