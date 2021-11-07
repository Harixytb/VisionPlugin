<?php

namespace HarixTeam;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Vision extends PluginBase implements Listener{

    public function onEnable(){

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Vision On");

    }

    public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool {

        if ($command->getName() === "vision"){

            if ($player instanceof Player) {

                if($player->hasPermission("vision.use")) {

                    if (!$player->hasEffect(Effect::NIGHT_VISION)) {

                        $effect = new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 999999999, 0, false);
                        $player->addEffect($effect);
                        $player->sendPopup("§2Vision On");

                    } else {

                        $player->removeEffect(Effect::NIGHT_VISION);
                        $player->sendPopup("§4Vision Off");
                    }

                } else {

                    $player->sendMessage("§cVous avez pas la permission pour cette commmande");

                }

            } else {
                $player->sendMessage("Vous devez faire cette commande en jeu");
            }

        }
        return true;
    }

}